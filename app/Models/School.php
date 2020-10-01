<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $casts = [
        'open' => 'Y', // Change your format
        'close' => 'Y',
    ];

    protected $guarded = [];

    public function getSchools()
    {
        return $this->get();
    }

    public function getSchool($id)
    {
        return $this->where('id', $id)->firstOrFail();
    }

    public function addSchool($params)
    {
        return $this->create($params);
    }

    public function updateSchool($id, $params)
    {
        return $this->find($id)->update($params);
    }

    public function deleteSchool($id)
    {
        return $this->find($id)->delete();
    }
}
