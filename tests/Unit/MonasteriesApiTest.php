<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonasteriesApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/monasteries');
        $response->assertStatus(200)->assertJsonCount(6)->assertJSON([[
            "id" => 1,
            "name" => "Admont",
            "prefix" => "AT1000",
            "legend_count" => 251
        ]]);
    }
}
