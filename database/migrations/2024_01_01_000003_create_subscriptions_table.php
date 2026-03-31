<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('pending');
            $table->enum('payment_status', ['paid', 'pending', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->boolean('auto_renew')->default(true);
            $table->boolean('reminder_15_sent')->default(false);
            $table->boolean('reminder_10_sent')->default(false);
            $table->boolean('reminder_5_sent')->default(false);
            $table->boolean('reminder_0_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
