<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {

            if (Schema::hasColumn('contacts', 'sentiment')) {
                $table->dropColumn('sentiment');
            }

            if (Schema::hasColumn('contacts', 'ai_reply')) {
                $table->dropColumn('ai_reply');
            }

        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {

            if (!Schema::hasColumn('contacts', 'sentiment')) {
                $table->string('sentiment')->nullable();
            }

            if (!Schema::hasColumn('contacts', 'ai_reply')) {
                $table->text('ai_reply')->nullable();
            }

        });
    }
};