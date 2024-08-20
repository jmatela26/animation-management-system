<?php
  session_start();
  error_reporting(0);
  $current_user = $_SESSION['user'];
  $access = $_SESSION['access'];
  $name = $_SESSION['projectName'];
  $project = $_SESSION['project_name'];

  $id = $_SESSION['id'];
  $task = $_SESSION['taskName'];
  $process = $_SESSION['process'];

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
  <br/>
  <br/>
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

  <h2 style = "margin-top: -10px; margin-bottom:-10px;" class="container fadeInRight animated"> Task<?php echo $id." ".$task?> Submission</h2>

  <button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Previous</button>

  <br/>
   <?php

       $dataArray = getUserData($host,$port,$user,$pass,$database,$project,$id);

       $id = array(); $scene = array(); $projectName = array(); $start_date = array(); $end_date = array(); $file = array();

       $id = $dataArray[0];
       $scene = $dataArray[1];
       $projectName = $dataArray[2];
       $start_date = $dataArray[3];
       $end_date = $dataArray[4];
       $file = $dataArray[5];

    ?>

<table class="container lightSpeedIn animated">
  <th>Task ID</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>File Uploaded</th>
  <th></th>
<Form method="POST">

  <?php
    $counter = 0;

      for($i = 0; $i < sizeOf($id); $i++)
      {

          echo "<tr>
                <td><p> $id[$i] </p></td>
                <td><p>$start_date[$i]</p></td>
                <td><p>$end_date[$i]</p></td>
                <td><p><a href=\"streamVideo.php?page=$file[$i]\">$file[$i]</p></td>
                <td>
                <p>
                <button name=\"btn_download$i\">Download</button>
                <button name=\"btn_remark$i\">View Remarks</button>

                </p>
                </td>
                </tr>";

          $counter = $i;
      }

      for($i = 0 ; $i <= $counter; $i++)
      {
         if(isset($_POST['btn_download'.$i]))
         {

          $dir = "uploads/";
          $fileName = $dir . $file[$i];

            if(!empty($file[$i]))
            {
                $_SESSION['file'] = $fileName;
                echo '<meta http-equiv="refresh" content="0; URL=download_submission.php" />';
            }
            else{echo "<script>alert('No file to download');</script>";}

         }
         if(isset($_POST['btn_remark'.$i]))
         {
           echo '<meta http-equiv="refresh" content="0; URL=Remarks.php" />';
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

function saveTask($host,$database,$user,$pass,$port,$task,$project_name,$date,$task_remarks,$process)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_REMARKS(SCENE,PROJECT_NAME,DATE,REMARKS,PROCESS_NAME)
                        VALUES('$task','$project_name',
                               '$date','$task_remarks','$process')";


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

function deleteRemarks($host,$database,$user,$pass,$port,$id)
{
  $isDeleted = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "DELETE FROM AMS_REMARKS WHERE ID = $id";

  if($conn->query($sql) === TRUE){$isDeleted = true;}

  $conn->close();

  return $isDeleted;
}

  function getUserData($host,$port,$user,$pass,$database,$projectName,$id)
  {
      $dataArray = array();
      $conn = sqlConnection($host,$port,$user,$pass,$database);
      $sql = "SELECT * FROM AMS_TASK WHERE PROJECT_NAME = '$projectName' AND ID = '$id' ORDER BY START_DATE DESC;";
      $id = array();
      $scene = array();
      $projectName = array();
      $start_date = array();
      $end_date = array();
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
                       $start_date[$counter] = $row['START_DATE'];
                       $end_date[$counter] = $row['END_DATE'];
                       $file[$counter] = $row['TASK_FILE'];

                       $counter++;
                    }
                }

      $dataArray[0] = $id;
      $dataArray[1] = $scene;
      $dataArray[2] = $projectName;
      $dataArray[3] = $start_date;
      $dataArray[4] = $end_date;
      $dataArray[5] = $file;

    return $dataArray;

}


function displayPopUp($host,$port,$user,$pass,$database)
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";


      echo "  <label><b>Task Date</b></lable>
        <p style=\"border:1px solid #ccc; margin-top:5px; padding:5px; padding-top:15px;\"><label>&nbsp;&nbsp;From &nbsp;</label>
        <input type=\"date\"  name=\"txt_date\" value=\"\" required>
        <br><br></p>

        <label><b>Task Remarks</b></label>
        <textarea name=\"txt_remarks\" placeholder=\"Remarks\" value=\"\" required></textarea>

        <div class=\"clearfix\">

      <button type=\"submit\" class=\"signupbtn\" name=\"btn_addTask\">Add Task</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div>";
}

function ViewUsers($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_USERS";
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

function displayComboBox2($host,$port,$user,$pass,$database)
{
  $dateArray = ViewDates($host,$port,$user,$pass,$database);
  $numOfDates = sizeOf($dateArray);

  for($i = 0 ; $i < $numOfDates; $i++)
  {
     echo "<option value=\"$dateArray[$i]\">$dateArray[$i]</option>";
  }

}

?>
<script>
function goBack() {
  window.location = "Scenes.php";
}

</script>
