<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'height',
        'weight',
        'jersey_number',
        'college',
        'country',
        'draft_year',
        'draft_round',
        'draft_number',
        'team_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    // Relacionamento com o time
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
