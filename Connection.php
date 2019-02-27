<?php
/**
 * Created by PhpStorm.
 * User: dani
 * Date: 7/01/19
 * Time: 16:39
 */

class Connection
{
    public static function make(){
        try{
            $opciones=[PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT=>true];
            $conection=new PDO(
                'mysql:localhost=127.0.0.1;dbname=deporVereda;charset=utf8',
                'root',
                "",
                $opciones);

        }catch (PDOException $PDOException){
            die($PDOException->getMessage());
        }
        return $conection;
    }
}