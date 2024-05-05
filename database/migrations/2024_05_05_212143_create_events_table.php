<?php

use App\Models\BoatClass;
use App\Models\EventClass;
use App\Models\Gender;
use App\Models\Regatta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Regatta::class)->constrained('regattas')->cascadeOnDelete();
            $table->foreignIdFor(Gender::class)->constrained('genders')->cascadeOnDelete();
            $table->foreignIdFor(EventClass::class)->constrained('event_classes')->cascadeOnDelete();
            $table->foreignIdFor(BoatClass::class)->constrained('boat_classes')->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('code')->nullable()->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
