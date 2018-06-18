<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continentes extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'continentes';

    public function times(){
        return $this->hasMany(Times::class);
    }
}
