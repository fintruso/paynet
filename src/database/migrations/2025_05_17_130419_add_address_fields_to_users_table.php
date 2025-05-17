<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cep', 9)->after('password');
            $table->string('logradouro')->after('cep');
            $table->string('numero')->after('logradouro');
            $table->string('complemento')->nullable()->after('numero');
            $table->string('bairro')->after('complemento');
            $table->string('cidade')->after('bairro');
            $table->string('estado', 2)->after('cidade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'cep',
                'logradouro',
                'numero',
                'complemento',
                'bairro',
                'cidade',
                'estado',
            ]);
        });
    }
}
