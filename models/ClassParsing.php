<?php

namespace app\models;

use yii\base\Exception;

class ClassParsing extends Parsing
{

    public static function globalData()
    {
        return ClassParsing::_parseFile("class/global.txt");
    }

    public static function regionData()
    {
        $result = [];
        $files = scandir(ClassParsing::$basedir . "class/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^(EU|NA|JP|KR|RU|TW)\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("class/" . $file);
            }
        }
        return $result;
    }

    public static function dateData($region)
    {

        if ($region != "EU" && $region != "NA" && $region != "KR" && $region != "RU" && $region != "JP" && $region != "TW") {
            throw new Exception("Go fuck yourself");
        }

        $result = [];
        $files = scandir(ClassParsing::$basedir . "class/" . $region . "/");
        foreach ($files as $file) {
            $matches = [];
            if (preg_match("#^([0-9]{4}-[0-9]{2})\.txt$#", $file, $matches)) {
                $result[$matches[1]] = ClassParsing::_parseFile("class/" . $region . "/" . $file);
            }
        }

        return $result;

    }

}