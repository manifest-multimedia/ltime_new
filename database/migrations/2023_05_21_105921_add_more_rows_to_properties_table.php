<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->date('year_built')->nullable();
            $table->string('rooms')->nullable();
            $table->string('garage')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('year_built')->nullable();
            $table->dropColumn('rooms')->nullable();
            $table->dropColumn('garage')->nullable();
            
        });
    }
};
