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
        Schema::create('sommaire_items', function (Blueprint $table) {
            $table->id();
            $table->string("libelle_sommaire");
            $table->integer("page_num");
            $table->foreignId("cour_id")->constrained("cours");
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
        Schema::dropIfExists('sommaire_items');
    }
};
