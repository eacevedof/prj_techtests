<?php
class StaticA
{
    protected static $value = "value A \n<br/>";

    public static function pr_value_self(){
        echo self::$value;
    }

    public static function pr_value_static(){
        echo static::$value;
    }
}

class StaticB extends StaticA
{
    protected static $value = "B";
}

StaticB::pr_value_self();//value A
StaticB::pr_value_static();//B