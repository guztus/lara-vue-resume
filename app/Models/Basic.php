<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Basic extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'name',
        'surname',
        'email',
        'phoneNumber',
        'website',
        'address',
        'country',
        'city',
        'zipcode',
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
