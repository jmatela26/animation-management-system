<?php

  session_start();
  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];

  $host = "localhost";
  $user = "root";
  $pass = "";
  $port = 3306;
  $database = "AMS_DB";

  $dataArray = getUserData($host,$port,$user,$pass,$database,$current_user);
  $remarks = null;

  $id = array(); $scene = array(); $projectName = array(); $sceneArtist = array(); $sceneStatus = array();
  $sceneFrames = array(); $startDate = array(); $endDate = array(); $seconds = array(); $file = array();

  $id = $dataArray[0];
  $scene = $dataArray[1];
  $projectName = $dataArray[2];
  $sceneArtist = $dataArray[3];
  $sceneStatus = $dataArray[4];
  $sceneFrames = $dataArray[5];
  $startDate = $dataArray[6];
  $endDate = $dataArray[7];
  $file = $dataArray[8];


 ?>

<!DOCTYPE html>
<html>
<title>Project Layout</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel = "stylesheet" href = "animate.css">
<style>
/* Full-width input fields */
input[type=text], input[type=password], input[type=number] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

textarea{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
height: 100px;
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
  <h2 style = "margin-top: -50px" class="container fadeInRight animated"> My Tasks </h2>




<table class="container lightSpeedIn animated">

  <th> ID </th>
  <th> Scene </th>
  <th> Project Name </th>
  <th> Scene Artist </th>
  <th> Scene Status </th>
  <th> Scene Frames </th>
  <th> Start Date </th>
  <th> Due Date </th>
  <th> File Submitted </th>
  <th> Remarks </th>
  <th></th>

<Form method="POST">
  <?php
    $counter = 0;

      for($i = 0; $i < sizeOf($projectName); $i++)
      {
          $remarks = getRemarks($host,$port,$user,$pass,$database,$projectName[$i],$scene[$i]);
          echo "<tr>
                <td><p> $id[$i] </p></td>
                <td><p> $scene[$i] </p></td>
                <td><p> $projectName[$i] </p></td>
                <td><p> $sceneArtist[$i] </p></td>
                <td><p> $sceneStatus[$i] </p></td>
                <td><p> $sceneFrames[$i] </p></td>
                <td><p> $startDate[$i] </p></td>
                <td><p> $endDate[$i] </p></td>
                <td><p> <a href = \"streamVideo.php?page=$file[$i]\"> $file[$i]</a> </p></td>
                <td><p> $remarks </p></td>
                <td>
                <button name = \"btn_add$i\"> Add Submission </button>
                </td>
                </tr>";

          $counter = $i;
      }

      for($i = 0 ; $i < sizeOf($projectName); $i++)
      {
        if(isset($_POST['btn_add'.$i]))
        {
          $_SESSION['id'] = $id[$i];
          $_SESSION['scene'] = $scene[$i];
          echo '<meta http-equiv="refresh" content="0; URL=add_submission.php" />';
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

function saveTask($host,$database,$user,$pass,$port,$task,$project_name,$scene_artist,$status,$frames,
                  $start_date,$end_date,$task_seconds,$task_remarks)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_TASK(SCENE,PROJECT_NAME,SCENE_ARTIST,SCENE_STATUS,SCENE_FRAMES,START_DATE,END_DATE,SECONDS,REMARKS)
                        VALUES('$task','$project_name','$scene_artist','$status','$frames',
                               '$start_date','$end_date','$task_seconds','$task_remarks')";


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

function getUserData($host,$port,$user,$pass,$database,$username)
{
  $dataArray = array();
  $name = getName($host,$port,$user,$pass,$database,$username);
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_TASK WHERE SCENE_ARTIST = '$name'";
  $id = array();
  $scene = array();
  $projectName = array();
  $sceneArtist = array();
  $sceneStatus = array();
  $sceneFrames = array();
  $startDate = array();
  $endDate = array();
  $seconds = array();
  $file = array();


            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $id[$counter] = $row['ID'];
                   $scene[$counter] = $row['SCENE'];
                   $projectName[$counter]= $row['PROJECT_NAME'];
                   $sceneArtist[$counter] = $row['SCENE_ARTIST'];
                   $sceneStatus[$counter] = $row['SCENE_STATUS'];
                   $sceneFrames[$counter] = $row['SCENE_FRAMES'];
                   $startDate[$counter] = $row['START_DATE'];
                   $endDate[$counter] = $row['END_DATE'];
                   $file[$counter] = $row['TASK_FILE'];

                   $counter++;
                }
            }

  $dataArray[0] = $id;
  $dataArray[1] = $scene;
  $dataArray[2] = $projectName;
  $dataArray[3] = $sceneArtist;
  $dataArray[4] = $sceneStatus;
  $dataArray[5] = $sceneFrames;
  $dataArray[6] = $startDate;
  $dataArray[7] = $endDate;
  $dataArray[8] = $file;

return $dataArray;

}


function displayPopUp()
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";

    echo "
        <label><b>Task Name</b></label>
        <input type=\"text\" placeholder=\"Scene/Asset Name\" name=\"txt_task\" value=\"\" required>
        <label><b>Project Name</b></label>
        <input type=\"text\" placeholder=\"Project Name\" name=\"txt_projectName\" value=\"\" required>
        <label><b>Task Artist</b></label>
        <input type=\"text\" placeholder=\"Assigned Artist Name\" name=\"txt_sceneArtist\" value=\"\" required>
        <label><b>Task Status</b></label>
        <select name=\"cmb_status\">
          <option value='' disabled selected>-- Choose Status -- </option>
          <option value=\"PS\">PS</option>
          <option value=\"PFH\">PFH</option>
          <option value=\"AHO\">AHO</option>
          <option value=\"AFU\">AFU</option>
          <option value=\"TFU\">TFU</option>
          <option value=\"TFV\">TFV</option>
          <option value=\"ACFUV\">ACFUV</option>
        </select>
        <label><b>Task Frames</b></label>
        <input type=\"text\" placeholder=\"Frames Per Second\" name=\"txt_frames\" value=\"\" required>
        <label><b>Task Date</b></lable>
        <p style=\"border:1px solid #ccc; margin-top:5px; padding:5px; padding-top:15px;\"><label>&nbsp;&nbsp;From &nbsp;</label>
        <input type=\"date\"  name=\"txt_startDate\" value=\"\" required>
        <label>&nbsp;  to &nbsp;</label>
        <input type=\"date\"  name=\"txt_endDate\" value=\"\" required><br><br></p>
        <label><b>Task Seconds</b></label>
        <input type=\"number\" placeholder=\"Seconds\" name=\"txt_seconds\" value=\"\" required>
        <label><b>Task Remarks</b></label>
        <textarea name=\"txt_remarks\" placeholder=\"Remarks\" value=\"\" required></textarea>

        <div class=\"clearfix\">

      <button type=\"submit\" class=\"signupbtn\" name=\"btn_addTask\">Add Task</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div>";
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

function getRemarks($host,$port,$user,$pass,$database,$projectName,$scene)
{
    $conn = sqlConnection($host,$port,$user,$pass,$database);
    $sql = "SELECT * FROM AMS_REMARKS WHERE PROJECT_NAME = '$projectName' AND SCENE = '$scene' ORDER BY DATE;";

    $remarks = null;


              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc())
                   {
                     $remarks= $row['REMARKS'];
                   }
              }

  return $remarks;

}



?>
