<?php
/**
 * Created by PhpStorm.
 * User: aleksey
 * Date: 02.10.20
 * Time: 8:03
 */

namespace App\Traits;

use App\Models\Attribute;

trait Attributes
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes_db() // перебил атрибуты коллекции, поэтому db
    {
        return $this->belongsToMany(Attribute::class, 'users_attributes');
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function updateAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            if ($this->hasAttribute($attribute)){
                $this->attributes_db()->updateExistingPivot($this->getTheAttributeId($attribute), ['value' => $value]);
            }
        }
        return $this;
    }

    /**
     * @param $search
     * @return bool
     */
    public function getTheAttributeId($search)
    {
        $attributes = $this->attributes_db;
        foreach ($attributes as $attribute) {
            if ($attribute->slug === $search){
                return $attribute->id;
            }
        }
        return false;
    }

    /**
     * @param $search
     * @return mixed
     */
    public function hasAttribute($search)
    {
        return $this->attributes_db->contains('slug', $search);
    }
}