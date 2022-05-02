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
            "image" => "/images/Heiligenkreuz.jpg",
            "prefix" => "AT3500",
            "legenden" => 533,
            "latitude" => 48.055796,
            "longitude" => 16.130977,
            "codex_count" => 4,
            "legend_count" => 531,
            "codices" => [
                [
                    "id" => 2,
                    "codex" => "AT3500-11",
                    "monastery_id" => 2,
                    "number" => 11,
                    "manuscripta_id" => 30277,
                    "legend_count" => 150
                ],
                [
                    "id" => 9,
                    "codex" => "AT3500-12",
                    "monastery_id" => 2,
                    "number" => 12,
                    "manuscripta_id" => 30288,
                    "legend_count" => 144
                ],
                [
                    "id" => 13,
                    "codex" => "AT3500-13",
                    "monastery_id" => 2,
                    "number" => 13,
                    "manuscripta_id" => 30296,
                    "legend_count" => 169
                ],
                [
                    "id" => 20,
                    "codex" => "AT3500-14",
                    "monastery_id" => 2,
                    "number" => 14,
                    "manuscripta_id" => 30305,
                    "legend_count" => 68
                ]
            ]
        ]);
    }
}
