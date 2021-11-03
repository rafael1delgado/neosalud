<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservationsToSicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sics', function (Blueprint $table) {
            $table->string('diagnostic_hipotesis')->after('estado_civil');
            $table->string('origin_observation')->after('diagnostic_hipotesis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sics', function (Blueprint $table) {
            $table->dropColumn('diagnostic_hipotesis');
            $table->dropColumn('origin_observatio');
        });
    }
}
