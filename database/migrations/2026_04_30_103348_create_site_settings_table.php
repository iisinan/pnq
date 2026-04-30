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
        Schema::create('site_settings', function (Blueprint $バランス) {
            $バランス->id();
            $バランス->string('key')->unique();
            $バランス->text('value')->nullable();
            $バランス->string('type')->default('text'); // text, textarea, image
            $バランス->string('group')->default('general');
            $バランス->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
