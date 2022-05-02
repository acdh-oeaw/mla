<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/files/9');
        $response->assertStatus(200)->assertJSON([
            "id" => 9,
            "name" => "Leonardus_06.11_AA SS Nov III_148-155",
            "page_count" => 5
        ]);
    }
}
