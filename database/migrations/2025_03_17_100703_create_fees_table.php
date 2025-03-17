<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type', ['monthly', 'quartely', 'yearly']);
            $table->integer('year');
            $table->date('due_date');
            $table->foreignId('class_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Valor da propina
            $table->enum('status', ['pending', 'paid'])->default('pending'); // Estado da propina
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
