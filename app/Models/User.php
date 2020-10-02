<?php

namespace App\Models;

use App\Traits\Attributes;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, Attributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'birthday',
        'gender'
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

    /**
     * @param $email
     * @return mixed
     */
    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getCurrentUser()
    {
        return Auth::user();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function createUser($params)
    {
        return $this->create($params);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getUserById($id)
    {
        return $this->with(['roles', 'attributes_db', 'permissions'])->where('id', $id)->first();
    }

    /**
     * @param $id
     * @param $params
     * @return bool
     */
    public function updateStudent($id, $params)
    {
        $user = $this->getUserById($id);
        if ($user->hasRole('Student')){
            $user->update($params);
            $user->updateAttributes($params);
            return $this->get();
        }else{
            return false;
        }
    }

    /**
     * @return array
     */
    public function getAllStudents()
    {
        $users = $this->with([
            'roles' => function ($query) {
                $query->where('name', 'Student');
                },
            'attributes_db'
            ]
        )->get();

        $students = [];

        foreach ($users as $user) {
            if (count($user->roles) > 0){
                $students[] = $user;
            }
        }
        return $students;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
