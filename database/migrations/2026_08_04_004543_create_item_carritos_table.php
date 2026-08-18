<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_carritos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('carrito_id')->constrained('carritos');
            $table->foreignUuid('producto_id')->constrained('productos');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_carritos');
    }
};
