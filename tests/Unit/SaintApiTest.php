<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaintApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/saints/254');
        $response->assertStatus(200)->assertJSON([
            "id" => 254,
            "name" => "Bonifatius Tarsus",
            "date" => "05.06.",
            "bhl" => "1413"
        ]);
    }
}
