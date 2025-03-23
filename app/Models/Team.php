<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $fillable = ['conference', 'division', 'city', 'name', 'full_name', 'abbreviation'];
    protected $hidden = ['created_at', 'updated_at'];
}
