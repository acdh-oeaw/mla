<?php

namespace App\Http\Controllers\Api;

use App\Saint;
use TeamTNT\TNTSearch\TNTSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->tnt = new TNTSearch;
        $this->tnt->loadConfig([
            'driver'    => env('DB_CONNECTION'),
            'host'      => env('DB_HOST'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'storage'   => storage_path('app/tnt'),
            'stemmer'   => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class
        ]);
        $this->tnt->selectIndex('saints');
        $this->tnt->fuzziness = true;
        $this->tnt->asYouType = true;
    }

    public function search(Request $request) {
        $results = $this->tnt->search($request->get('query'), 10);
        return Saint::whereIn('id', $results['ids'])->get();
    }
}
