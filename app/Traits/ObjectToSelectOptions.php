<?php

namespace App\Traits;

trait ObjectToSelectOptions
{

    public static function objectFoSelectOptions($obj): array
    {
        $opts = [];

        foreach($obj as $key => $val){
            $opts[] = [
                'title'=>$val,
                'value' => $key,
            ];
        }

        return $opts;
    }

}
