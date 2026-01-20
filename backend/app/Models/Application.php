<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{

    protected $table = 'applications';
    protected $fillable = [
        'users_id',
        'loan_type',
        'loan_amount',
        'loan_term_months',
        'monthly_income',
        'status',
        'notes',
        'application_date',
    ];
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
