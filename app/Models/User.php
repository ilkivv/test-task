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



    const ROLE_STUDENT = 'Student';
    const ROLE_TEACHER = 'Teacher';
    const ROLE_HEAD_TEACHER = 'Head teacher';
    const ROLE_DIRECTOR = 'Director';

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

    public function getUserByEmail($email)
    {
        return $this->with(['roles', 'attributes_db', 'permissions'])->where('email', $email)->first();
    }

    /**
     * @param $id
     * @param $params
     * @return bool
     */
    public function updateUserById($id, $params)
    {
        $user = $this->getUserById($id);

        if (!empty($user)){
            $user->update($params);
            $user->updateAttributes($params);
            return $this->getUserById($id);
        }

        return false;
    }

    /**
     * @return array
     */
    public function getAllStudents()
    {
        return $this->with('roles')
            ->whereHas('roles', function($query){
                $query->where('name', self::ROLE_STUDENT);
            })
            ->OrderBy('id', 'ASC')->get();
    }

    public function getAllWorkers()
    {
        return $this->with('roles')
            ->whereHas('roles', function($query){
                $query->where('name', self::ROLE_TEACHER)
                        ->orWhere('name', self::ROLE_HEAD_TEACHER)
                        ->orWhere('name', self::ROLE_DIRECTOR);
                })
            ->OrderBy('id', 'ASC')->get();
    }

    public function getAllStudentsBySchoolId($school_id)
    {
        return $students = $this->with('attributes_db')
            ->where('school_id', $school_id)
            ->whereHas('roles', function($query){
                $query->where('name', self::ROLE_STUDENT);
            })
            ->OrderBy('id', 'ASC')->get();
    }

    public function getAllWorkersBySchoolId($school_id)
    {
        return $students = $this->with('attributes_db')
            ->where('school_id', $school_id)
            ->whereHas('roles', function($query){
                $query->where('name', self::ROLE_TEACHER)
                    ->orWhere('name', self::ROLE_HEAD_TEACHER)
                    ->orWhere('name', self::ROLE_DIRECTOR);
            })
            ->OrderBy('id', 'ASC')->get();
    }

    public function deleteStudentById($id)
    {
        $user = $this->find($id);

        if ($user->hasRole(self::ROLE_STUDENT)){
            return $user->delete();
        }

        return false;
    }

    public function addUser($params)
    {
        $user = $this->getUserByEmail($params['email']);
        $role = $this->getRoleById((int) $params['role']);

        if (empty($user) && !empty($role)){
            $user = $this->create($params);
            $user->addRoles($role['name']);
            $user->updateAttributes($params);
            return $user;
        }

        return false;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
