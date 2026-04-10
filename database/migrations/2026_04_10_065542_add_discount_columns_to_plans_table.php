<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->decimal('quarterly_discount', 5, 2)->default(10)->after('price');
            $table->decimal('yearly_discount', 5, 2)->default(20)->after('quarterly_discount');
        });
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['quarterly_discount', 'yearly_discount']);
        });
    }
};
