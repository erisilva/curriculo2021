<?php
namespace App\Http\Controllers;

use App\Curriculo;
use App\Funcao;
use App\Formacao;

use Response;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon; // tratamento de datas

use App\Rules\Cpf; // validação de um cpf

use Illuminate\Support\Facades\Redirect; // para poder usar o redirect

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(403, 'Acesso negado.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcoes = Funcao::orderBy('id', 'asc')->get();
        
        $formacoes = Formacao::orderBy('id', 'asc')->get();

        return view('cadastros.create', compact('funcoes', 'formacoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'nascimento' => 'required',
            'cpf' => 'required',
            'cpf' => new Cpf,
            'rg' => 'required',
            'nacionalidade' => 'required',
            'email' => 'required',
            'cel1' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'funcao_id' => 'required',
            'formacao_id' => 'required',
            'registro' => 'required',
           
            'declaro1' => 'required',
            'declaro2' => 'required',
            'declaro3' => 'required',
            'declaro4' => 'required',
            'declaro5' => 'required',
            'arquivo1' => 'required|mimes:pdf,doc,rtf,txt|max:2000',
            'arquivo2' => 'mimes:pdf,doc,rtf,txt|max:5120',
            'arquivo3' => 'mimes:pdf,doc,rtf,txt|max:5120',
            'arquivo4' => 'mimes:pdf,doc,rtf,txt|max:5120',
            'arquivo5' => 'mimes:pdf,doc,rtf,txt|max:5120',
            'arquivo6' => 'mimes:pdf,doc,rtf,txt|max:5120',

        ],
        [
            'nome.required' => 'O nome do candidato é obrigatório',
            'nascimento.required' => 'A data de nascimento do candidato é obrigatória',
            'cpf.required' => 'O CPF do candidato é obrigatório',
            'rg.required' => 'O RG do candidato é obrigatório',
            'nacionalidade.required' => 'A nacionalidade do candidato é obrigatório',
            'email.required' => 'O e-mail do candidato é obrigatório',
            'cel1.required' => 'É obrigatório digitar um número de celular para contato',
            'registro.required' => 'É obrigatório digitar o registro de classe',
            'funcao_id.required' => 'Selecione a função na lista',
            'formacao_id.required' => 'Selecione a formação na lista',


            'declaro1.required' => 'Você precisa aceitar as condições exigidas de acordo com o edital clicando na caixa acima',
            'declaro2.required' => 'Você precisa aceitar as condições exigidas de acordo com o edital clicando na caixa acima',
            'declaro3.required' => 'Você precisa aceitar as condições exigidas de acordo com o edital clicando na caixa acima',
            'declaro4.required' => 'Você precisa aceitar as condições exigidas de acordo com o edital clicando na caixa acima',
            'declaro5.required' => 'Você precisa aceitar as condições exigidas de acordo com o edital clicando na caixa acima',
            'arquivo1.required' => 'Esse anexo é requerido para essa inscrição',
            'arquivo1.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo1.max' => 'O arquivo anexado não pode ter mais de 5MB',
            'arquivo2.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo2.max' => 'O arquivo anexado não pode ter mais de 5MB',
            'arquivo3.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo3.max' => 'O arquivo anexado não pode ter mais de 5MB',
            'arquivo4.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo4.max' => 'O arquivo anexado não pode ter mais de 5MB',
            'arquivo5.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo5.max' => 'O arquivo anexado não pode ter mais de 5MB',
            'arquivo6.mimes' => 'O arquivo anexado deve ser das seguintes extensões: pdf, doc, rft ou txt',
            'arquivo6.max' => 'O arquivo anexado não pode ter mais de 5MB',
        ]);


         $input = $request->all();

        // ajusta data
        if ($input['nascimento'] != ""){
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('nascimento'))->format('Y-m-d');           
            $input['nascimento'] =  $dataFormatadaMysql;            
        }


        // geração de uma string aleatória de tamanho configurável
        function generateRandomString($length = 10) {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }

        if (!isset($input['usarNomeSocial'])) {
            $input['usarNomeSocial'] = 'n';
        }

        if (!isset($input['negro'])) {
            $input['negro'] = 'n';
        }

        if (!isset($input['deficiente'])) {
            $input['deficiente'] = 'n';
        }

        // ajusta no nome e cpf para que seja usado no nome do arquivo
        $nome = str_replace(' ', '-', $input['nome']);
        $nome = preg_replace('/[^A-Za-z0-9\-]/', '', $nome);
        $cpf = preg_replace('/[^0-9]/', '', $input['cpf']);

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo1') && $request->file('arquivo1')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-experiencia.' . $request->arquivo1->extension();
            $path = $request->file('arquivo1')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo1Nome'] =  $nome_arquivo;  
            $input['arquivo1Local'] =  $local;  
            $input['arquivo1Url'] =  $url;
        }

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo2') && $request->file('arquivo2')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-especializacao.' . $request->arquivo2->extension();
            $path = $request->file('arquivo2')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo2Nome'] =  $nome_arquivo;  
            $input['arquivo2Local'] =  $local;  
            $input['arquivo2Url'] =  $url;
        }

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo3') && $request->file('arquivo3')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-mestrado.' . $request->arquivo3->extension();
            $path = $request->file('arquivo3')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo3Nome'] =  $nome_arquivo;  
            $input['arquivo3Local'] =  $local;  
            $input['arquivo3Url'] =  $url;
        }

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo4') && $request->file('arquivo4')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-doutorado.' . $request->arquivo4->extension();
            $path = $request->file('arquivo4')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo4Nome'] =  $nome_arquivo;  
            $input['arquivo4Local'] =  $local;  
            $input['arquivo4Url'] =  $url;
        }

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo5') && $request->file('arquivo5')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-preceptoria.' . $request->arquivo5->extension();
            $path = $request->file('arquivo5')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo5Nome'] =  $nome_arquivo;  
            $input['arquivo5Local'] =  $local;  
            $input['arquivo5Url'] =  $url;
        }

        $local = generateRandomString(20);
        if ($request->hasFile('arquivo6') && $request->file('arquivo6')->isValid()) {            
            $nome_arquivo =  $nome . '-' . $cpf . '-academica.' . $request->arquivo6->extension();
            $path = $request->file('arquivo6')->storeAs($local, $nome_arquivo, 'public');
            $url = asset('storage/' . $local . '/' . $nome_arquivo);            
            $input['arquivo6Nome'] =  $nome_arquivo;  
            $input['arquivo6Local'] =  $local;  
            $input['arquivo6Url'] =  $url;
        }

        $newcurriculo = Curriculo::create($input); //salva

        return view('cadastros.recibo', compact('newcurriculo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(403, 'Acesso negado.');
    }
}
