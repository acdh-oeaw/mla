<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageTest extends TestCase
{
    public function test_manuscripta_request() {
        $client = new Client([ 'base_uri' => 'http://manuscripta.at/images/AT/1000/AT1000-25/1/' ]);
        $response = $client->request('GET', 'AT1000-25_017r.jpg', [ 'sink' => storage_path('app/test') ]);
        $size = filesize(storage_path('app/test'));
        unlink(storage_path('app/test'));
        $this->assertTrue($size == 481276);
    }

    /**
     * Test if codex images are loaded correctly.
     *
     * @return void
     */
    public function test_codex_image_reponse() {
        $response = $this->get('/image/codex/8/174r');
        $response->assertStatus(200);
    }

    /**
     * Test if placeholder image is loaded if codex image is unavailable.
     *
     * @return void
     */
    public function test_unavailable_codex_image_reponse() {
        $response = $this->get('/image/codex/10/21r');
        $response->assertStatus(200);
    }

    /**
     * Test if tilesources are created correctly.
     *
     * @return void
     */
    public function test_tilesource_reponse() {
        $response = $this->get('/dzi/1/1');
        $response->assertStatus(200);
    }

    /**
     * Test if tiles are loaded correctly.
     *
     * @return void
     */
    public function test_tile_reponse() {
        $response = $this->get('/dzi/2/6_files/11/1_1.jpg');
        $response->assertStatus(200);
    }
}
