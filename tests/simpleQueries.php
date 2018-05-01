<?php

/**
 *
 * @author Wassim Bougarfa
 * @since 30-04-2018
 */

define("USER", "hr");
define("PASSWORD", "waelo"); //TODO : change 

define("ADMIN", "SYS");
define("ADMIN_PASS", ""); //TODO : change

require '../src/SQLDatabase.php';

executeSimpleSelect();

function connectNormal()
{
    $db = new SQLDatabase();
    try {
        $db->connect(USER, PASSWORD);
        //var_dump($db);
    } catch (DBCException $e) {
        echo $e->getMessage();
    }
    return $db;
}

function connectAsAdmin()
{
    $db = new SQLDatabase();
    try {
        $db->connect(ADMIN, ADMIN_PASS, true);
        //var_dump($db);
    } catch (DBCException $e) {
        echo $e->getMessage();
    }
    return $db;
}

function connectAndSwitchSchema(){
    $db = connectAsAdmin();
    try{
        $db->switchSchema("hr");
        //var_dump($db);
    }catch(DBCException $e){
        echo $e->getMessage();
    }
    return $db;
}


function executeSimpleSelect(){
    $db = connectNormal(); //connected to hr 
    var_dump($db->qin("SELECT * FROM employees WHERE sal > :sal ", ["sal" => 13000]));
}