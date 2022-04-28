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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();            
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->text('note');
            $table->timestamps();

            // Create foreign key
            // $table->unsignedBigInteger('client_id');
            // $table->foreign('client_id')->references('id')->on('clients');
            // or
            // $table->foreignId('client_id')->constrained();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};