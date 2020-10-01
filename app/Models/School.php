<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $casts = [
        'open' => 'datetime:Y', // Свой формат
        'close' => 'datetime:Y',
    ];

    protected $guarded = [];

    public function getSchools()
    {
        return $this->get();
    }

    public function getSchool($id)
    {
        return $this->where('id', $id)->first();
    }

    public function addSchool($params)
    {
        return $this->create($params);
    }

    public function updateSchool($id, $params)
    {
        $item = $this->find($id);
        if (!empty($item)){
            return $item->update($params);
        }else{
            return false;
        }

    }

    public function deleteSchool($id)
    {
        $item = $this->find($id);
        if (!empty($item)){
            return $item->delete();
        }else{
            return false;
        }

    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
