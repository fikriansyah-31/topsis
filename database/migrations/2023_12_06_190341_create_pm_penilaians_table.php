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
        Schema::create('pm_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId("alternatif_id")->constrained("alternatif", "id");
            $table->foreignId("kriteria_id")->constrained("kriteria", "id");
            $table->integer('nilai')->default(1);
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
        Schema::dropIfExists('pm_penilaian');
    }
};
