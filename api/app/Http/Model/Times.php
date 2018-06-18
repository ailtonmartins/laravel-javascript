<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'times';

    function grupos() {
        return $this->belongsTo('App\Grupos');
    }

    function continentes() {
        return $this->belongsTo('App\Continentes');
    }
}
