<?php
class dbh{
    protected function connect(){
        try{        

            $dbUsername="afna";
            $dbPassword ="Afna@1999";

             $dbName = "tms_db";          
            $dbh = new PDO('mysql:host=localhost;dbname=tms_db', $dbUsername,$dbPassword);           
            return $dbh;
        }catch(PDOException $e){
            print "ERROR!".$e->getMessage() . "<br>";
            die();

        }
    }

}

