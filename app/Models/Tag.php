<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function undergraduates(): HasMany
    {
        return $this->hasMany(Undergraduate::class);
    }
}
