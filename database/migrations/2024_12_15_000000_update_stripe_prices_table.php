<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stripe_prices', function (Blueprint $table) {
            $table->string('checkout_success_route')->after('unit_amount')->nullable();
            $table->string('checkout_cancelled_route')->after('checkout_success_route')->nullable();
            $table->boolean('allow_promotions')->after('checkout_cancelled_route')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('stripe_prices', function (Blueprint $table) {
            $table->dropColumn('checkout_success_route');
            $table->dropColumn('checkout_cancelled_route');
            $table->dropColumn('allow_promotions');
        });
    }
};
