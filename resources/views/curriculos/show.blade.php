@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('curriculo.index') }}">Lista de Currículos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Exibir Registro</li>
    </ol>
  </nav>
</div>
<div class="container">

  <form>
    
    <div class="form-row">
      <div class="form-group col-md-6">
        <div class="p-3 bg-primary text-white text-right h2">Nº {{ $curriculo->id }}</div>    
      </div>
      <div class="form-group col-md-3">
        <label for="dia">Data</label>
        <input type="text" class="form-control" name="dia" value="{{ $curriculo->created_at->format('d/m/Y') }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="hora">Hora</label>
        <input type="text" class="form-control" name="hora" value="{{ $curriculo->created_at->format('H:i') }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="nome">Nome do Candidato</label>
        <input type="text" class="form-control" name="nome" value="{{ $curriculo->nome }}" readonly>
      </div>    
      <div class="form-group col-md-2 d-flex align-items-end">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="usarNomeSocial" id="usarNomeSocial" {{ $curriculo->usarNomeSocial == 's' ? 'checked' : '' }}>
          <label class="custom-control-label" for="usarNomeSocial">Transgênero</label>
        </div>
      </div>
      <div class="form-group col-md-5">
        <label for="nomeSocial">Nome Social</label>
        <input type="text" class="form-control" name="nomeSocial" value="{{ $curriculo->nomeSocial }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="funcao">Funcao</label>
        <input type="text" class="form-control" name="funcao" value="{{ $curriculo->funcao->descricao }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="rg">RG</label>
        <input type="text" class="form-control" name="rg" id="rg" value="{{ $curriculo->rg }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control" name="cpf" id="cpf" value="{{ $curriculo->cpf }}" readonly>
      </div>     
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nacionalidade">Nacionalidade</label>
        <input type="text" class="form-control" name="nacionalidade" value="{{ $curriculo->nacionalidade }}" readonly>
      </div>
      <div class="form-group col-md-2">
        <label for="nascimento">Data Nascimento</label>
        <input type="text" class="form-control" name="nascimento" id="nascimento" value="{{ $curriculo->nascimento->format('d/m/Y') }}" readonly>
      </div>
      <div class="form-group col-md-2 d-flex align-items-end">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="negro" id="negro" {{ $curriculo->negro == 's' ? 'checked' : '' }}>
          <label class="custom-control-label" for="negro">Negro/Pardo</label>
        </div>
      </div>
      <div class="form-group col-md-2 d-flex align-items-end">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="deficiente" id="deficiente" {{ $curriculo->deficiente == 's' ? 'checked' : '' }}>
          <label class="custom-control-label" for="deficiente">Deficiente</label>
        </div>
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="cep">CEP</label>  
        <input type="text" class="form-control" name="cep" id="cep" value="{{ $curriculo->cep }}" readonly>
      </div>
      <div class="form-group col-md-5">  
        <label for="logradouro">Logradouro</label>  
        <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{ $curriculo->logradouro }}" readonly>
      </div> 
      <div class="form-group col-md-2">  
        <label for="numero">Nº</label>  
        <input type="text" class="form-control" name="numero" id="numero" value="{{ $curriculo->numero }}" readonly>

      </div>
      <div class="form-group col-md-3">  
        <label for="complemento">Complemento</label>  
        <input type="text" class="form-control" name="complemento" id="complemento" value="{{ $curriculo->complemento }}" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="bairro">Bairro</label>  
        <input type="text" class="form-control" name="bairro" id="bairro" value="{{ $curriculo->bairro }}" readonly>
      </div>
      <div class="form-group col-md-6">  
        <label for="cidade">Cidade</label>  
        <input type="text" class="form-control" name="cidade" id="cidade" value="{{ $curriculo->cidade }}" readonly>
      </div> 
      <div class="form-group col-md-2">  
        <label for="uf">UF</label>  
        <input type="text" class="form-control" name="uf" id="uf" value="{{ $curriculo->uf }}" readonly>
      </div>
    </div>    


    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" name="email" value="{{ $curriculo->email }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="cel1">N&lowast; Celular</label>
        <input type="text" class="form-control" name="cel1" id="cel1" value="{{ $curriculo->cel1 }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="cel2">N&lowast; Celular Alternativo</label>
        <input type="text" class="form-control" name="cel2" id="cel2" value="{{ $curriculo->cel2 }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-8">
        <label for="email">Formação</label>
        <input type="text" class="form-control" name="email" value="{{ $curriculo->formacao->descricao }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="cel1">Registro de Classe</label>
        <input type="text" class="form-control" name="cel1" id="cel1" value="{{ $curriculo->registro }}" readonly>
      </div>
    </div>

    <br>

    <div class="container bg-primary text-white">
        <p class="text-center">Anexos</p>
    </div>

    <div class="form-group">
      <div class="table-responsive"> 
      
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Documento</th>
              <th scope="col">Link</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Comprovante de experiência</td>
              <td>
                @if (isset($curriculo->arquivo1Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo1Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Comprovante(s) de Especialização(ções) lato sensu</td>
              <td>
                @if (isset($curriculo->arquivo2Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo2Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Comprovante(s) de Mestrado</td>
              <td>
                @if (isset($curriculo->arquivo3Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo3Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Comprovante(s) de Doutorado</td>
              <td>
                @if (isset($curriculo->arquivo4Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo4Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Comprovante(s) de experiência em preceptoria</td>
              <td>
                @if (isset($curriculo->arquivo5Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo5Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>Comprovante de Graduação</td>
              <td>
                @if (isset($curriculo->arquivo6Url))
                <a class="btn btn-warning btn-sm" role="button" href="{{ $curriculo->arquivo6Url }}" target="_blank">Download</a>   
                @else
                <strong>-</strong>    
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>  
    </div>

  </form>

  <br>
  <div class="container">
    <a href="{{ route('curriculo.index') }}" class="btn btn-primary" role="button"><i class="fas fa-long-arrow-alt-left"></i> Voltar</i></a>
    <a href="#" class="btn btn-primary" role="button" onclick="window.print();return false;"><i class="fas fa-print"></i> Imprimir</a>

  </div>

</div>

@endsection
