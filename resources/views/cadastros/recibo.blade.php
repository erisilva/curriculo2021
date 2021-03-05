@extends('layouts.clear')

@section('content')


<div class="container">


  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="text-center">
            <img class="img-fluid" src="http://www.contagem.mg.gov.br/novoportal/images/brasao_provisorio.png">
          </div>  
        </div>
        <div class="col-md-8">
          <h3>Prefeitura Municipal de Contagem</h3>
          <h4>Secretaria Municipal de Saúde</h4>
          <p class="lead">Edital de Chamamento Público</p>
          <hr class="my-4">
          <p>Processo Seletivo Simplificado</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <h1>Sua inscrição foi recebida com sucesso.</h1>
    <h2>Número da inscrição <strong>{{ $newcurriculo->id }}</strong></h2>
    <hr class="my-4">
    <p class="lead">Nome: {{ $newcurriculo->nome }}</p>
    <p class="lead">CPF: {{ $newcurriculo->cpf }} RG: {{ $newcurriculo->rg }}</p>
    <h3>Função: {{ $newcurriculo->funcao->descricao }}</h3>  
  </div>

  <div class="container">
    <p class="lead">Data/Hora: {{ $newcurriculo->created_at->format('d/m/Y H:i') }}</p>
  </div>

  <div class="container">
    <a class="btn btn-warning btn-sm" role="button" onclick="window.print();return false;"><i class="fas fa-print"></i> Imprimir</a>
  </div>
  
</div>

@endsection
