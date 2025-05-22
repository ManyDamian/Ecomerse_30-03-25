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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // comprador
            //$table->foreignId('producto_id')->constrained()->onDelete('cascade'); // producto comprado
            $table->decimal('total', 10, 2);
            $table->string('ticket')->nullable(); // imagen del boucher (ruta en disco privado)
            $table->string('estado')->default('pendiente'); // pendiente, validada
            $table->timestamp('fecha_venta')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
