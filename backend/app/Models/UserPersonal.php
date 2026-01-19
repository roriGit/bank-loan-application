<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserPersonal extends Model
{
    protected $table = 'users_personal';
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
