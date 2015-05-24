<?php
require_once('dbconfig.php');
require_once('orm/camper.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if(!is_null($_GET['all']))
    {
      echo json_encode(camper::all($connection));
      exit();
    }

     if(isset($_GET['some']))
    {
      echo json_encode(camper::some($connection,$_GET['some']));
      exit();
    }

}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!is_null($_POST['create']))
    {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $gender = $_POST['gender'];
        $division = $_POST['division'];
        $bunk = $_POST['bunk'];
        $camper = camper::create($connection,$first,$last,$gender,$division,$bunk);

        if(is_null($camper)){
              header("HTTP/1.1 400 Bad Request");
              print("Camper failed at database");
              exit();
        }
        else{
              header("Content-type: application/json");
              print(json_encode($camper->getJSON()));
              exit();
        }
    }
    if(!is_null($_POST['remove']))
    {
        $id = $_POST['id'];
        $camper = camper::remove($connection,$id);

        if(is_null($camper)){
              header("HTTP/1.1 400 Bad Request");
              print("Camper failed at database");
              exit();
        }
        else{
              header("Content-type: application/json");
              print(true);
              exit();
        }
    }
}
header("HTTP/1.1 400 Bad Request");
print("URL did not match any known action.");
?>
