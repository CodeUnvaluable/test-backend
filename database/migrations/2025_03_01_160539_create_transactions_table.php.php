<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('crypto_type'); 
            $table->decimal('amount', 16, 8); 
            $table->enum('transaction_type', ['TRANSFER', 'BUY', 'SELL']);
            $table->enum('status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
