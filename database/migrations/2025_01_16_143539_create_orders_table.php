<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user
            $table->string('status')->default('pending'); // Order status (pending, completed, etc.)
            $table->integer('total_price'); // Total price of the order
            $table->timestamp('ordered_at')->nullable(); // Time the order was placed
            $table->timestamps();
            $table->string('adresa_livrare');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
