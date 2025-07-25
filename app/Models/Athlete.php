<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Athlete extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'team_id',
        'gender_id',
        'name_first',
        'name_last',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function entries(): BelongsToMany
    {
        return $this->belongsToMany(Entry::class);
    }

    public function getNameAttribute(): string
    {
        return "$this->name_first $this->name_last";
    }
}
