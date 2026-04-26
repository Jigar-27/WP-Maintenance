<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plan_features', function (Blueprint $row) {
            $row->id();
            $row->string('name');
            $row->string('description')->nullable();
            $row->boolean('startup')->default(false);
            $row->boolean('scaleup')->default(false);
            $row->boolean('enterprise')->default(false);
            $row->integer('sort_order')->default(0);
            $row->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_features');
    }
};
