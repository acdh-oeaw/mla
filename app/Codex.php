<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Codex extends Model
{
    protected $table = 'codices';

    protected $appends = [ 'legend_count' ];

    public function getLegendCountAttribute() {
        return DB::table('entries')->where('codex_id', $this->id)->join('saints', 'entries.saint_id', '=', 'saints.id')->count();
    }
}
