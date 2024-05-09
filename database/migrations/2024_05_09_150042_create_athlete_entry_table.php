<?php

use App\Models\Athlete;
use App\Models\Entry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('athlete_entry', function (Blueprint $table) {
            $table->foreignIdFor(Entry::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Athlete::class)->constrained()->cascadeOnDelete();

            $table->primary(['entry_id', 'athlete_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athlete_entry');
    }
};
