<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('athletes', function (Blueprint $table) {
            $table->dropUnique([
                'name_first',
                'name_last',
            ]);
            $table->unique([
                'team_id',
                'name_last',
                'name_first',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('athletes', function (Blueprint $table) {
            $table->dropUnique([
                'team_id',
                'name_last',
                'name_first',
            ]);
            $table->unique([
                'name_first',
                'name_last',
            ]);
        });
    }
};
