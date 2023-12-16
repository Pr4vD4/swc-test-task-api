<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'events_users', 'user_id', 'event_id');
    }

    protected $fillable = [
        'title',
        'text',
        'author'
    ];

}
