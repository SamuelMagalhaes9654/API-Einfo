<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('resposta_1');
            $table->string('resposta_2');
            $table->string('resposta_3');
            $table->unsignedBigInteger('resposta_4');
            $table->unsignedBigInteger('resposta_5');
            $table->string('resposta_6');
            $table->unsignedBigInteger('resposta_7');
            $table->text('resposta_8');
            $table->text('resposta_9');
            $table->string('resposta_10');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('evento_id')->references('id')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
