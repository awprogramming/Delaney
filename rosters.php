<?php
require_once('dbconfig.php');
require_once('orm/roster.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $roster = roster::grabRoster($connection,$id);
      $query = "SELECT * FROM camper_roster where rid='$id'";
      $result = $connection->query($query);
      $campers = array();
      $next_row = $result->fetch_row();
      while($next_row)
      {
        $campers[] = $next_row[0];
        $next_row = $result->fetch_row();
      }
      
      $final = array();
      $final['roster'] = $roster;
      $final['camperIDs'] = $campers;

      echo json_encode($final);

      exit();

    }
    else if(isset($_GET['all']))
    {
      echo json_encode(roster::all($connection));
      exit();

    }

}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['create']))
    {
        $name = $_POST['name'];
        
        $roster = roster::create($connection,$name);

        if(is_null($roster)){
              header("HTTP/1.1 400 Bad Request");
              print("Roster failed at database");
              exit();
        }
        else{
              $cids = $_POST['ids'];
              $rid = $roster->id();
              foreach($cids as $cid)
              {
                $query = "INSERT INTO camper_roster(cid,rid) VALUES ('$cid','$rid')";
                $connection->query($query);
                if($connection === false) {
                    trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
                }
              }

              header("Content-type: application/json");
              print(json_encode($roster->getJSON()));
              exit();
        }
    }
    if(!is_null($_POST['update']))
    {
        $name = $_POST['name'];
        $rid = $_POST['id'];
        $roster = roster::update($connection,$name,$rid);

        if(is_null($roster)){
              header("HTTP/1.1 400 Bad Request");
              print("Roster failed at database");
              exit();
        }
        else{
              $cids = $_POST['ids'];
              
              $query = "DELETE FROM camper_roster WHERE rid='$rid'";
                $connection->query($query);
                if($connection === false) {
                    trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
                }

              foreach($cids as $cid)
              {
                $query = "INSERT INTO camper_roster(cid,rid) VALUES ('$cid','$rid')";
                $connection->query($query);
                if($connection === false) {
                    trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
                }
              }

              header("Content-type: application/json");
              print(json_encode($roster->getJSON()));
              exit();
        }
    }
    if(!is_null($_POST['remove']))
    {
        $id = $_POST['id'];
        $roster = roster::remove($connection,$id);

        if(is_null($roster)){
              header("HTTP/1.1 400 Bad Request");
              print("Roster failed at database");
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
