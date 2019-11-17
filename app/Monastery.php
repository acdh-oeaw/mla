<?php

namespace App;

use App\Codex;
use App\Saint;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monastery extends Model
{
    use SoftDeletes;

    protected $table = 'Monastery';

    protected $appends = ['codex_count','legend_count'];

    public function getCodexCountAttribute() {
        return Codex::where('monastery_id', $this->id)->count();
    }

    public function getLegendCountAttribute() {
        $codices = Codex::where('monastery_id', $this->id)->get();
        $count = 0;
        foreach($codices as $codex) {
            $count += $codex->legend_count;
        }
        return $count;
    }

    public function codices() {
        return $this->hasMany('App\Codex', 'monastery_id');
    }
}
