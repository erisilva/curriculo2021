<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->id();

            $table->string('nome');

            $table->enum('usarNomeSocial', ['s', 'n']);

            $table->enum('negro', ['s', 'n']);

            $table->enum('deficiente', ['s', 'n']);

            $table->string('nomeSocial');

            $table->string('email');

            $table->string('nacionalidade');
            
            $table->string('cpf');

            $table->string('rg');

            $table->dateTime('nascimento');


            // endereço
            $table->string('cep');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('uf');

            $table->string('cel1'); // ogrigatorio
            $table->string('cel2')->nullable();

            // funcao escolhida na inscricao
            $table->biginteger('funcao_id')->unsigned(); // fk

            // curso superior
            $table->biginteger('formacao_id')->unsigned(); // fk

            $table->string('registro')->nullable(); // registro de classe - opcional

            // anexos
            $table->string('arquivo1Nome'); // nome do arquivo
            $table->string('arquivo1Local'); // pasta onde será salvo o arquivo
            $table->text('arquivo1Url'); // url completa do arquivo

            $table->string('arquivo2Nome')->nullable(); // nome do arquivo
            $table->string('arquivo2Local')->nullable(); // pasta onde será salvo o arquivo
            $table->text('arquivo2Url')->nullable(); // url completa do arquivo

            $table->string('arquivo3Nome')->nullable(); // nome do arquivo
            $table->string('arquivo3Local')->nullable(); // pasta onde será salvo o arquivo
            $table->text('arquivo3Url')->nullable(); // url completa do arquivo

            $table->string('arquivo4Nome')->nullable(); // nome do arquivo
            $table->string('arquivo4Local')->nullable(); // pasta onde será salvo o arquivo
            $table->text('arquivo4Url')->nullable(); // url completa do arquivo

            $table->string('arquivo5Nome')->nullable(); // nome do arquivo
            $table->string('arquivo5Local')->nullable(); // pasta onde será salvo o arquivo
            $table->text('arquivo5Url')->nullable(); // url completa do arquivo

            $table->string('arquivo6Nome')->nullable(); // nome do arquivo
            $table->string('arquivo6Local')->nullable(); // pasta onde será salvo o arquivo
            $table->text('arquivo6Url')->nullable(); // url completa do arquivo


            $table->timestamps();

            $table->foreign('funcao_id')->references('id')->on('funcaos')->onDelete('cascade');
            $table->foreign('formacao_id')->references('id')->on('formacaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculos', function (Blueprint $table) {
            $table->dropForeign('curriculos_funcao_id_foreign');
            $table->dropForeign('curriculos_formacao_id_foreign');
        });

        Schema::dropIfExists('curriculos');
    }
}
