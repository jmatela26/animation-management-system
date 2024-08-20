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
  $project_description = array(); $project_status = array(); $ep_count = array(); $project_id = array();

  $projectName = $dataArray[0];
  $animationDuration = $dataArray[1];
  $numProcess = $dataArray[2];
  $process = $dataArray[3];
  $project_description = $dataArray[4];
  $project_status = $dataArray[5];
  $ep_count = $dataArray[6];
  $project_id = $dataArray[7];



 ?>

<!DOCTYPE html>
<html>
<title>General Production</title>
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
  <h2 style = "margin-top: -50px" class="container fadeInRight animated"> General Production </h2>

        <?php
        echo "<button onclick=\"document.getElementById('id01').style.display='block'\"  class=\"container bounceIn animated\"
        style=\"width:auto;\">Add Project</button>  ";
            AddProject();


            if(isset($_POST['btn_addProject']))
            {
                $projectName = $_POST['txt_projectName'];
                $animationDuration = $_POST['txt_animationDuration'];
                $numEp = $_POST['txt_numEp'];
                $numProcess = $_POST['txt_numProcess'];

                $_SESSION['projectName'] = $projectName;
                $_SESSION['animationDuration'] = $animationDuration;
                $_SESSION['numEp'] = $numEp;
                $_SESSION['numProcess'] = $numProcess;

                if(!empty($animationDuration))
                {  echo '<meta http-equiv="refresh" content="0; URL=addProcess.php" />';}


            }


        ?>

  </form>


  <form method="POST">
    <input type="submit" name="btn_excel" class="button" value="Generate Excel" style="width:auto"/>
    <?php

        if(isset($_POST['btn_excel']))
        {
            $_SESSION['table'] = "AMS_PROJECTS";
            echo '<meta http-equiv="refresh" content="0; URL=ExportToExcel.php" />';
        }

    ?>
  </form>


<table class="container lightSpeedIn animated">
  <th> Project Name </th>
  <th> Episode Count </th>
  <th> Scenes per Episode </th>
  <th> Processes</th>
  <th> Description </th>
  <th> Status </th>
  <th> </th>
    <Form method="POST">
  <?php
  $counter = 0;

      for($i = 0; $i < sizeOf($projectName); $i++)
      {

        $processArray = explode(",",$process[$i]);
        $processArraySize = sizeOf($processArray);

          echo "<tr>
                <td><p> $projectName[$i] </p></td>
                <td><p> $ep_count[$i] </p></td>
                <td><p> $animationDuration[$i] </p></td>

                <td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";

          for($j = 0 ; $j < $processArraySize; $j++ )
          {
            if($j != $processArraySize-1)
            {echo "$processArray[$j] &#x2192;";}
            else {  echo " $processArray[$j] ";}
          }

            echo " </p> </td>
                <td><p> $project_description[$i] </p></td>
                <td><p> $project_status[$i] </p></td>

                <td>

                <button name = \"btn_edit$i\">Edit</button>
                <button name = \"btn_delete$i\" onclick=\"return confirm('Are you sure you want to delete this item?');\">
                Delete</button>
                <button name = \"btn_viewAssets$i\">View Assets</button>
                </td>
                </tr>";

          $counter = $i;
      }

   for($i = 0; $i < sizeOf($project_id); $i++)
   {
      if(isset($_POST['btn_viewAssets'.$i]))
      {
            $_SESSION['projectName'] = $projectName[$i];
            echo '<meta http-equiv="refresh" content="0; URL=viewAssets.php" />';
      }
      if(isset($_POST['btn_edit'.$i]))
      {
          $_SESSION['ID'] = $project_id[$i];
          $_SESSION['projectName'] = $projectName[$i];
          $_SESSION['animationDuration'] = $animationDuration[$i];
          $_SESSION['ep_count'] = $ep_count[$i];
          $_SESSION['NumberOfAnimationProcesses'] = $numProcess[$i];
          $_SESSION['process'] = $process[$i];
          $_SESSION['description'] = $project_description[$i];
          $_SESSION['status'] = $project_status[$i];

          echo '<meta http-equiv="refresh" content="0; URL=General_productionEdit.php" />';
      }

      if(isset($_POST['btn_delete'.$i]))
      {
        if(DeleteProject($host,$port,$user,$pass,$database,$project_id[$i],$projectName[$i]))
        {
          echo "<script>alert('Project Deleted');</script>";
          echo '<meta http-equiv="refresh" content="0; URL=generalproductionreport.php" />';
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
  $sql = "SELECT * FROM AMS_PROJECTS";
  $projectName = array();
  $animationDuration = array();
  $numProcess = array();
  $process = array();
  $project_description = array();
  $project_status = array();
  $ep_count = array();
  $project_id = array();



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
                   $project_id[$counter] = $row['PROJECT_ID'];

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
  $dataArray[7] = $project_id;

return $dataArray;

}

function AddProject()
{
 displayPopUp();
}



function EditUser($selectedIndex,$host,$port,$user,$pass,$database)
{
  $dataArray = getUserData($host,$port,$user,$pass,$database);

  $username = array(); $fname = array(); $lname = array(); $mname = array(); $access = array();
  $position = array(); $gender = array();

  $username = $dataArray[0];
  $fname = $dataArray[1];
  $lname = $dataArray[2];
  $mname = $dataArray[3];
  $access = $dataArray[4];
  $position = $dataArray[5];
  $gender = $dataArray[6];

  foreach($selectedIndex as $i )
  {

  displayPopUp($fname[$i],$lname[$i],$mname[$i],$position[$i],$access[$i],$gender[$i],$username[$i],"");
  }
}

function DeleteProject($host,$port,$user,$pass,$database,$id,$project_name)
{
  $isDeleted = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "DELETE FROM AMS_PROJECTS WHERE PROJECT_ID = '$id';
					    delete from ams_assets WHERE project_name = '$project_name';
				    	delete from ams_episode WHERE PROJECT_NAME = '$project_name';
						delete from ams_projects WHERE PROJECT_NAME = '$project_name';
						delete from ams_remarks WHERE PROJECT_NAME = '$project_name';
						delete from ams_task WHERE PROJECT_NAME = '$project_name';";

    if($conn->query($sql) === TRUE)
    {
      $isDeleted = true;
    }
    else
    {
      echo "<script>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";
    }

  $conn->close();

  return $isDeleted;
}

function displayPopUp()
{
  echo "
   <div id=\"id01\" class=\"modal\">
     <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">×</span>
     <form class=\"modal-content animate\" method=\"POST\">
       <div class=\"container\">";

    echo " <label><b>Project Name</b></label>
        <input type=\"text\" placeholder=\"Project Name\" name=\"txt_projectName\" value=\"\" required>

        <label><b>Number of Episodes</b></label>
        <input type=\"text\" placeholder=\"Number of Episodes\" name=\"txt_numEp\" value=\"\" required>

        <label><b>Animation Duration</b></label>
        <input type=\"text\" placeholder=\"Number of Scenes per Episode\" name=\"txt_animationDuration\" value=\"\" required>

        <label><b>Number of Animation Processes</b></label>
        <input type=\"text\" placeholder=\"Number of Animation Processes\" name=\"txt_numProcess\" value=\"\" required>


        <div class=\"clearfix\">

      <button type=\"submit\" class=\"signupbtn\" name=\"btn_addProject\">Continue</button>
          <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">
          Cancel</button>
      </div></div></div></form>";
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
