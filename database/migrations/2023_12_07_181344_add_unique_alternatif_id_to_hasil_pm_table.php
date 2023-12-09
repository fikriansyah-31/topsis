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
        Schema::table('hasil_pm', function (Blueprint $table) {
            $table->unique('alternatif_id', 'alternatif_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_pm', function (Blueprint $table) {
            $table->dropUnique('alternatif_id_unique');
        });
    }
};
