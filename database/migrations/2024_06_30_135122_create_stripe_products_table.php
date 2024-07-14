<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stripe_products', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('active');
            $table->string('default_price')->nullable();
            $table->boolean('livemode');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stripe_products');
    }
};
