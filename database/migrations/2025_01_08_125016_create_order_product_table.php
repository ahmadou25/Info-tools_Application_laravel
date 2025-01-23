<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade'); // Référence à une commande
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // Référence à un produit
            $table->integer('quantity'); // Quantité du produit dans cette commande
            $table->decimal('price', 10, 2); // Prix du produit au moment de la commande
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}

