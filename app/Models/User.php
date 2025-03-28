<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the reservation_user for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservation_user(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    public function reservation_order(): HasMany
    {
        return $this->hasMany(Reservation::class, 'order_id', 'id');
    }

    public function transaction_user(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function transaction_order(): HasMany
    {
        return $this->hasMany(Transaction::class, 'order_id', 'id');
    }
}
