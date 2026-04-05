<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->foreignId('shipping_method_id')->nullable()->after('user_id')->constrained('shipping_methods')->nullOnDelete();
            $table->decimal('shipping_total', 10, 2)->default(0)->after('total');
            $table->decimal('sub_total', 10, 2)->default(0)->after('shipping_total');
            $table->string('payment_status')->default('pending')->after('statut');
            $table->string('payment_method')->default('paypal')->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('shipping_method_id');
            $table->dropColumn(['shipping_total', 'sub_total', 'payment_status', 'payment_method', 'paid_at']);
        });
    }
};
