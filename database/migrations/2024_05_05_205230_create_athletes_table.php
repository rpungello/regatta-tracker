<?php

use App\Models\Gender;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->constrained('teams')->cascadeOnDelete();
            $table->foreignIdFor(Gender::class)->constrained('genders')->cascadeOnDelete();
            $table->string('name_first');
            $table->string('name_last');
            $table->softDeletes();
            $table->timestamps();

            $table->unique([
                'name_first',
                'name_last',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
