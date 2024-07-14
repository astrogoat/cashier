<?php

use Astrogoat\Cashier\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stripe_prices', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');
            $table->foreignIdFor(Product::class)->constrained('stripe_products');
            $table->boolean('active');
            $table->string('currency');
            $table->string('lookup_key')->nullable();
            $table->string('nickname')->nullable();
            $table->boolean('livemode');
            $table->string('type')->nullable();
            $table->integer('unit_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stripe_prices');
    }
};
