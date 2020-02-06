<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntriesApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/entries');
        $response->assertStatus(200)->assertJsonCount(2296)->assertJSON([[ "saint_id" => 580, "pages" => "NSr-NSv" ]]);
    }
}
