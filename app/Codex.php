<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Codex extends Model
{
    protected $table = 'Codex';

    protected $appends = [ 'legend_count' ];

    public function getLegendCountAttribute() {
        return DB::table('Entry')->where('codex_id', $this->id)->join('Saint', 'Entry.saint_id', '=', 'Saint.id')->count();
    }
}
