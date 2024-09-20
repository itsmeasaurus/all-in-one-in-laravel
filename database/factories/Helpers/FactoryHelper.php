<?php
namespace Database\Factories\Helpers;

class FactoryHelper
{
    /**
     * This function will return the random model id
     * @param string | HasFactory $model
     */
    public static function getModelRandomID(string $model)
    {
        $count = $model::query()->count();
        if($count === 0){
            return $model::factory()->create()->id;
        }else{
            return rand(1, $count);
        }
    }
}