<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/search?query=step');
        $response->assertStatus(200)->assertJsonCount(4)->assertJSON([[
            "id" => 353,
            "name" => "Stephanus",
            "date" => "02.08."
        ]]);
    }
}
