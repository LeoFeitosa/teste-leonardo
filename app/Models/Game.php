<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'season',
        'status',
        'period',
        'home_team_score',
        'visitor_team_score',
        'postseason',
        'time',
        'datetime'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function homeTeam()
    {
        return $this->belongsToMany(Team::class, 'game_team')
            ->wherePivot('is_home_team', true);
    }

    public function visitorTeam()
    {
        return $this->belongsToMany(Team::class, 'game_team')
            ->wherePivot('is_home_team', false);
    }

    public function teams()
    {
        return $this->homeTeam()->union($this->visitorTeam());
    }

}
