<?php

use App\Models\Venue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regattas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Venue::class)->constrained('venues')->cascadeOnDelete();
            $table->string('name');
            $table->date('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regattas');
    }
};
