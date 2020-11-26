<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique;
            $table->string('slug')->unique;
            $table->string('subtitle');
            $table->text('description');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();
        });
    }
///ensuite on creer un seeder php artisan make:seeder ProductsTableSeeder
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
