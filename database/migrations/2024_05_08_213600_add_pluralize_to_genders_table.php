<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('genders', function (Blueprint $table) {
            $table->boolean('pluralize')->after('color')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('genders', function (Blueprint $table) {
            $table->dropColumn('pluralize');
        });
    }
};
