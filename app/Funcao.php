<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $fillable = [
        'descricao',
    ];

    public function curriculos()
    {
        return $this->hasMany('App\Curriculo');
    }
}
