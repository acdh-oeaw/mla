<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Codex;
use Image;

class ImageController extends Controller
{
    public function getMonasteryImage($id) {
        if(!file_exists(storage_path('app/monasteries'))) mkdir(storage_path('app/monasteries'));
        $img = Image::cache(function($image) use($id) {
            $image->make(storage_path('app/monasteries/'.$id))->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
        }, 1440, true);
        return $img->response();
    }

    public function getCodexImage($id, $number = "0") {
        if(!file_exists(storage_path('app/codices'))) mkdir(storage_path('app/codices'));
        if(!file_exists(storage_path('app/codices/'.$id))) mkdir(storage_path('app/codices/'.$id, 0777, true));
        if(!file_exists(storage_path('app/codices/'.$id.'/'.$number))) {
            $codex = Codex::find($id);
            $country_code = [];
            preg_match('/^[A-Z]+/', $codex->codex, $country_code);
            $codex_signature = [];
            preg_match('/[0-9]+/', $codex->codex, $codex_signature);
            
            $pageNumber = str_pad(intval($number)."", 3, "0", STR_PAD_LEFT).preg_replace('/\d+/', '', $number);
            $chars = preg_replace('/\d/', '', $pageNumber);
            if(strlen($chars) < 1) $pageNumber = $pageNumber.'r';
            if(count($country_code) > 0 && count($codex_signature) > 0) {
                $client = new Client([ 'base_uri' => 'http://manuscripta.at/images/'.$country_code[0].'/'.$codex_signature[0].'/'.$codex->codex.'/1/' ]);
                $response = $client->request('GET', $codex->codex.'_'.($number == "0" ? 'VD' : $pageNumber).'.jpg', [ 'sink' => storage_path('app/codices/'.$id.'/'.$number) ]);
            }
        }
        $img = Image::cache(function($image) use($id, $number) {
            $image->make(storage_path('app/codices/'.$id.'/'.$number))->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
        }, 1440, true);
        return $img->response();
    }

    public function dzi($id, $page) {
        if(!file_exists(storage_path('app/cache'))) mkdir(storage_path('app/cache'));
        if(!file_exists(storage_path('app/cache/file-'.$id)) || !file_exists(storage_path('app/cache/file-'.$id.'/file-'.$id.'-'.$page))) {
            $deepzoom = \Jeremytubbs\Deepzoom\DeepzoomFactory::create([
                'path' => storage_path('app/cache'),
                'driver' => 'imagick',
                'format' => 'jpg',
            ]);
            $deepzoom->makeTiles(storage_path('app/files/'.$id.'-'.$page.'.jpg'), 'file-'.$id.'-'.$page, 'file-'.$id);
        }
        return response()->download(storage_path('app/cache/file-'.$id.'/file_'.$id.'_'.$page.'.dzi'));
    }

    public function getTile($id, $page, $folder, $image) {
        return response()->download(storage_path('app/cache/file-'.$id.'/file_'.$id.'_'.$page.'_files/'.$folder.'/'.$image));
    }
}
