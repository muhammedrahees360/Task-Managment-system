<?php
class Dbh{
    protected function connect(){
        try{           

            $dbUsername="afna";
            $dbPassword ="Afna@1999";
             $dbName = "tms_db1";         
            $dbh = new PDO('mysql:host=localhost;dbname=tms_db1', $dbUsername,$dbPassword);           
            return $dbh;
            }catch(PDOException $e)
            {
            print "ERROR!".$e->getMessage() . "<br>";
            die();
            }
    }
}