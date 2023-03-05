<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterlinkToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->boolean('interlink')->default(false);
            $table->string('url')->nullable();
            $table->string('interlink_image')->nullable();
            $table->string('time_in_second')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('featured');
            $table->dropColumn('url');
            $table->dropColumn('interlink_image');
            $table->dropColumn('time_in_second');
        });
    }
}
