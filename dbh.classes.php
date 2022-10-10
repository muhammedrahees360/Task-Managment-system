<?php
class Dbh{
    protected function connect(){
        try{           

            $dbUsername="rahees";
            $dbPassword ="Admin@123";
             $dbName = "tms_db";         
            $dbh = new PDO('mysql:host=localhost;dbname=tms_db', $dbUsername,$dbPassword);           
            return $dbh;
            }catch(PDOException $e)
            {
            print "ERROR!".$e->getMessage() . "<br>";
            die();
            }
    }
}
