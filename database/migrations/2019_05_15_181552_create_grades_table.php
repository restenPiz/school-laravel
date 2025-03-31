<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_numeric');
            $table->string('class_name');
            $table->string('class_description');
            //*Start with the fees payment columns
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
