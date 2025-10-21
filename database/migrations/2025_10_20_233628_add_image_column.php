<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('prodotti', function (Blueprint $table) {
            $table->string('image')->nullable(); // nullable se vuoi che possa essere vuoto
        });
    }

    public function down()
    {
        Schema::table('prodotti', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
