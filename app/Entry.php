<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'Entry';

    public function saint() {
        return $this->belongsTo('App\Saint');
    }

    public function codex() {
        return $this->belongsTo('App\Codex');
    }
}
