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
}
