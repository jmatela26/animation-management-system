<?php

  session_start();
  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];


  if(strtoupper($access) != 'ADMIN')
  {
     echo "<script>alert('Login as admin to access this page');</script>";
     echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
  }

  $host = "localhost";
  $user = "root";
  $pass = "";
  $port = 3306;
  $database = "AMS_DB";

  $dataArray = getUserData($host,$port,$user,$pass,$database);

  $projectName = array(); $animationDuration = array(); $numScene = array(); $numProcess = array(); $process = array();
  $project_description = array(); $project_status = array(); $ep_count = array();

  $projectName = $dataArray[0];
  $animationDuration = $dataArray[1];
  $numProcess = $dataArray[2];
  $process = $dataArray[3];
  $project_description = $dataArray[4];
  $project_status = $dataArray[5];
  $ep_count = $dataArray[6];




 ?>

<!DOCTYPE html>
<html>
<title>Project Layout</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel = "stylesheet" href = "animate.css">
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
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





</style>
<body>
<center><a href = "home.php"><img src = "logo.png" class="container rubberBand animated" id = "logo" ></a></center>

  <br/>
  <br/>
  <h2 style = "margin-top: -50px" class="container fadeInRight animated"> Project Layout </h2>


<table class="container lightSpeedIn animated">
  <th> Project Name </th>
  <th> Episode Count </th>
  <th> Status </th>
  <th> Progress </th>
  <th></th>
    <Form method="POST">
  <?php
    $counter = 0;
    $progress = 0;

      for($i = 0; $i < sizeOf($projectName); $i++)
      {
        if($ep_count[$i] != 0)
        {
          $current_epCount = currentEpCount($host,$port,$user,$pass,$database,$projectName[$i]);
          $progress = round(($current_epCount/$ep_count[$i]) * 100);
        }

          echo "<tr>
                <td><p> $projectName[$i]    </p></td>
                <td><p> $ep_count[$i]       </p></td>
                <td><p> $project_status[$i] </p></td>
                <td><p> $progress%</p></td>
                <td>
                <button name = \"btn_episode$i\"> Episodes </button>
                </td>
                </tr>";

          $counter = $i;
      }

   for($i = 0; $i <= $counter; $i++)
   {
      if(isset($_POST['btn_episode'.$i]))
      {
            $_SESSION['projectName'] = $projectName[$i];
            echo '<meta http-equiv="refresh" content="0; URL=episode.php" />';
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

function saveProject($host,$port,$user,$pass,$database,$projectName,$animationDuration,$numScene,$numProcess)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_PROJECTS(PROJECT_NAME,ANIMATION_DURATION,NUM_OF_SCENE,NUM_OF_ANIMATION_PROCESS)
                      VALUES('$projectName','$animationDuration','$numScene','$numProcess')";


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

function getUserData($host,$port,$user,$pass,$database)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_PROJECTS WHERE UPPER(PROJECT_STATUS) = 'APPROVED'";
  $projectName = array();
  $animationDuration = array();
  $numScene = array();
  $numProcess = array();
  $process = array();
  $project_description = array();
  $project_status = array();
  $ep_count = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $projectName[$counter] = $row['PROJECT_NAME'];
                   $animationDuration[$counter] = $row['ANIMATION_DURATION'];
                   $numProcess[$counter] = $row['NUM_OF_ANIMATION_PROCESS'];
                   $process[$counter] = $row['ANIMATION_PROCESS'];
                   $project_description[$counter] = $row['PROJECT_DESCRIPTION'];
                   $project_status[$counter] = $row['PROJECT_STATUS'];
                   $ep_count[$counter] = $row['EPISODE_COUNT'];

                   $counter++;
                }
            }

  $dataArray[0] = $projectName;
  $dataArray[1] = $animationDuration;
  $dataArray[2] = $numProcess;
  $dataArray[3] = $process;
  $dataArray[4] = $project_description;
  $dataArray[5] = $project_status;
  $dataArray[6] = $ep_count;

return $dataArray;

}

function currentEpCount($host,$port,$user,$pass,$database,$projectName)
{
  $ep_count = 0;
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT COUNT(EPISODE_ID) AS COUNT FROM AMS_EPISODE WHERE PROJECT_NAME = '$projectName'
            AND UPPER(STATUS) = 'APPROVED'";

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $ep_count = $row['COUNT'];
                }
            }

return $ep_count;

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
