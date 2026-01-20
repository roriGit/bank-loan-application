<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPersonal extends Model
{
    protected $table = 'users_personal';
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'contact_number',
        'employment_status',
        'employment_type',
        'date_of_birth',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
