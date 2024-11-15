<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'photo',
        'name',
        'description',
        'address',
        'cpfcnpj',
        'phone',
        'email',
        'password',
        'wallet',
        'api_key',
        'url',
        'type',
        'status',
        'created_at'
    ];

    public function firstName() {
        return explode(' ', trim($this->name))[0];
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
