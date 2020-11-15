<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registre_presences', function (Blueprint $table) {
            $table->string('id_pointage')->primary();
            $table->date('date_du_jour');
            $table->time('heure_arrivee');
            $table->time('heure_depart')->nullable();
            $table->float('position_long');
            $table->float('position_lat');
            $table->text('motif_absence')->nullable();
            $table->boolean('status_paiement')->default(true);
            $table->string('id_employe');
            $table->timestamps();

            $table->foreign('id_employe')
                ->references('matricule')
                ->on('employes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registre_presences');
    }
}
