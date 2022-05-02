<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{

    protected $tables = [
        'codices',
        'entries',
        'files',
        'monasteries',
        'monastery_codex',
        'saints'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        echo "Seeding ...\n";
        foreach($this->tables as $table) {
            $data = json_decode(file_get_contents(database_path('seeders/data/'.$table.'.json')), true);
            DB::table($table)->truncate();
            foreach($data as $row) {
                DB::table($table)->insert($row);
            }
        }
        echo "... done!\n";
        echo "Generating search index ...\n";
        Artisan::call('saints:index');
        echo "... done!\n";
    }
}
