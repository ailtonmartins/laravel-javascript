<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $fillable = ['nome'];

    public function times()
    {
        return $this->hasMany(Times::class);
    }

}
