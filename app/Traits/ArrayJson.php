<?php
/**
 * Created by PhpStorm.
 * User: aleksey
 * Date: 02.10.20
 * Time: 8:03
 */

namespace App\Traits;

trait ArrayJson
{
    public function getArrayFromJson($rating)
    {
        if (!empty($rating)){
            return json_decode($rating, true);
        }

        return false;
    }

    public function getJsonFromArray($rating)
    {
        if (!empty($rating)){
            return json_encode($rating);
        }

        return false;
    }
}