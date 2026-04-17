<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->text('before_image')->nullable()->change();
            $table->text('after_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('before_image')->nullable()->change();
            $table->string('after_image')->nullable()->change();
        });
    }
};
