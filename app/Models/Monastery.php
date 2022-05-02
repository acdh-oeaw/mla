<?php

namespace App\Models;

use App\Models\Codex;
use App\Models\Saint;

use Illuminate\Database\Eloquent\Model;

class Monastery extends Model
{

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
        return $this->hasMany('App\Models\Codex', 'monastery_id');
    }
}
