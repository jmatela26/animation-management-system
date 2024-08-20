<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';

    $id = $_SESSION['id'];
    $scene = $_SESSION['task'];
    $projectName = $_SESSION['projectName'];
    $process = $_SESSION['process'];
    $startDate = $_SESSION['date'];
    $remarks = $_SESSION['remarks'];

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

       <label><b>Task Remarks</b></label>
       <textarea name="txt_remarks" placeholder="Remarks" value="" required>
       <?php echo $remarks;?></textarea>

       <div class="clearfix">

          <button name="btn_update">Update</button>
          <button name="btn_cancel">Cancel</button>

          <?php

            if(isset($_POST['btn_update']))
            {
              $task_remarks = $_POST['txt_remarks'];

              date_default_timezone_set("Asia/Manila");
              $date =  date("Y/m/d");

                if(editTask($host,$database,$user,$pass,$port,$id,$date,$task_remarks))
                         {
                           echo "<script>alert('Task updated');</script>";
                           echo '<meta http-equiv="refresh" content="0; URL=Remarks.php" />';
                         }
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

function editTask($host,$database,$user,$pass,$port,$id,$date,$task_remarks)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "UPDATE AMS_REMARKS
          SET
          DATE = '$date',
          REMARKS = '$task_remarks'
          WHERE ID = $id";

  if($conn->query($sql) === TRUE){$isSaved = true;}
  $conn->close();

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
