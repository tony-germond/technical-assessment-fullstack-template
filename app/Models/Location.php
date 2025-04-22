<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'team_id',
        'is_featured',
        'latitude',
        'longitude',
    ];

    /**
     * Get the team that owns the location.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}