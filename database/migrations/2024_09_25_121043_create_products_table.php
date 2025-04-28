<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name', 100);
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('category')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('image')->nullable(); // Stocker le nom ou chemin de l'image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}