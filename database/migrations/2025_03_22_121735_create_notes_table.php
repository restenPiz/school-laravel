<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->decimal('first', 5, 2)->nullable();
            $table->decimal('second', 5, 2)->nullable();
            $table->decimal('third', 5, 2)->nullable();
            $table->decimal('work', 5, 2)->nullable();
            $table->decimal('exam', 5, 2)->nullable();

            // Atualizar o status, que deve ser baseado nas notas
            $table->enum('status', ['aprovado', 'excluido'])->default('aprovado');

            //?Foreign Keys
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
