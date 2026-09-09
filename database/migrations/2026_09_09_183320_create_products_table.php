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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->text('descripcion_corta');
            $table->longText('descripcion_larga')->nullable();
            $table->decimal('precio_usd', 10, 2);
            $table->decimal('precio_mxn', 10, 2);
            // Permitimos que la imagen quede vacía por si el usuario no sube una
            $table->string('imagen')->nullable();
            $table->integer('stock')->default(0);
            $table->date('fecha_vigencia')->nullable();
            $table->boolean('activo')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
