<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'team_type_id',
        'brand_color_primary',
        'brand_color_secondary',
    ];

    public function teamType(): BelongsTo
    {
        return $this->belongsTo(TeamType::class);
    }

    public function athletes(): HasMany
    {
        return $this->hasMany(Athlete::class);
    }
}
