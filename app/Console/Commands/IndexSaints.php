<?php

namespace App\Console\Commands;

use TeamTNT\TNTSearch\TNTSearch;
use Illuminate\Console\Command;

class IndexSaints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saints:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all entries in the saints table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // https://github.com/teamtnt/tntsearch
 
        if(!file_exists(storage_path('app/tnt'))) mkdir(storage_path('app/tnt'));               
        $tnt = new TNTSearch;
        $tnt->loadConfig([
            'driver'    => env('DB_CONNECTION'),
            'host'      => env('DB_HOST'),
            'database'  => env('DB_DATABASE'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'storage'   => storage_path('app/tnt'),
            'stemmer'   => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class
        ]);
        $indexer = $tnt->createIndex('saints');
        $indexer->query('SELECT id, name, date FROM saints;');
        $indexer->run();

        return 0;
    }
}
