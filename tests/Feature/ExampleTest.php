<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_history_page_returns_successful_response(): void
    {
        $response = $this->get('/profil/sejarah');

        $response->assertStatus(200);
    }

    public function test_visi_misi_page_returns_successful_response(): void
    {
        $response = $this->get('/profil/visi-misi');

        $response->assertStatus(200);
    }

    public function test_program_page_returns_successful_response(): void
    {
        $response = $this->get('/program');

        $response->assertStatus(200);
    }

    public function test_prestasi_page_returns_successful_response(): void
    {
        $response = $this->get('/prestasi');

        $response->assertStatus(200);
    }

    public function test_fasilitas_page_returns_successful_response(): void
    {
        $response = $this->get('/fasilitas');

        $response->assertStatus(200);
    }

    public function test_berita_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/berita');

        $response->assertStatus(200);
    }

    public function test_berita_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/berita/kegiatan-hafalan-santri');

        $response->assertStatus(200);
    }

    public function test_informasi_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/informasi');

        $response->assertStatus(200);
    }

    public function test_informasi_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/informasi/kegiatan-santri-bulan-ini');

        $response->assertStatus(200);
    }

    public function test_infaq_page_returns_successful_response(): void
    {
        $response = $this->get('/informasi/infaq');

        $response->assertStatus(200);
    }

    public function test_hubungi_kami_page_returns_successful_response(): void
    {
        $response = $this->get('/hubungi-kami');

        $response->assertStatus(200);
    }

    public function test_send_contact_message_successful(): void
    {
        $response = $this->post('/hubungi-kami/send', [
            'name' => 'Ahmad Fulan',
            'email' => 'ahmad.fulan@example.com',
            'subject' => 'Informasi Pendaftaran Santri Baru',
            'message' => 'Assalamu alaikum, mohon informasi pendaftaran santri baru untuk tahun ajaran mendatang.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'ahmad.fulan@example.com',
            'subject' => 'Informasi Pendaftaran Santri Baru',
            'is_read' => false,
        ]);
    }

    public function test_send_contact_message_validation_fails(): void
    {
        $response = $this->post('/hubungi-kami/send', [
            'name' => '',
            'email' => 'bukan-email',
            'subject' => '',
            'message' => 'abc', // less than 5
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_admin_can_update_contact_info_and_display_on_website(): void
    {
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->post('/administrator/informasi-kontak/update', [
            'address' => 'Jl. Ponpes Al-Quran No. 99, Sleman, DI Yogyakarta',
            'phone' => '0812-9999-8888',
            'email' => 'admin@ponpes-alquran.sch.id',
            'opening_hours' => 'Senin - Jumat (07:30 - 15:30 WIB)',
            'maps_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=test-location" width="600"></iframe>',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_info', [
            'address' => 'Jl. Ponpes Al-Quran No. 99, Sleman, DI Yogyakarta',
            'phone' => '0812-9999-8888',
            'email' => 'admin@ponpes-alquran.sch.id',
            'opening_hours' => 'Senin - Jumat (07:30 - 15:30 WIB)',
            'maps_iframe' => 'https://www.google.com/maps/embed?pb=test-location',
        ]);

        $websiteResponse = $this->get('/hubungi-kami');
        $websiteResponse->assertStatus(200);
        $websiteResponse->assertSee('Jl. Ponpes Al-Quran No. 99, Sleman, DI Yogyakarta');
        $websiteResponse->assertSee('admin@ponpes-alquran.sch.id');
        $websiteResponse->assertSee('https://www.google.com/maps/embed?pb=test-location');
    }

    public function test_admin_can_update_footer_settings_and_display_on_website(): void
    {
        Storage::fake('public');
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        $logoFile = UploadedFile::fake()->image('test_logo.png');

        $response = $this->actingAs($user)->post('/administrator/pengaturan-web/update', [
            'pesantren_name' => 'Pesantren Modern Al-Quran Super',
            'about_text' => 'Deskripsi profil singkat footer untuk pengujian.',
            'copyright_text' => 'Pesantren Modern Al-Quran Super. All Rights Reserved.',
            'logo' => $logoFile,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('footer_settings', [
            'pesantren_name' => 'Pesantren Modern Al-Quran Super',
            'about_text' => 'Deskripsi profil singkat footer untuk pengujian.',
            'copyright_text' => 'Pesantren Modern Al-Quran Super. All Rights Reserved.',
        ]);

        $websiteResponse = $this->get('/');
        $websiteResponse->assertStatus(200);
        $websiteResponse->assertSee('Pesantren Modern Al-Quran Super');
        $websiteResponse->assertSee('Deskripsi profil singkat footer untuk pengujian.');
    }

    public function test_admin_can_manage_social_media(): void
    {
        Storage::fake('public');
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        $imageFile = UploadedFile::fake()->image('instagram.png');

        // Store
        $response = $this->actingAs($user)->post('/administrator/pengaturan-web/social-media/store', [
            'name' => 'Instagram Pesantren',
            'url' => 'https://instagram.com/ponpes_test',
            'image' => $imageFile,
            'is_active' => '1',
            'order' => 1,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('footer_social_media', [
            'name' => 'Instagram Pesantren',
            'url' => 'https://instagram.com/ponpes_test',
        ]);

        $socmed = \App\Models\Administrator\Setting\FooterSocialMediaModel::where('name', 'Instagram Pesantren')->first();
        $this->assertNotNull($socmed);

        $websiteResponse = $this->get('/');
        $websiteResponse->assertStatus(200);
        $websiteResponse->assertSee('https://instagram.com/ponpes_test');

        // Delete
        $deleteResponse = $this->actingAs($user)->delete("/administrator/pengaturan-web/social-media/delete/{$socmed->id}");
        $deleteResponse->assertSessionHas('success');
        $this->assertDatabaseMissing('footer_social_media', [
            'id' => $socmed->id,
        ]);
    }

    public function test_admin_can_manage_administrators(): void
    {
        $superAdmin = \App\Models\User::first() ?? \App\Models\User::factory()->create([
            'username' => 'super_admin_test',
            'email' => 'superadmin@test.com',
        ]);

        // 1. Can view page
        $pageResponse = $this->actingAs($superAdmin)->get('/administrator/manajemen-admin');
        $pageResponse->assertStatus(200);
        $pageResponse->assertSee('Daftar Administrator Sistem');

        // 2. Can store new admin
        $storeResponse = $this->actingAs($superAdmin)->post('/administrator/manajemen-admin/store', [
            'name' => 'Admin Baru Test',
            'username' => 'admin_baru_test',
            'email' => 'adminbaru@test.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);
        $storeResponse->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'username' => 'admin_baru_test',
            'email' => 'adminbaru@test.com',
        ]);

        $newAdmin = \App\Models\User::where('username', 'admin_baru_test')->first();
        $this->assertNotNull($newAdmin);

        // 3. Can update admin
        $updateResponse = $this->actingAs($superAdmin)->put("/administrator/manajemen-admin/update/{$newAdmin->id}", [
            'name' => 'Admin Baru Diedit',
            'username' => 'admin_baru_edited',
            'email' => 'adminbaru_edited@test.com',
        ]);
        $updateResponse->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'id' => $newAdmin->id,
            'name' => 'Admin Baru Diedit',
            'username' => 'admin_baru_edited',
            'email' => 'adminbaru_edited@test.com',
        ]);

        // 4. Cannot delete self
        $selfDeleteResponse = $this->actingAs($superAdmin)->delete("/administrator/manajemen-admin/delete/{$superAdmin->id}");
        $selfDeleteResponse->assertSessionHas('error');
        $this->assertDatabaseHas('users', [
            'id' => $superAdmin->id,
        ]);

        // 5. Can delete other admin
        $deleteResponse = $this->actingAs($superAdmin)->delete("/administrator/manajemen-admin/delete/{$newAdmin->id}");
        $deleteResponse->assertSessionHas('success');
        $this->assertDatabaseMissing('users', [
            'id' => $newAdmin->id,
        ]);
    }

    public function test_authenticated_admin_can_access_dashboard_with_metrics(): void
    {
        $admin = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        $response = $this->actingAs($admin)->get('/administrator/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Selamat Datang');
        $response->assertSee('Pesan Masuk');
        $response->assertSee('Pintasan Aksi Cepat');
        $response->assertSee('Seluruh Modul Berjalan Normal');
    }
}
