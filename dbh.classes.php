<?php

class Dbh{
    protected function connect(){
        try{
            
            $dbUsername="afna";
            $dbPassword ="Afna@1999";
            // $dbName = "ooplogin";
          
            $dbh = new PDO('mysql:host=localhost;dbname=tms_db', $dbUsername,$dbPassword);
            return $dbh;
        }catch(PDOException $e){
            print "ERROR!".$e->getMessage() . "<br>";
            die();

        }
    }
}