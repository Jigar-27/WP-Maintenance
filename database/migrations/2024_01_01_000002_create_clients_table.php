<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website_url');
            $table->string('wp_admin_url')->nullable();
            $table->string('wp_username')->nullable();
            $table->text('wp_password_encrypted')->nullable();
            $table->string('hosting_provider')->nullable();
            $table->string('hosting_login_url')->nullable();
            $table->string('hosting_username')->nullable();
            $table->text('hosting_password_encrypted')->nullable();
            $table->string('sftp_host')->nullable();
            $table->string('sftp_username')->nullable();
            $table->text('sftp_password_encrypted')->nullable();
            $table->integer('sftp_port')->default(22);
            $table->string('billing_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_country')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
