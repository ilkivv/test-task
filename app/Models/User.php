<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'datetime:d-m-Y'
    ];

    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function createUser($params)
    {
        return $this->create($params);
    }

    public function getUsers()
    {
        return $this->get();
    }

    public function getAllStudents()
    {
        return $this->get();
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'users_attributes');
    }
}
