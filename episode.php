<?php

  session_start();
  error_reporting(0);
  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];
  $project_name = $_SESSION['projectName'];

  if(strtoupper($access) != 'ADMIN')
  {
    if(strtoupper($access) != 'CHECKER')
    {
     echo "<script>alert('Login as admin to access this page');</script>";
     echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
    }
  }


  $host = "localhost";
  $user = "root";
  $pass = "";
  $port = 3306;
  $database = "AMS_DB";

  $dataArray = getUserData($host,$port,$user,$pass,$database,$project_name,$access,$current_user);

  $ep_id = array(); $ep_name = array(); $scene_count = array(); $status = array(); $asset_count = array();
  $checker = array();

  $ep_id = $dataArray[0];
  $ep_name = $dataArray[1];
  $scene_count = $dataArray[2];
  $status = $dataArray[3];
  $asset_count = $dataArray[4];
  $checker = $dataArray[5];
  $project = $dataArray[6];

 ?>

<!DOCTYPE html>
<html>
<title>Project Layout</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel = "stylesheet" href = "animate.css">
<style>
/* Full-width input fields */
input[type=text], input[type=number]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
body{
  background-image: url('bghomepage.png');
  height:100%;
  background-position: center;
  background-size:cover;
  background-attachment:fixed;
  background-repeat:no-repeat;
}

select
{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #0066ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;

}
button:hover{
  background-color: #6699ff;
}
/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {float:left;width:50%}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 35px;
    top: 15px;
    color: #000;
    font-size: 40px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}

    img#logo {
    opacity: 0.8;
    filter: alpha(opacity=70); /* For IE8 and earlier */
}

img#logo:hover {
    opacity: 1.0;
    filter: alpha(opacity=100); /* For IE8 and earlier */

    }
table
        {

             border-collapse: collapse;
             width: 100%;
         }

         th, td
         {
             padding: 8px;
             text-align: center;
             border-right: 1px solid #ddd;
             border-bottom: 1px solid #ddd;

         }
         td{
           background-color: white;
         }
         th
         {
             background-color: #0066ff;
             color: white;
             text-align: center;

         }
         h2{
           color:white;
           margin-top: 100px;
           font-style: italic;
           font-size: 40px;
         }


         tr:hover{background-color:#f5f5f5}


         a {
             text-decoration: none;
             display: inline-block;
             padding: 8px 16px;
             opacity 0.9;
         }

         a:hover {
             opacity 1;
             color: black;
         }

         .previous {
             background-color: #f1f1f1;
             color: black;
         }

         .next {
             background-color: blue;
             color: white;
         }

         .round {
             border-radius: 50%;
         }


</style>
<body>
<center>
  <?php
  if(strtoupper($access) != "CHECKER")
  {
      echo "<a href = \"home.php\">";
  }
  else {
       echo "<a href = \"episode.php\">";
  }
  ?>
  <img src = "logo.png" class="container rubberBand animated" id = "logo" ></a></center>

  <br/>
  <br/>
  <h2 style = "margin-top: -50px" class="container fadeInRight animated">
    <?php

        if($project_name != null){echo strtoupper($project_name)." Episodes";}
        else {echo strtoupper($current_user)." Episodes to Check";}

    ?>
  </h2>


<?php
 if(strtoupper($access) != "CHECKER" )
 {?>
   <button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Previous</button>
   <br/>
<button  class="container bounceIn animated"
  onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Episode</button>
  <?php
  }
  else {
    ?>
    <button onclick = "logout()" class="previous" style ="width:auto;">&laquo; Logout</button>
    <br/>

<?php
    }
      displayPopUp($host,$port,$user,$pass,$database);

      if(isset($_POST['btn_addEpisode']))
      {
         $ep_name = $_POST['txt_epName'];
         $scene_count = $_POST['txt_sceneCount'];
         $status = $_POST['cmb_status'];
         $asset_count = $_POST['txt_assetCount'];
         $checker = $_POST['cmb_checker'];

         if(saveEpisode($host,$database,$user,$pass,$port,$ep_name,$scene_count,$status,$project_name,
                        $asset_count,$checker))
         {
            echo "<script>alert('Episode $ep_name Added');</script>";
            echo '<meta http-equiv="refresh" content="0; URL=episode.php" />';
         }
      }
  ?>

<table class="container lightSpeedIn animated">
  <th> Episode ID </th>
  <th> Episode Name </th>
  <th> Checker </th>
  <th> Scene Count </th>
  <th> Asset Count </th>
  <th> Status </th>

<?php
if(strtoupper($access) != "CHECKER")
{
    echo "<th> Scene Progress </th>
          <th> Asset Progress </th>
          <th> Overall Progress </th>
          <th> </th>";
}
else {
  echo "<th> Project Name </th><th></th>";
}

echo "<Form method=\"POST\">";

    $counter = 0;
    $progress = 0;
    $sceneProgress = 0;
    $taskProgress = 0;
    $totalTask = 0;

      for($i = 0; $i < sizeOf($ep_id); $i++)
      {
        $numScenes = currentScenes($host,$port,$user,$pass,$database,$ep_name[$i]);
        $numAssets = currentAssets($host,$port,$user,$pass,$database,$ep_name[$i]);

        if($scene_count[$i] != 0){$totalTask = $scene_count[$i];}
        if($asset_count[$i] != 0){$totalTask = $totalTask + $asset_count[$i];}
        if($totalTask != 0)
        {
          $progress = round((($numScenes + $numAssets)/$totalTask)*100);
          if($scene_count[$i] != 0){$sceneProgress = round(($numScenes/$scene_count[$i])*100);}
          if($asset_count[$i] != 0){$assetProgress = round(($numAssets/$asset_count[$i])*100);}
        }

          echo "<tr>
                <td><p> $ep_id[$i]    </p></td>
                <td><p> $ep_name[$i]  </p></td>
                <td><p> $checker[$i]  </p></td>
                <td><p> $scene_count[$i] </p></td>
                <td><p> $asset_count[$i] </p></td>
                <td><p> $status[$i] </p></td>";


            if(strtoupper($access) != "CHECKER")
            {
              echo "<td><p> $sceneProgress% </p></td>
                <td><p> $assetProgress% </p></td>
                <td><p> $progress% </p></td>
                <td>
                <button name = \"btn_scenes$i\"> Scenes </button>
                <button name = \"btn_edit$i\"> Edit </button>
                <button name = \"btn_Delete$i\"> Delete </button>
                </td>
                </tr>";

           }
           else {

             echo "<td><p> $project[$i] </p></td>
                  <td><button name = \"btn_scenes$i\"> Scenes </button></td></tr>";
           }
          $counter = $i;
      }

   for($i = 0; $i <= $counter; $i++)
   {
      if(isset($_POST['btn_scenes'.$i]))
      {
            $_SESSION['whereClause'] = '';
            $_SESSION['episode_id'] = $ep_id[$i];
            $_SESSION['ep_name'] = $ep_name[$i];
            $_SESSION['project_name'] = $project[$i];
            echo '<meta http-equiv="refresh" content="0; URL=scenes.php" />';
      }
      if(isset($_POST['btn_edit'.$i]))
      {
            $_SESSION['episode_id'] = $ep_id[$i];
            $_SESSION['ep_name'] = $ep_name[$i];
            $_SESSION['scene_count'] = $scene_count[$i];
            $_SESSION['asset_count'] = $asset_count[$i];
            $_SESSION['status'] = $status[$i];
            $_SESSION['checker'] = $checker[$i];
            echo '<meta http-equiv="refresh" content="0; URL=episodeEdit.php" />';
      }
      if(isset($_POST['btn_Delete'.$i]))
      {
          if(deleteEpisode($host,$database,$user,$pass,$port,$ep_id[$i]))
          {
            echo "<script>alert('Episode Deleted');</script>";
            echo '<meta http-equiv="refresh" content="0; URL=episode.php"/>';
          }
      }
   }

  ?>
</form>
</table>


<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }

    var modal = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
}
</script>

</body>
</html>
<?php

function sqlConnection($host,$port,$user,$pass,$database)
{
   $conn = mysqli_connect($host, $user, $pass, $database, $port);
   if ($conn->connect_error)
         {
             die("Connection failed: " . $conn->connect_error);
         }

     return $conn;
}

function getUserData($host,$port,$user,$pass,$database,$project_name,$access,$current_user)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $name = getName($host,$port,$user,$pass,$database,$current_user);

  if(strtoupper($access) == 'CHECKER')
  {$sql = "SELECT * FROM AMS_EPISODE WHERE EPISODE_CHECKER = '$name'";}
  else
   {$sql = "SELECT * FROM AMS_EPISODE WHERE PROJECT_NAME = '$project_name'";}

  $ep_id = array();
  $project_name = array();
  $ep_name = array();
  $scene_count = array();
  $asset_count = array();
  $status = array();
  $checker = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $ep_id[$counter] = $row['episode_id'];
                   $ep_name[$counter] = $row['episode_name'];
                   $scene_count[$counter] = $row['scene_count'];
                   $status[$counter] = $row['status'];
                   $asset_count[$counter] = $row['asset_count'];
                   $checker[$counter] = $row['episode_checker'];
                   $projectName[$counter] = $row['project_name'];

                   $counter++;
                }
            }

  $dataArray[0] = $ep_id;
  $dataArray[1] = $ep_name;
  $dataArray[2] = $scene_count;
  $dataArray[3] = $status;
  $dataArray[4] = $asset_count;
  $dataArray[5] = $checker;
  $dataArray[6] = $projectName;

return $dataArray;

}

function saveEpisode($host,$database,$user,$pass,$port,$ep_name,$scene_count,$status,$project_name,$asset_count,$checker)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_EPISODE(PROJECT_NAME,EPISODE_NAME,SCENE_COUNT,STATUS,ASSET_COUNT,EPISODE_CHECKER)
                        VALUES('$project_name','$ep_name',$scene_count,'$status','$asset_count','$checker')";



  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }
  else
  {
    echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    $conn->close();
  }

  return $isSaved;
}

function currentScenes($host,$port,$user,$pass,$database,$episode)
{
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT COUNT(ID) FROM AMS_TASK AS COUNT WHERE TASK_TYPE = 'SCENE' AND TASK_EPISODE = '$episode'
            AND UPPER(SCENE_STATUS) = 'APPROVED'";
  $scene_count = 0;

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $scene_count = $row['COUNT(ID)'];
                 }
            }

   return $scene_count;
}

function currentAssets($host,$port,$user,$pass,$database,$episode)
{
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT COUNT(ID) FROM AMS_TASK AS COUNT WHERE TASK_TYPE = 'ASSET'
          AND TASK_EPISODE = '$episode' AND UPPER(SCENE_STATUS) = 'APPROVED'";
  $asset_count = 0;

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $asset_count = $row['COUNT(ID)'];
                 }
            }

   return $asset_count;
}

function deleteEpisode($host,$database,$user,$pass,$port,$id)
{
  $isDeleted = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "DELETE FROM AMS_EPISODE WHERE EPISODE_ID = $id";


  if($conn->query($sql) === TRUE){$isDeleted = true;}

  $conn->close();
  return $isDeleted;
}

function displayPopUp($host,$port,$user,$pass,$database)
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";

    echo "
        <label><b>Episode Name</b></label>
        <input type=\"text\" placeholder=\"Episode Name\" name=\"txt_epName\" value=\"\" required>";


    echo "<label><b>Episodes Checker</b></label>
        <select name=\"cmb_checker\">
        <option value='' disabled selected>-- Choose Episode Checker -- </option>";
         displayComboBox($host,$port,$user,$pass,$database);

    echo "</select>
        <label><b>Scene Count</b></label>
        <input type=\"text\" placeholder=\"Scene Count\" name=\"txt_sceneCount\" value=\"\" required>
        <label><b>Asset Count</b></label>
        <input type=\"text\" placeholder=\"Asset Count\" name=\"txt_assetCount\" value=\"\" required>
        <label><b>Episode Status</b></label>
        <select name=\"cmb_status\">
          <option value='' disabled selected>-- Choose Status -- </option>
          <option value=\"Approved\">Approved</option>
          <option value=\"Revise\">Revise</option>
          <option value=\"On Going\">On going</option>
        </select>

        <div class=\"clearfix\">

      <button type=\"submit\" class=\"signupbtn\" name=\"btn_addEpisode\">Add Episode</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div></form>";
}




function getName($host,$port,$user,$pass,$database,$username)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS WHERE USERNAME = '$username'";
  $name = null;
  $fname = null;
  $lname = null;
  $mname = null;


            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                      $fname = $row['USER_FNAME'];
                      $lname = $row['USER_LNAME'];
                      $mname = $row['USER_MNAME'];
                 }
            }

      $name = $fname . ' ' . $mname . ' ' . $lname;

return $name;
}

function ViewUsers($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS WHERE UPPER(USER_PRIVILAGE) = 'CHECKER'";
  $name = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                 {
                   $fname[$counter] = $row['USER_FNAME'];
                   $lname[$counter] = $row['USER_LNAME'];
                   $mname[$counter]= $row['USER_MNAME'];

                   $name[$counter] = $fname[$counter] . ' ' . $mname[$counter] . ' ' . $lname[$counter];

                   $counter++;
                }
            }

return $name;
}

function displayComboBox($host,$port,$user,$pass,$database)
{
  $employeeArray = ViewUsers($host,$port,$user,$pass,$database);
  $numOfEmployee = sizeOf($employeeArray);

  for($i = 0 ; $i < $numOfEmployee; $i++)
  {
    $name = strtoupper($employeeArray[$i]);
    echo "<option value=\"$employeeArray[$i]\">$name</option>";
  }
echo "</select>";
}


?>
<script>
/*$(document).ready(function(){
    $("button").click(function(){

        $("p").replaceWith("<input type=\"text\" name=\"edit_uname\">");

        return false;
    });
});*/
</script>
<script>
function goBack() {
  window.location = "layoutprojectreport.php";
}
function logout() {
  window.location = "index.php";
}
function goNext()
{
 	window.history.forward();
}
</script>
