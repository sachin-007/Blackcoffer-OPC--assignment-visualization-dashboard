<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->year('end_year')->nullable();
            $table->decimal('citylng', 10, 7)->nullable();
            $table->decimal('citylat', 10, 7)->nullable();
            $table->integer('intensity')->nullable();
            $table->string('sector')->nullable();
            $table->string('topic')->nullable();
            $table->text('insight')->nullable();
            $table->string('swot')->nullable();
            $table->string('url')->nullable();
            $table->string('region')->nullable();
            $table->year('start_year')->nullable();
            $table->integer('impact')->nullable();
            $table->timestamp('added')->nullable();
            $table->timestamp('published')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('relevance')->nullable();
            $table->string('pestle')->nullable();
            $table->string('source')->nullable();
            $table->string('title')->nullable();
            $table->integer('likelihood')->nullable();
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
        Schema::dropIfExists('data');
    }
}
