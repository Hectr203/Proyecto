<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('products'); // Relación con la tabla de productos
            $table->integer('cantidad');
            $table->decimal('precio_usd', 10, 2);
            $table->decimal('precio_mxn', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
