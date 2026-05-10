<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    /**
     * Test apakah halaman login bisa dibuka (Status 200 OK).
     */
    public function test_halaman_login_bisa_dibuka(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test apakah halaman register bisa dibuka.
     */
    public function test_halaman_register_bisa_dibuka(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}