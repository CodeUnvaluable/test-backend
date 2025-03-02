<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fiat_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('fiat_currency', ['THB', 'USD']);
            $table->decimal('amount', 18, 2);
            $table->enum('transaction_type', ['DEPOSIT', 'WITHDRAW']);
            $table->enum('status', ['PENDING', 'SUCCESS', 'FAILED']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiat_transactions');
    }
};
