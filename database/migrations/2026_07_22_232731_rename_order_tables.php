<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('order__items', 'order_items');
        Schema::rename('order__addresses', 'order_addresses');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('order_items', 'order__items');
        Schema::rename('order_addresses', 'order__addresses');
    }
};