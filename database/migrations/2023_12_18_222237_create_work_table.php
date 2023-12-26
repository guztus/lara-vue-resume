<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id');
            $table->string('employer');
            $table->string('position');
            $table->string('type')->nullable();
            $table->string('from');
            $table->string('currentlyActive')->default(0);
            $table->string('to')->nullable();
            $table->string('description', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work');
    }
}
