<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageTest extends TestCase
{
    /**
     * Test if codex images are loaded correctly.
     *
     * @return void
     */
    public function test_codex_image_reponse() {
        $response = $this->get('/image/codex/8/174r');
        $response->assertstatus(200);
    }

    /**
     * Test if placeholder image is loaded if codex image is unavailable.
     *
     * @return void
     */
    public function test_unavailable_codex_image_reponse() {
        $response = $this->get('/image/codex/10/21r');
        $response->assertstatus(200);
    }

    /**
     * Test if tilesources are created correctly.
     *
     * @return void
     */
    public function test_tilesource_reponse() {
        $response = $this->get('/dzi/1/1');
        $response->assertstatus(200);
    }

    /**
     * Test if tiles are loaded correctly.
     *
     * @return void
     */
    public function test_tile_reponse() {
        $response = $this->get('/dzi/2/6_files/11/1_1.jpg');
        $response->assertstatus(200);
    }
}
