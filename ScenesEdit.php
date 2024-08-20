<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';

    $id = $_SESSION['id'];
    $scene = $_SESSION['taskName'];
    $color = $_SESSION['taskColor'];
    $projectName = $_SESSION['projectName'];
    $process = $_SESSION['process'];
    $sceneArtist = $_SESSION['taskArtist'];
    $sceneStatus = $_SESSION['taskStatus'];
    $sceneFrames = $_SESSION['taskFrames'];
    $startDate = $_SESSION['startDate'];
    $endDate = $_SESSION['endDate'];
    $value_type = $_SESSION['value_type'];
    $taskType = $_SESSION['taskType'];

    if($value_type != '')
    {
        $valueArray = explode('(',$value_type);
        if(sizeOf($valueArray) == 2)
        {
          $value = $valueArray[0];
          $type = $valueArray[1];
        }
        else { $value = $value_type; $type = 0; }
    }


 ?>
 <!DOCTYPE HTML>
<html>
<head>
  <style>
  input[type=text], input[type=password],input[type=number] {
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

  input[type=color]
  {
    width: 96%;
    padding: 15px 20px;
    background-color:white;
    margin: 10px 2 0 5px;
    margin-top:10px;
    margin-bottom:10px;
    border: 1px solid #ccc;

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
  div#kahon
  {
    background-color:#fefefe;
    padding:20px;
    margin:50px;
    margin-top:-15px;
  }
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

      h2{
        color:white;
        margin-top: 100px;
        font-style: italic;
        font-size: 40px;
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

  </style>
</head>
<body>
  <center><a href = "home.php"><img class="container rubberBand animated" src = "logo.png" id = "logo" ></a></center>

    <br/>
    <br/>
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Edit Task: <?php echo $scene?></h2>
  <div id="kahon">
    <form method="POST">

       <label><b>Task Name</b></label>
       <input type="text" placeholder="Scene/Asset Name" name="txt_task"
       value="<?php echo $scene;?>" required>

       <label><b>Task Type</b></label>
       <select name="cmb_taskType">
         <?php
              if(sizeOf($taskType) > 0)
              {echo "<option value=\"$taskType\">$taskType</option>";}
              else {echo " <option value='' disabled selected>-- Choose Status -- </option>";}
         ?>
         <option value="SCENE">SCENE</option>
         <option value="ASSET">ASSET</option>
       </select>

       <label><b>Task Color</b></label><br/>
       <input type="color" name="txt_color"
       value="<?php echo $color;?>" required><br/>

       <label><b>Process</b></label>
       <Select name="txt_process" required>
       <?php
            if(sizeOf($process) > 0){echo "<option value=\"$process\">$process</option>";}
            else {echo " <option value='' disabled selected>-- Choose Process -- </option>";}
            displayComboBox3($host,$port,$user,$pass,$database,$projectName);
       ?>
     </select>
       <label><b>Task Artist</b></label>
       <Select name="txt_sceneArtist" required>
       <?php
            if(sizeOf($sceneArtist) > 0){echo "<option value=\"$sceneArtist\">$sceneArtist</option>";}
            else {echo " <option value='' disabled selected>-- Choose Assigned Artist Name -- </option>";}
            displayComboBox($host,$port,$user,$pass,$database);
       ?>
      </select>
       <label><b>Task Status</b></label>
       <select name="cmb_status">
         <?php
              if(sizeOf($sceneStatus) > 0)
              {echo "<option value=\"$sceneStatus\">$sceneStatus</option>";}
              else {echo " <option value='' disabled selected>-- Choose Status -- </option>";}
         ?>
         <option value="PS">PS</option>
         <option value="PFH">PFH</option>
         <option value="AHO">AHO</option>
         <option value="AFU">AFU</option>
         <option value="TFU">TFU</option>
         <option value="TFV">TFV</option>
         <option value="ACFUV">ACFUV</option>
         <option value="APPROVED">APPROVED</option>
       </select>

       <label><b>Task Frames</b></label>
       <input type="text" placeholder="Frames Per Second" name="txt_frames"
       value="<?php echo $sceneFrames;?>" required>

       <label><b>Task Date</b></lable>
       <p style="border:1px solid #ccc; margin-top:5px; padding:5px; padding-top:15px;"><label>&nbsp;&nbsp;From &nbsp;</label>
       <input type="date"  name="txt_startDate"
       value="<?php echo $startDate;?>" required>
       <label>&nbsp;  to &nbsp;</label>
       <input type="date"  name="txt_endDate"
       value="<?php echo $endDate;?>" required><br><br></p>

       <label><b>Value and Type</b></label>
       <input type="number" placeholder="Value" name="txt_value"
       value="<?php echo $value;?>" required>

       <select name="cmb_type">
         <?php
              if(sizeOf($type) > 0)
                {echo "<option value=\"$type\">$type</option>";}
              else {echo " <option value='' disabled selected>-- Choose Type -- </option>";}
         ?>
         <option value="SECONDS">SECONDS</option>
         <option value="FOOT">FOOT</option>
         <option value="DRAWING">DRAWING</option>
       </select>


       <div class="clearfix">

          <button name="btn_update">Update</button>
          <button name="btn_cancel">Cancel</button>

          <?php

            if(isset($_POST['btn_update']))
            {
              $task = $_POST['txt_task'];
              $process = $_POST['txt_process'];
              $scene_artist = $_POST['txt_sceneArtist'];
              $status = $_POST['cmb_status'];
              $frames = $_POST['txt_frames'];
              $start_date = $_POST['txt_startDate'];
              $end_date = $_POST['txt_endDate'];
              $value = $_POST['txt_value'];
              $type = $_POST['cmb_type'];
              $color = $_POST['txt_color'];
              $taskType = $_POST['cmb_taskType'];
              $type_value = $value . '(' . $type . ')';

                if(editTask($host,$database,$user,$pass,$port,$id,$task,$process,$scene_artist,$status,$frames,
                            $start_date,$end_date,$type_value,$color,$taskType))
                         {
                            echo "<script>alert('Task updated');</script>";
                            echo '<meta http-equiv="refresh" content="0; URL=Scenes.php" />';
                         }
            }

            if(isset($_POST['btn_cancel']))
            {
              echo '<meta http-equiv="refresh" content="0; URL=Scenes.php" />';
            }

      ?>
      </form>

</div>
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

function editTask($host,$database,$user,$pass,$port,$id,$task,$process,$scene_artist,$status,$frames,
                  $start_date,$end_date,$type_value,$color,$taskType)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "UPDATE AMS_TASK
          SET SCENE = '$task',
          PROCESS = '$process',
          SCENE_ARTIST = '$scene_artist',
          SCENE_STATUS = '$status',
          SCENE_FRAMES = '$frames',
          START_DATE = '$start_date',
          END_DATE = '$end_date',
          TYPE_VALUE = '$type_value',
          TASK_COLOR = '$color',
          TASK_TYPE = '$taskType'
          WHERE ID = $id";

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

function ViewProjects($host,$port,$user,$pass,$database)
{

  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_PROJECTS";

  $projectName = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                 {
                   $projectName[$counter] = $row['PROJECT_NAME'];
                   $counter++;
                }
            }

return $projectName;
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
  $projectArray = ViewProjects($host,$port,$user,$pass,$database);
  $numOfProjects = sizeOf($projectArray);

  for($i = 0 ; $i < $numOfProjects; $i++)
  {
    $projectName = strtoupper($projectArray[$i]);
    echo "<option value=\"$projectArray[$i]\">$projectName</option>";
  }
  echo "</select>";

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
