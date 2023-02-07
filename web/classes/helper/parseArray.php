<?php
namespace helper;

class parseArray
{

    public function findInArray(array $array, array $needle){
        $response = [];
        $keys = $this->getArrayKeysSearch($array, $needle);
        if(!empty($keys)){
            foreach($keys as $i => $key){
                $response[$i] = $array[$key];
            }
        }
        return $response;
    }
    public function findSingleInArray(array $array, array $needle, string $columnkey){
        $keys = $this->getArrayKeysSearch($array, $needle);
        return $array[$keys[0]][$columnkey];
    }
    private function getArrayKeysSearch(array $array, array $needle){
        $result = array();
        foreach ($array as $key => $value)
        {
            foreach ($needle as $k => $v)
            {
                if (!isset($value[$k]) || $value[$k] != $v)
                {
                    continue 2;
                }
            }
            $result[] = $key;
        }
        return $result;
    }
}