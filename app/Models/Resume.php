<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function basic(): hasOne
    {
        return $this->hasOne(Basic::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function work(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($resume) {
            $resume->basic()->delete();
            $resume->work()->delete();
            $resume->education()->delete();
        });
    }
}
