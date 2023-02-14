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
    public function compareArrays(array $array1,array  $array2, string $uniquekey = NULL)
    {
            $response = ["more" => array(), "changes" => array(), "new" => array()];

            if(empty($uniquekey)) {
                $mainkey = array_key_first($array1[0]);
            }

            foreach ($array1 as $array1key => $array){
                $needle[$mainkey] = $array[$mainkey];
                $result = $this->findInArray($array2, $needle);
                if(empty($result)){
                    $response['more'][$array1key] = $array;
                }else{
                    $array2key = $this->getArrayKeysSearch($array2, $needle);
                    $difference = array_diff($array, $result[0]);
                    if(!empty($difference)){
                        foreach ($difference as $key => $diff){
                            $firstkey = $key.'_old';
                            $result[0][$firstkey] = $diff;
                        }
                        $response['changes'][$array1key] = $result[0];
                    }
                    unset($array2[$array2key[0]]);
                }
            }

            if(!empty($array2)){
                $response['new'] = $array2;
            }

            return $response;

    }
}