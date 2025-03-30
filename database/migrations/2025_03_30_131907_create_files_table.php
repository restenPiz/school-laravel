<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->enum('visibility', ['public', 'restricted'])->default('restricted'); // Controle de acesso

            //?Foreign Keys
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('grades')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
