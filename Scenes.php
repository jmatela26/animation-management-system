<?php
  session_start();
  error_reporting(0);

  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];
  $name = $_SESSION['projectName'];
  $ep_id = $_SESSION['episode_id'];
  $ep_name = $_SESSION['ep_name'];
  $project = $_SESSION['project_name'];

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

input[type=color]
{
  width: 96%;
  padding: 12px 20px;
  background-color:white;
  margin: 10px 2 0 5px;
  margin-top:10px;
  margin-bottom:10px;
  border: 1px solid #ccc;

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

input[type=submit] {
    background-color: #0066ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;

}
input[type=submit]:hover{
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
  <h2 style = "margin-top: -50px" class="container fadeInRight animated"> <?php echo $name." ".$ep_name;?> Scenes </h2>


    <button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Previous</button>


<form method="POST">
  <select name = "cmb_sort1">
      <option value='' disabled selected>Sort</option>
      <option value='ID'>Default</option>
      <option value='SCENE'>Sort by Scene/Asset Name</option>
      <option value='SCENE_ARTIST'>Sort by Artist Name</option>
      <option value='SCENE_STATUS'>Sort by Status</option>
   </select>
   <select name = "cmb_sort2">
       <option value='Default' disabled selected>Date</option>
       <option value='Default'>ALL</option>
       <?php displayComboBox2($host,$port,$user,$pass,$database);?>
   </select>
   <select name = "cmb_sort3">
       <option value='Default' disabled selected>Artist</option>
       <option value=''>Default</option>
       <?php displayComboBox($host,$port,$user,$pass,$database);?>
   </select>
   <button name = 'btn_sort'> SORT TABLE </button>

   <?php

if(!empty($_SESSION['whereClause']))
{
   $whereClause = $_SESSION['whereClause'];
   $orderbyClause  = $_SESSION['orderbyClause'];
 }
 else {
   $whereClause = '';
   $orderbyClause  = '';
 }
   if (isset($_POST['btn_sort']))
   {
     if(isset($_POST['cmb_sort1']))
     {
       $sort1 = $_POST['cmb_sort1'];
       $orderbyClause = "ORDER BY $sort1";
       if($sort1 == 'Default')
       {
       }
       $orderbyClause = "";
     }
     if(isset($_POST['cmb_sort2']))
     {
       $sort2 = $_POST['cmb_sort2'];
       $whereClause = " AND START_DATE >= '$sort2'";
       if($sort2 == 'Default')
       {
         $whereClause = '';
       }
     }
     if(isset($_POST['cmb_sort3']))
     {
       $sort3 = $_POST['cmb_sort3'];
       if($whereClause != '')
       {
           $whereClause .= " AND SCENE_ARTIST = '$sort3' ";
       }
       else
       {
          $whereClause = "AND SCENE_ARTIST = '$sort3' ";
          if($sort3 == 'Default')
          {
            $whereClause = '';
          }
       }
     }
     $_SESSION['whereClause'] = $whereClause;
     $_SESSION['orderbyClause'] = $orderbyClause;
     echo '<meta http-equiv="refresh" content="0; URL=Scenes.php" />';
   }

   $dataArray = getUserData($host,$port,$user,$pass,$database,$project,$ep_name,$whereClause,
                            $orderbyClause,$access);

   $id = array(); $scene = array(); $process = array(); $sceneArtist = array(); $sceneStatus = array();
   $sceneFrames = array(); $startDate = array(); $endDate = array(); $value_type = array(); $taskType = array();

   $id = $dataArray[0];
   $scene = $dataArray[1];
   $process = $dataArray[2];
   $sceneArtist = $dataArray[3];
   $sceneStatus = $dataArray[4];
   $sceneFrames = $dataArray[5];
   $startDate = $dataArray[6];
   $endDate = $dataArray[7];
   $value_type = $dataArray[8];
   $color = $dataArray[9];
   $taskType = $dataArray[10];

    ?>
</form>
<?php
if(strtoupper($access) != "CHECKER")
{?>
  <button  class="container bounceIn animated"
  onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Task</button>

  <?php

    displayPopUp($host,$port,$user,$pass,$database,$name);
}


  if(isset($_POST['btn_addTask']))
  {
    $task = $_POST['txt_task'];
    $project_name = $name;
    $process = $_POST['txt_process'];
    $scene_artist = $_POST['txt_sceneArtist'];
    $status = $_POST['cmb_status'];
    $frames = $_POST['txt_frames'];
    $start_date = $_POST['txt_startDate'];
    $end_date = $_POST['txt_endDate'];
    $value = $_POST['txt_value'];
    $type = $_POST['cmb_type'];
    $taskColor = $_POST['txt_color'];
    $taskType = $_POST['cmb_taskType'];

    $value_type = $value . "(" . $type . ")";

      if(saveTask($host,$database,$user,$pass,$port,$task,$project_name,$scene_artist,$status,$frames,$process,
               $start_date,$end_date,$value_type,$ep_name,$taskColor,$taskType))
               {
                 echo "<script>alert('Task added');</script>";
                 echo '<meta http-equiv="refresh" content="0; URL=Scenes.php" />';
               }


  }

  ?>
</form>

<?php
if(strtoupper($access) != "CHECKER")
{?>
<form method="POST">
  <input type="submit" name="btn_excel" class="button" value="Generate Excel" style="width:auto"/>
  <input type="submit" name="btn_ganttChart" class="button" value="Gantt Chart View" style="width:auto"/>

<?php
      if(isset($_POST['btn_excel']))
      {
          $_SESSION['table'] = "AMS_TASK";
          echo '<meta http-equiv="refresh" content="0; URL=ExportToExcel.php" />';
      }
      if(isset($_POST['btn_ganttChart']))
      {
         $_SESSION['id'] = $id;
         $_SESSION['process'] = $process;
         $_SESSION['task'] = $scene;
         $_SESSION['startDate'] = $startDate;
         $_SESSION['endDate'] = $endDate;
         $_SESSION['color'] = $color;
         echo '<meta http-equiv="refresh" content="0; URL=ganttChart.php" />';
      }

  ?>
</form>
<?php } ?>


<table class="container lightSpeedIn animated">
  <th> ID </th>
  <th> Task </th>
  <th> Task Type </th>
  <th> Process </th>
  <th> Scene Artist </th>
  <th> Scene Status </th>
  <th> Scene Frames </th>
  <th> Start Date </th>
  <th> Due Date </th>
  <th> SECONDS/FOOT/DRAWING </th>
  <th> Remarks </th>
  <th></th>

<Form method="POST">

  <?php
    $counter = 0;

      for($i = 0; $i < sizeOf($scene); $i++)
      {
        $remarks[$i] = getRemarks($host,$port,$user,$pass,$database,$name,$scene[$i]);

          echo "<tr>
                <td style=\"background-color:$color[$i]; color:white\"><p> $id[$i] </p></td>
                <td><p> $scene[$i] </p></td>
                <td><p> $taskType[$i] </p></td>
                <td><p> $process[$i] </p></td>
                <td><p> $sceneArtist[$i] </p></td>
                <td><p> $sceneStatus[$i] </p></td>
                <td><p> $sceneFrames[$i] </p></td>
                <td><p> $startDate[$i] </p></td>
                <td><p> $endDate[$i] </p></td>
                <td><p> $value_type[$i] </p></td>
                <td><p> $remarks[$i] </p></td>
                <td>
                <p>
                <button name=\"btn_process$i\"> Scene Submission </button>";

            if(strtoupper($access) != "CHECKER")
            {
                echo "<button name=\"btn_Edit$i\">Edit</button>
                      <button name=\"btn_Delete$i\">Delete</button>";
            }
              echo "</p>
                    </td>
                    </tr>";

          $counter = $i;
      }

      for($i = 0 ; $i <= $counter; $i++)
      {
         if(isset($_POST['btn_process'.$i]))
         {
            $_SESSION['id'] = $id[$i];
            $_SESSION['process'] = $process[$i];
            $_SESSION['taskName'] = $scene[$i];
            echo '<meta http-equiv="refresh" content="0; URL=ScenesOverview.php" />';
         }

         if(isset($_POST['btn_Edit'.$i]))
         {
             $_SESSION['id'] = $id[$i];
             $_SESSION['taskName'] = $scene[$i];
             $_SESSION['taskType'] = $taskType[$i];
             $_SESSION['taskColor'] = $color[$i];
             $_SESSION['projectName'] = $name;
             $_SESSION['process'] = $process[$i];
             $_SESSION['taskArtist'] = $sceneArtist[$i];
             $_SESSION['taskStatus'] = $sceneStatus[$i];
             $_SESSION['taskFrames'] = $sceneFrames[$i];
             $_SESSION['startDate'] = $startDate[$i];
             $_SESSION['endDate'] = $endDate[$i];
             $_SESSION['value_type'] = $value_type[$i];

           echo '<meta http-equiv="refresh" content="0; URL=ScenesEdit.php"/>';
         }

         if(isset($_POST['btn_Delete'.$i]))
         {
             if(deleteScene($host,$database,$user,$pass,$port,$id[$i]))
             {
               echo "<script>alert('Scene Deleted');</script>";
               echo '<meta http-equiv="refresh" content="0; URL=Scenes.php"/>';
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

function saveTask($host,$database,$user,$pass,$port,$task,$project_name,$scene_artist,$status,$frames,$process,
                  $start_date,$end_date,$value_type,$ep_name,$taskColor,$taskType)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_TASK(SCENE,PROJECT_NAME,SCENE_ARTIST,SCENE_STATUS,SCENE_FRAMES,PROCESS,START_DATE,END_DATE,
                        TYPE_VALUE,TASK_EPISODE,TASK_COLOR,TASK_TYPE)
                        VALUES('$task','$project_name','$scene_artist','$status','$frames','$process',
                               '$start_date','$end_date','$value_type','$ep_name','$taskColor','$taskType')";


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

function deleteScene($host,$database,$user,$pass,$port,$id)
{
  $isDeleted = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "DELETE FROM AMS_TASK WHERE ID = $id";

  if($conn->query($sql) === TRUE){$isDeleted = true;}

  $conn->close();

  return $isDeleted;
}

function getUserData($host,$port,$user,$pass,$database,$project_name,$ep_name,$whereClause,$orderbyClause,
                     $access)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  if(strtoupper($access) != "CHECKER")
  {
    $sql = "SELECT * FROM AMS_TASK WHERE PROJECT_NAME = '$project_name' AND TASK_EPISODE = '$ep_name'"
        ." ".$whereClause." ".$orderbyClause.";";
  }
  else
   {
    $sql = "SELECT * FROM AMS_TASK WHERE PROJECT_NAME = '$project_name' AND TASK_EPISODE = '$ep_name'"
        ." ".$whereClause." ".$orderbyClause.";";
   }
  $id = array();
  $scene = array();
  $process = array();
  $projectName = array();
  $sceneArtist = array();
  $sceneStatus = array();
  $sceneFrames = array();
  $startDate = array();
  $endDate = array();
  $value_type = array();
  $color = array();
  $taskType = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $id[$counter] = $row['ID'];
                   $scene[$counter] = $row['SCENE'];
                   $process[$counter] = $row['PROCESS'];
                   $projectName[$counter]= $row['PROJECT_NAME'];
                   $sceneArtist[$counter] = $row['SCENE_ARTIST'];
                   $sceneStatus[$counter] = $row['SCENE_STATUS'];
                   $sceneFrames[$counter] = $row['SCENE_FRAMES'];
                   $startDate[$counter] = $row['START_DATE'];
                   $endDate[$counter] = $row['END_DATE'];
                   $value_type[$counter] = $row['TYPE_VALUE'];
                   $color[$counter] = $row['TASK_COLOR'];
                   $taskType[$counter] = $row['TASK_TYPE'];

                   $counter++;
                }
            }

  $dataArray[0] = $id;
  $dataArray[1] = $scene;
  $dataArray[2] = $process;
  $dataArray[3] = $sceneArtist;
  $dataArray[4] = $sceneStatus;
  $dataArray[5] = $sceneFrames;
  $dataArray[6] = $startDate;
  $dataArray[7] = $endDate;
  $dataArray[8] = $value_type;
  $dataArray[9] = $color;
  $dataArray[10] = $taskType;


return $dataArray;

}


function displayPopUp($host,$port,$user,$pass,$database,$project_name)
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";

        echo "
        <label><b>Task Name</b></label>
        <input type=\"text\" placeholder=\"Scene/Asset Name\" name=\"txt_task\" value=\"\" required>";

        echo "
            <label><b>Task Type</b></label>
            <select name=\"cmb_taskType\">
              <option value='' disabled selected>-- Choose Type -- </option>
              <option value=\"SCENE\">SCENE</option>
              <option value=\"ASSET\">ASSET</option>
            </select>";

        echo "
            <label><b>Task Color</b></label><br/>
            <input type=\"color\" placeholder=\"Scene/Asset Name\" name=\"txt_color\" value=\"\"
            placeholder=\"Select Color\" required><br/>";

        echo "
        </select><label><b>Task Artist</b></label><Select name=\"txt_sceneArtist\" value=\"\" required>
        <option value=\"\" disabled selected>-- Choose Assigned Artist Name -- </option>";

        displayComboBox($host,$port,$user,$pass,$database);


        echo "</select><label><b>Task Process</b></label><Select name=\"txt_process\" value=\"\" required>
        <option value=\"\" disabled selected>-- Choose Process -- </option>";

        displayComboBox3($host,$port,$user,$pass,$database,$project_name);


        echo "</select><label><b>Task Status</b></label>
        <select name=\"cmb_status\">
          <option value='' disabled selected>-- Choose Status -- </option>
          <option value=\"PS\">PS</option>
          <option value=\"PFH\">PFH</option>
          <option value=\"AHO\">AHO</option>
          <option value=\"AFU\">AFU</option>
          <option value=\"TFU\">TFU</option>
          <option value=\"TFV\">TFV</option>
          <option value=\"ACFUV\">ACFUV</option>
          <option value=\"APPROVED\">APPROVED</option>
        </select>
        <label><b>Task Frames</b></label>
        <input type=\"text\" placeholder=\"Frames Per Second\" name=\"txt_frames\" value=\"\" required>
        <label><b>Task Date</b></lable>
        <p style=\"border:1px solid #ccc; margin-top:5px; padding:5px; padding-top:15px;\"><label>&nbsp;&nbsp;From &nbsp;</label>
        <input type=\"date\"  name=\"txt_startDate\" value=\"\" required>
        <label>&nbsp;  to &nbsp;</label>
        <input type=\"date\"  name=\"txt_endDate\" value=\"\" required><br><br></p>

        <label><b>Value and Type</b></label>
        <input type=\"number\" placeholder=\"Value\" name=\"txt_value\"
        value=\"$value\" required>

        <select name=\"cmb_type\">";

         if(sizeOf($type) > 0){echo "<option value=\"$type\">$type</option>";}
          else {echo " <option value='' disabled selected>-- Choose Type -- </option>";}

        echo "<option value=\"SECONDS\">SECONDS</option>
          <option value=\"FOOT\">FOOT</option>
          <option value=\"DRAWING\">DRAWING</option>
        </select>

        <div class=\"clearfix\">

      <button type=\"submit\" class=\"signupbtn\" name=\"btn_addTask\">Add Task</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div>";
}

function ViewUsers($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS WHERE UPPER(USER_PRIVILAGE) = 'ARTIST'";
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

}

function ViewDates($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT START_DATE FROM AMS_TASK";

  $date = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                 {
                   $date[$counter] = $row['START_DATE'];
                   $counter++;
                }
            }

  return $date;
}


function ViewProcess($host,$port,$user,$pass,$database,$project_name)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT ANIMATION_PROCESS FROM AMS_PROJECTS WHERE PROJECT_NAME = '$project_name'";
  $process = null;

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                 {
                   $process = $row['ANIMATION_PROCESS'];
                   $counter++;
                }
            }



return $process;
}


function displayComboBox2($host,$port,$user,$pass,$database)
{
  $dateArray = ViewDates($host,$port,$user,$pass,$database);
  $numOfDates = sizeOf($dateArray);

  for($i = 0 ; $i < $numOfDates; $i++)
  {
     echo "<option value=\"$dateArray[$i]\">$dateArray[$i]</option>";
  }

}

function displayComboBox3($host,$port,$user,$pass,$database,$project_name)
{
  $process = ViewProcess($host,$port,$user,$pass,$database,$project_name);
  $processArray = explode(",",$process);
  $arraySize = sizeOf($processArray);


  for($i = 0 ; $i < $arraySize; $i++)
  {
     echo "<option value=\"$processArray[$i]\">$processArray[$i]</option>";
  }
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
<script>
function goBack() {
  window.location = "episode.php";
}
function goNext()
{
 	window.history.forward();
}
</script>
