<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'      
    ];

    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }

}
