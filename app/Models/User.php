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

    /**
     * @param $email
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
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

    /**
     * @param $school_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllStudentsBySchoolId($school_id)
    {
        return $students = $this->with('attributes_db')
            ->where('school_id', $school_id)
            ->whereHas('roles', function($query){
                $query->where('name', self::ROLE_STUDENT);
            })
            ->OrderBy('id', 'ASC')->get();
    }

    /**
     * @param $school_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
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

    /**
     * @param $id
     * @return bool
     */
    public function deleteUserById($id)
    {
        $user = $this->find($id);

        if ($user){
            return $user->delete();
        }

        return false;
    }

    public function exceptionOrDismissalUserById($params, $id)
    {
        $user = $this->find($id);

        if (!empty($user)){
            return $user->updateAttribute($params);
        }

        return false;
    }

    /**
     * @param $params
     * @return bool|\Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function addUser($params)
    {
        $user = $this->getUserByEmail($params['email']);
        $role = $this->getRoleById((int) $params['role']);

        if (empty($user) && !empty($role)){
            $user = $this->create($params);
            $user->addRoles($role['name']);
            $user->addAttributes($params);
            return $user;
        }

        return false;
    }

    public function activateTransferStudents()
    {
        $parametr = 'class';

        $students = $this->with('attributes_db')->whereHas('roles', function($query){
                $query->where('name', self::ROLE_STUDENT);
            })
            ->get();
        foreach ($students as $student) {
            foreach ($student->attributes_db as $attribute) {
                if ($attribute->slug === $parametr && (int) $attribute->pivot->value < 11){
                    $student->updateAttributeValue($parametr, $attribute->pivot->value + 1);
                }
            }
        }
        return $this;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
