<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTeacherIdFromGradesTable extends Migration
{
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn('teacher_id');
        });
    }
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
        });
    }
}
