<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'preferred_date')) {
                $table->date('preferred_date')->nullable()->after('subject');
            }
            if (!Schema::hasColumn('contact_messages', 'preferred_time')) {
                $table->string('preferred_time', 20)->nullable()->after('preferred_date');
            }
            if (!Schema::hasColumn('contact_messages', 'service_selected')) {
                $table->string('service_selected')->nullable()->after('preferred_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['preferred_date', 'preferred_time', 'service_selected']);
        });
    }
};
