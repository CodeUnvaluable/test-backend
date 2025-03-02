<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('order_type', ['BUY', 'SELL']);
            $table->string('crypto_type'); 
            $table->decimal('amount', 16, 8); 
            $table->decimal('price', 16, 2); 
            $table->enum('status', ['OPEN', 'CLOSED', 'CANCELLED'])->default('OPEN');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
