<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    protected $fillable = [
        'nome', 'usarNomeSocial', 'negro', 'deficiente', 'nomeSocial', 'email', 'nacionalidade', 'cpf', 'rg', 'nascimento', 'cep', 'logradouro', 'bairro', 'numero', 'complemento', 'cidade', 'uf', 'cel1', 'cel2', 'funcao_id', 'formacao_id', 'registro', 'arquivo1Nome', 'arquivo1Local', 'arquivo1Url', 'arquivo2Nome', 'arquivo2Local', 'arquivo2Url', 'arquivo3Nome', 'arquivo3Local', 'arquivo3Url', 'arquivo4Nome', 'arquivo4Local', 'arquivo4Url', 'arquivo5Nome', 'arquivo5Local', 'arquivo5Url', 'arquivo6Nome', 'arquivo6Local', 'arquivo6Url',
    ];

    protected $dates = ['created_at', 'nascimento'];


    public function funcao()
    {
        return $this->belongsTo('App\Funcao');
    }

    public function formacao()
    {
        return $this->belongsTo('App\Formacao');
    }
}
