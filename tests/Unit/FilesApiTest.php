<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilesApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/files');
        $response->assertStatus(200)->assertJsonCount(16)->assertJSON([[
            "id" => 1,
            "name" => "Clemens_23.11_Funk (Hrsg.), Patres Apostolici_50-81",
            "page_count" => 18
        ]]);
    }
}
