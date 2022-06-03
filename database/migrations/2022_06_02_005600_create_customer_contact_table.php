<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contact', function (Blueprint $table) {
            // Indica ao ORM para criar uma coluna 'id' INT AUTOINCREMENT
            $table->id();

            // Indica ao ORM para criar uma coluna 'id_costumer' do tipo INT FOREIGN_KEY, referenciando o ID da tabela customer
            $table->foreignId('id_customer')->constrained('customer');

            // Indica ao ORM para criar uma coluna 'nome_contact' do tipo VARCHAR
            $table->string('nome_contact');

            // Indica ao ORM para criar uma coluna 'email_contact' do tipo VARCHAR
            $table->string('email_contact');

            // Indica ao ORM para criar uma coluna 'cpf' do tipo CHAR com limite de 11 caracteres
            $table->char('cpf', '11');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_contact');
    }
};
