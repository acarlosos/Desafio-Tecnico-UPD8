<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CidadesRepresentantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidade_representante', function (Blueprint $table) {
            $table->unsignedBigInteger( 'cidade_id' );
            $table->unsignedBigInteger( 'representante_id' );
            $table->primary( [ 'cidade_id', 'representante_id' ] );
            $table->foreign( 'cidade_id' )->references( 'id' )->on( 'cidades' );
            $table->foreign( 'representante_id' )->references( 'id' )->on( 'representantes' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidade_representante');
    }
}
