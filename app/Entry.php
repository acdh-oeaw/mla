<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function saint() {
        return $this->belongsTo('App\Saint');
    }

    public function codex() {
        return $this->belongsTo('App\Codex');
    }
}
