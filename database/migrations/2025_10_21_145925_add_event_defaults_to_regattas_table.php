<?php

use App\Models\EventClass;
use App\Models\RaceType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regattas', function (Blueprint $table) {
            $table->foreignIdFor(RaceType::class, 'default_race_type_id')->after('date')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(EventClass::class, 'default_event_class_id')->after('race_type_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('regattas', function (Blueprint $table) {
            $table->dropForeign(['default_race_type_id']);
            $table->dropForeign(['default_event_class_id']);
            $table->dropColumn(['default_race_type_id', 'default_event_class_id']);
        });
    }
};
