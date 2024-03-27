<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Test access to the services route.
     *
     * @return void
     */
    public function test_services_route()
    {
        // Visite la route /services
        $response = $this->get('/services');

        // Vérifie que la réponse a le statut HTTP 200 (OK)
        $response->assertStatus(200);

        // Vérifie que la vue retournée est 'services'
        $response->assertViewIs('services');
    }

    /**
     * Test access to the about-us route.
     *
     * @return void
     */
    public function test_about_us_route()
    {
        // Visite la route /about-us
        $response = $this->get('/about-us');

        // Vérifie que la réponse a le statut HTTP 200 (OK)
        $response->assertStatus(200);

        // Vérifie que la vue retournée est 'about-us'
        $response->assertViewIs('about-us');
    }
}
