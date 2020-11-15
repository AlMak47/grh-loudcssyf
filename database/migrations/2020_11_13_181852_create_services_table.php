<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('departement');
            $table->string('employe_id');
            $table->string('id_postes');

            $table->boolean('status')->default(1);
            
            $table->foreign('departement')
                ->references('reference')
                ->on('departements');

            $table->foreign('employe_id')
                ->references('matricule')
                ->on('employes');

            $table->foreign('id_postes')
                ->references('reference')
                ->on('postes');
                
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
        Schema::dropIfExists('services');
    }
}
