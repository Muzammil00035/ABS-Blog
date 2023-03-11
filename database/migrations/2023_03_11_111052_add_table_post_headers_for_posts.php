<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePostHeadersForPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // $table->integer('post_id')->nullable();
            
            $table->string('heading')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            // $table->foreign('post_id')
            //     ->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('post_headers');
    }
}
