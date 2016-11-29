<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMalTekliflerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mal_teklifler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ilan_mal_id')->unsigned();
            $table->foreign('ilan_mal_id')->references('id')->on('ilan_mallar')->onDelete('cascade');
            $table->integer('teklif_id')->unsigned();
            $table->foreign('teklif_id')->references('id')->on('teklif')->onDelete('cascade');
            $table->string('kdv_dahil_fiyat');
            $table->string('kdv_haric_fiyat');
            $table->string('kdv_orani');
            $table->integer('para_birimleri_id')->unsigned();
            $table->foreign('para_birimleri_id')->references('id')->on('para_birimleri')->onDelete('cascade');
            $table->date('tarih');
            $table->integer('firma_kullanicilar_id')->unsigned();
            $table->foreign('firma_kullanicilar_id')->references('id')->on('firma_kullanicilar')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('mal_teklifler');
    }
}
