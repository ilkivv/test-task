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
        return $this->belongsToMany(Attribute::class, 'users_attributes')->withPivot('value');
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

    public function addAttributes(array $params)
    {
//        $attributes = $this->getAttributes($params);
//        dd($attributes);
//        $this->attributes_db()->saveMany($attributes);
//        $this->updateAttributes($params);
        return $this;
    }

    public function updateAttribute($attributes)
    {
        foreach ($attributes as $attribute => $value) {
            if ($this->hasAttribute($attribute)){
                $this->attributes_db()->updateExistingPivot($this->getTheAttributeId($attribute), ['value' => $value]);
                return true;
            }
        }
        return false;
    }

    public function updateAttributeValue($slug, $value)
    {
        if ($this->hasAttribute($slug)){
            $this->attributes_db()->updateExistingPivot($this->getTheAttributeId($slug), ['value' => $value]);
            return true;
        }
        return false;
    }

//    public function getAttributes(array $params)
//    {
//        $attributeModel = new Attribute();
//        return $attributeModel->getAttributesBySlug($params);
//    }

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