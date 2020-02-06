<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        foreach($this->tables as $table) {
            $data = json_decode(file_get_contents(database_path('seeds/data/'.$table.'.json')), true);
            DB::table($table)->truncate();
            foreach($data as $row) {
                DB::table($table)->insert($row);
            }
        }
    }
}
