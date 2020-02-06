<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaintsApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/saints');
        $response->assertStatus(200)->assertJsonCount(581)->assertJSON([[
            "name" => "Epistula beato Ieronimo ab episcopis Chromatio et Eliodoro et rescriptum",
            "date" => "01.01.",
            "comments" => "Ohne Überschriften in Z"
        ]]);
    }
}
