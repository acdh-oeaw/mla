<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonasteryApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/monasteries/2');
        $response->assertStatus(200)->assertJSON([
            "id" => 2,
            "name" => "Heiligenkreuz",
            "legend_count" => 533,
            "codices" => [[
                "id" => 2,
                "number" => 11,
                "legend_count" => 150
            ]]
        ]);
    }
}
