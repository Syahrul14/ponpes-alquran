<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
