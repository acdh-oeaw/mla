<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CodexApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('GET', '/api/codices/4');
        $response->assertStatus(200)->assertJSON([
            "id" => 4,
            "codex" => "AT6000-388",
            "monastery_id" => 5,
            "number" => 388,
            "manuscripta_id" => 8999,
            "legend_count" => 79
        ]);
    }
}
