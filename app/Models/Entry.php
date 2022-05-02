<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function saint() {
        return $this->belongsTo('App\Models\Saint');
    }

    public function codex() {
        return $this->belongsTo('App\Models\Codex');
    }
}
