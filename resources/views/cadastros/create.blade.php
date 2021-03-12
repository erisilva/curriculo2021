@extends('layouts.clear')

@section('css-header')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

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
    @if(Session::has('create_curriculo'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <div class="text-center py-5">
        <h2>{{ session('create_curriculo') }}</h2>
        <hr class="my-4">
        <p class="lead">Obrigado por cadastrar seu currículo, em breve entraremos em contato</p>
      </div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> Todos campos marcados com <strong>*</strong> são de preenchimento obrigatório.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="container">
      <form method="POST" action="{{ route('cadastro.store') }}" enctype="multipart/form-data">
      @csrf
      
      <div class="form-group">
          <label for="nome">Nome do Candidato<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') ?? '' }}">
          @if ($errors->has('nome'))
          <div class="invalid-feedback">
          {{ $errors->first('nome') }}
          </div>
          @endif
      </div>

      <div class="form-row">
        <div class="form-group col-md-2 d-flex align-items-end">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="usarNomeSocial" id="usarNomeSocial" value="s">
            <label class="custom-control-label" for="usarNomeSocial">Transgênero</label>
          </div>
        </div>
        <div class="form-group col-md-10">
          <label for="nomeSocial">Usar o nome social<strong class="text-warning">(opcional)</strong></label>
          <input type="text" class="form-control{{ $errors->has('nomeSocial') ? ' is-invalid' : '' }}" name="nomeSocial" value="{{ old('nomeSocial') ?? '' }}">
          @if ($errors->has('nomeSocial'))
          <div class="invalid-feedback">
          {{ $errors->first('nomeSocial') }}
          </div>
          @endif
        </div>
      </div>  

      <div class="form-group">
          <label for="funcao_id">Função<strong  class="text-danger">(*)</strong></label>
          <select class="form-control {{ $errors->has('funcao_id') ? ' is-invalid' : '' }}" name="funcao_id" id="funcao_id">
            <option value="" selected="true">Selecione ...</option>        
            @foreach($funcoes as $funcao)
            <option value="{{$funcao->id}}" {{ old("funcao_id") == $funcao->id ? "selected":"" }}>{{$funcao->descricao}}</option>
            @endforeach
          </select>
          @if ($errors->has('funcao_id'))
          <div class="invalid-feedback">
          {{ $errors->first('funcao_id') }}
          </div>
          @endif
      </div>  


      <div class="form-row">
          <div class="form-group col-md-3">
          <label for="nascimento">Data Nascimento<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('nascimento') ? ' is-invalid' : '' }}" name="nascimento" id="nascimento" value="{{ old('nascimento') ?? '' }}" autocomplete="off">
          @if ($errors->has('nascimento'))
          <div class="invalid-feedback">
          {{ $errors->first('nascimento') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-3">
          <label for="cpf">CPF<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" id="cpf" value="{{ old('cpf') ?? '' }}">
          @if ($errors->has('cpf'))
          <div class="invalid-feedback">
          {{ $errors->first('cpf') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-3">
          <label for="rg">RG<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('rg') ? ' is-invalid' : '' }}" name="rg" id="rg" value="{{ old('rg') ?? '' }}">
          @if ($errors->has('rg'))
          <div class="invalid-feedback">
          {{ $errors->first('rg') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-3">
          <label for="nacionalidade">Nacionalidade<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('nacionalidade') ? ' is-invalid' : '' }}" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade') ?? '' }}">
          @if ($errors->has('nacionalidade'))
          <div class="invalid-feedback">
          {{ $errors->first('nacionalidade') }}
          </div>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="deficiente" id="deficiente" value="s"  {{ old("deficiente") == "s" ? "checked":"" }}>
            <label class="form-check-label" for="deficiente">Deficiente</label>
          </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="negro" id="negro" value="s"  {{ old("negro") == "s" ? "checked":"" }}>
            <label class="form-check-label" for="negro">Negro/Pardo</label>
          </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="email">E-mail<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? '' }}">
          @if ($errors->has('email'))
          <div class="invalid-feedback">
          {{ $errors->first('email') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label for="cel1">N° Celular<strong  class="text-danger">(*)</strong></label>
          <input type="text" class="form-control{{ $errors->has('cel1') ? ' is-invalid' : '' }}" name="cel1" id="cel1" value="{{ old('cel1') ?? '' }}">
          @if ($errors->has('cel1'))
          <div class="invalid-feedback">
          {{ $errors->first('cel1') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label for="cel2">N&lowast; Celular Alternativo<strong  class="text-warning">(opcional)</strong></label>
          <input type="text" class="form-control" name="cel2" id="cel2" value="{{ old('cel2') ?? '' }}">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-8">
          <label for="formacao_id">Curso Superior<strong  class="text-danger">(*)</strong></label>
          <select class="form-control {{ $errors->has('formacao_id') ? ' is-invalid' : '' }}" name="formacao_id" id="formacao_id">
            <option value="" selected="true">Selecione ...</option>        
            @foreach($formacoes as $formacao)
            <option value="{{$formacao->id}}" {{ old("formacao_id") == $formacao->id ? "selected":"" }}>{{$formacao->descricao}}</option>
            @endforeach
          </select>
          @if ($errors->has('formacao_id'))
          <div class="invalid-feedback">
          {{ $errors->first('formacao_id') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-4">
          <label for="registro">Registro do Conselho <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('registro') ? ' is-invalid' : '' }}" name="registro" id="registro" value="{{ old('registro') ?? '' }}">
          @if ($errors->has('registro'))
          <div class="invalid-feedback">
          {{ $errors->first('registro') }}
          </div>
          @endif
        </div>  
      </div>

      <div class="form-row">
        <div class="form-group col-md-2">
          <label for="cep">CEP<strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }}" name="cep" id="cep" value="{{ old('cep') ?? '' }}">
          @if ($errors->has('cep'))
          <div class="invalid-feedback">
          {{ $errors->first('cep') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-5">  
          <label for="logradouro">Logradouro <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" name="logradouro" id="logradouro" value="{{ old('logradouro') ?? '' }}">
          @if ($errors->has('logradouro'))
          <div class="invalid-feedback">
          {{ $errors->first('logradouro') }}
          </div>
          @endif
        </div> 
        <div class="form-group col-md-2">  
          <label for="numero">Nº <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" id="numero" value="{{ old('numero') ?? '' }}">
          @if ($errors->has('numero'))
          <div class="invalid-feedback">
          {{ $errors->first('numero') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-3">  
          <label for="complemento">Complemento <strong  class="text-warning">(opcional)</strong></label>  
          <input type="text" class="form-control" name="complemento" id="complemento" value="{{ old('complemento') ?? '' }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="bairro">Bairro <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" id="bairro" value="{{ old('bairro') ?? '' }}">
          @if ($errors->has('bairro'))
          <div class="invalid-feedback">
          {{ $errors->first('bairro') }}
          </div>
          @endif
        </div>
        <div class="form-group col-md-6">  
          <label for="cidade">Cidade <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" id="cidade" value="{{ old('cidade') ?? '' }}">
          @if ($errors->has('cidade'))
          <div class="invalid-feedback">
          {{ $errors->first('cidade') }}
          </div>
          @endif
        </div> 
        <div class="form-group col-md-2">  
          <label for="uf">UF <strong  class="text-danger">(*)</strong></label>  
          <input type="text" class="form-control{{ $errors->has('uf') ? ' is-invalid' : '' }}" name="uf" id="uf" value="{{ old('uf') ?? '' }}">
          @if ($errors->has('uf'))
          <div class="invalid-feedback">
          {{ $errors->first('uf') }}
          </div>
          @endif
        </div>
      </div>


      <div class="form-group">
          <div class="alert alert-warning" role="alert">
            <h3>Anexos</h3>
            <p><strong  class="text-danger">(!)</strong> Só serão aceitos os seguintes formatos: pdf, doc, rft ou txt</p>
            <p><strong  class="text-danger">(!)</strong> O arquivo não pode ter mais de <strong>5MB</strong></p>
            <p><strong  class="text-danger">(!)</strong> Anexar frente e verso de todos documentos em um único arquivo</p>
          </div>       
      </div>


      <div class="form-group">
        <ul class="list-group">
          <li class="list-group-item">
            <label for="arquivo1">Comprovante de experiência como trabalhador, e/ou referência técnica de saúde mental e/ou gestor em CAPS da Infância e Juventude e/ou experiência em Supervisão Clínica Institucional <strong  class="text-danger">(*)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo1') ? ' is-invalid' : '' }}" id="arquivo1" name="arquivo1">
            @if ($errors->has('arquivo1'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo1') }}
            </div>
            @endif
          </li>
          <li class="list-group-item">
            <label for="arquivo2">Comprovante(s) de Especialização(ções) lato sensu <strong  class="text-warning">(opcional)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo2') ? ' is-invalid' : '' }}" id="arquivo2" name="arquivo2">
            @if ($errors->has('arquivo2'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo2') }}
            </div>
            @endif
          </li>
          <li class="list-group-item">
            <label for="arquivo3">Comprovante(s) de Mestrado <strong  class="text-warning">(opcional)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo3') ? ' is-invalid' : '' }}" id="arquivo3" name="arquivo3">
            @if ($errors->has('arquivo3'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo3') }}
            </div>
            @endif
          </li>
          <li class="list-group-item">
            <label for="arquivo4">Comprovante(s) de Doutorado <strong  class="text-warning">(opcional)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo4') ? ' is-invalid' : '' }}" id="arquivo4" name="arquivo4">
            @if ($errors->has('arquivo4'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo4') }}
            </div>
            @endif
          </li>
          <li class="list-group-item">
            <label for="arquivo5">Comprovante(s) de experiência em preceptoria <strong  class="text-warning">(opcional)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo5') ? ' is-invalid' : '' }}" id="arquivo5" name="arquivo5">
            @if ($errors->has('arquivo5'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo5') }}
            </div>
            @endif
          </li>
          <li class="list-group-item">
            <label for="arquivo6">Comprovante de Graduação <strong  class="text-warning">(opcional)</strong></label>
            <input type="file" class="form-control-file  {{ $errors->has('arquivo6') ? ' is-invalid' : '' }}" id="arquivo6" name="arquivo6">
            @if ($errors->has('arquivo6'))
            <div class="invalid-feedback">
            {{ $errors->first('arquivo6') }}
            </div>
            @endif
          </li>
        </ul>
      </div>

      <div class="form-group">
        <div class="alert alert-primary" role="alert">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="declaro1" value="s">
            <label class="form-check-label" for="declaro1"><strong>Declaro não ser servidor concursado, contratado, função pública ou prestador de serviços do município de Contagem.</strong></label>            
          </div>    
        </div>
        @if ($errors->has('declaro1'))
        <div class="alert alert-danger" role="alert">
        <p><strong  class="text-danger">(!)</strong>{{ $errors->first('declaro1') }}
        </div>
        @endif
      </div>

      <div class="form-group">
        <div class="alert alert-primary" role="alert">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="declaro2" value="s">
            <label class="form-check-label" for="declaro2"><strong>Declaro não possuir acúmulo ilícito de cargos ou receber simultaneamente proventos de aposentadoria decorrentes dos art. 40 ou 42 e 142 da Constituição Federal Brasileira.</strong></label>            
          </div>    
        </div>
        @if ($errors->has('declaro2'))
        <div class="alert alert-danger" role="alert">
        <p><strong  class="text-danger">(!)</strong>{{ $errors->first('declaro2') }}
        </div>
        @endif
      </div>

      <div class="form-group">
        <div class="alert alert-primary" role="alert">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="declaro3" value="s">
            <label class="form-check-label" for="declaro3"><strong>Declaro que estou em dia com minhas obrigações eleitorais.</strong></label>            
          </div>    
        </div>
        @if ($errors->has('declaro3'))
        <div class="alert alert-danger" role="alert">
        <p><strong  class="text-danger">(!)</strong>{{ $errors->first('declaro3') }}
        </div>
        @endif
      </div>

      <div class="form-group">
        <div class="alert alert-primary" role="alert">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="declaro4" value="s">
            <label class="form-check-label" for="declaro4"><strong>Declaro que estou em dia com minhas obrigações militares.</strong></label>            
          </div>    
        </div>
        @if ($errors->has('declaro4'))
        <div class="alert alert-danger" role="alert">
        <p><strong  class="text-danger">(!)</strong>{{ $errors->first('declaro4') }}
        </div>
        @endif
      </div>

      <div class="form-group">
        <div class="alert alert-primary" role="alert">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="declaro5" value="s">
            <label class="form-check-label" for="declaro5"><strong>Declaro que estou ciente e de acordo com todos os termos do Edital e do presente Processo Seletivo Simplificado.</strong></label>            
          </div>    
        </div>
        @if ($errors->has('declaro5'))
        <div class="alert alert-danger" role="alert">
        <p><strong  class="text-danger">(!)</strong>{{ $errors->first('declaro5') }}
        </div>
        @endif
      </div>


      <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Enviar Currículo</button>
    
    </div>
  </div>
@endsection

@section('script-footer')
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script>
  $(document).ready(function(){

      $('#nascimento').datepicker({
          format: "dd/mm/yyyy",
          todayBtn: "linked",
          clearBtn: true,
          language: "pt-BR",
          autoclose: true,
          todayHighlight: true,
          forceParse: false
      });

      $("#cpf").inputmask({"mask": "999.999.999-99"});
      $("#cel1").inputmask({"mask": "(99) 99999-9999"});
      $("#cel2").inputmask({"mask": "(99) 99999-9999"});
      $("#cep").inputmask({"mask": "99.999-999"});

      function limpa_formulario_cep() {
          $("#logradouro").val("");
          $("#bairro").val("");
          $("#cidade").val("");
          $("#uf").val("");
      }
      
    $("#cep").blur(function () {
          var cep = $(this).val().replace(/\D/g, '');
          if (cep != "") {
              var validacep = /^[0-9]{8}$/;
              if(validacep.test(cep)) {
                  $("#logradouro").val("...");
                  $("#bairro").val("...");
                  $("#cidade").val("...");
                  $("#uf").val("...");
                  $.ajax({
                      dataType: "json",
                      url: "http://srvsmsphp01.brazilsouth.cloudapp.azure.com:9191/cep/?value=" + cep,
                      type: "GET",
                      success: function(json) {
                          if (json['erro']) {
                              limpa_formulario_cep();
                              console.log('cep inválido');
                          } else {
                              $("#bairro").val(json[0]['bairro']);
                              $("#cidade").val(json[0]['cidade']);
                              $("#uf").val(json[0]['uf'].toUpperCase());
                              $("#logradouro").val(json[0]['rua']);
                          }
                      }
                  });
              } else {
                  limpa_formulario_cep();
              }
          } else {
              limpa_formulario_cep();
          }
      });     

  });
</script>

@endsection      
