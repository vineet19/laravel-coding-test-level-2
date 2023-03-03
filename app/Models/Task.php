<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'project_id',
        'user_id'
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
