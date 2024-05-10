<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regattas', function (Blueprint $table) {
            $table->unsignedSmallInteger('default_distance')->after('date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('regattas', function (Blueprint $table) {
            $table->dropColumn('default_distance');
        });
    }
};
