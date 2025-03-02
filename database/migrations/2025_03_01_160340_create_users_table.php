<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('balance_crypto_btc', 16, 8)->default(0);
            $table->decimal('balance_crypto_eth', 16, 8)->default(0);
            $table->decimal('balance_crypto_xrp', 16, 8)->default(0);
            $table->decimal('balance_crypto_doge', 16, 8)->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
