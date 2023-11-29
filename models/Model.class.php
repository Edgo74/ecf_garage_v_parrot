<?php

abstract class Model{
    private static $pdo;

    private static function setBdd(){
        self::$pdo = new PDO("mysql://mltywlhbnv995tic:khrdi7hr71f6s25s@l0ebsc9jituxzmts.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/nw3w1xy3zgeai98w");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}
