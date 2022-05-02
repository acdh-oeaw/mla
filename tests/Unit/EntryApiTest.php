<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/entries/159');
        $response->assertStatus(200)->assertJSON([
            "id" => 159,
            "saint_id" => 33,
            "codex_id" => 2,
            "pages" => "60r-66r"
        ]);
    }
}
