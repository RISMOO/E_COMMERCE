<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_intent_id')->unique();//notre commande payé
            $table->integer('amount');//le montant de la commande
            $table->datetime('payment_created_at');
            $table->unsignedBigInteger('user_id');//id de lutilisateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//cle etrangere id relié a l'id de la table users//cascade poue eviter d'avoir unn id fantome
            $table->text('products');

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
        Schema::dropIfExists('orders');
    }
}
