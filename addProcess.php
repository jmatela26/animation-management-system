<?php

   session_start();

   $projectName = $_SESSION['projectName'];
   $animationDuration = $_SESSION['animationDuration'];
   $numEp = $_SESSION['numEp'];
   $numProcess = $_SESSION['numProcess'];


    $host = "localhost";
    $user = "root";
    $pass = "";
    $port = 3306;
    $database = "AMS_DB";
    $margin = "0";
    $marginRight ="0";

switch($numProcess)
{
    case 1 : $margin = "270px"; break;
    case 2 : $margin = "260px"; break;
    case 3 : $margin = "250px"; break;
    case 4 : $margin = "80px"; break;
    case 5 : $margin = "200px"; $marginRight = "250px"; break;


  }

?>
<html>
<head>
  <link rel = "stylesheet" href = "animate.css">
  <style>
  button {
      background-color: #0066ff;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 500px;
  }
  button:hover{
    background-color: #6699ff;
  }
  .cancelbtn {
      padding: 14px 20px;
      background-color: #f44336;
  }

  /* Float cancel and signup buttons and add an equal width */
  .cancelbtn,.savebtn {float:left;width:50%}
  body{
    margin:auto;
    background-image: url('bghomepage.png');
    height:100%;
    background-position: center;
    background-size:cover;
    background-attachment:fixed;
    background-repeat:no-repeat;
  }
  textarea{
  width: 800px;
  height: 100px;
  }

  div#approved{
  float:bottom;
  }
  dl{
  float:left;
  }

  div#process
  {
    margin:auto;
  }
  fieldset#fieldaddprocess
  {
   padding:10px;
   margin-left: <?php echo $margin?>;
   margin-right: <?php echo $marginRight?>;

  }

 input.textbox
 {
   border: 1.9px solid #00334d;
 }
 input.textbox2
 {
   border: 1.2px solid #0099e6;
 }

 select
 {
   border: 1.9px solid #00334d;
   width: 20%;
   position: center;
 }


  fieldset {
    background-color:#e6e6ff;
    opacity: 0.90;
      display: block;
      margin:1px;
      margin-bottom:20px;
      padding-top: 2em;
      padding-bottom: 1em;
      padding-left: 1em;
      padding-right: 1em;
  	  float:left;
      border: 5px;
  	  border-style: outset;
  	  border-color: black;

  }

      img#logo {
      opacity: 0.8;
      filter: alpha(opacity=70); /* For IE8 and earlier */
  }

  img#logo:hover {
      opacity: 1.0;
      filter: alpha(opacity=100); /* For IE8 and earlier */

      }

      textarea
      {

        border:2px solid #00334d;
      }

  </style>
</head>
<body>
<center><a href = "home.php"><img src = "logo.png"  class="container bounceIn animated" id = "logo" ></a></center>
  <form method="POST">
<fieldset id = "fieldaddprocess" >
<legend><h1 style="color:#990000" ><b>Add Process</b></h1></legend>
<div id="process">
<?php

  for($i = 0 ; $i < $numProcess; $i++)
  {
    displayTable($i,$numProcess);
  }

?>
</div>

<center>
<textarea name = "txt_description" placeholder="Project Description" class="textbox"></textarea>
<br/>
<br/>
Project Status: <select name = "cmb_status" class="textbox">
<option value = "approved">Approved</option>
<option value = "revise">Revise</option>
<option value = "disapproved">Disapproved</option>
</select>
<br/>
<br/>


<button name = "btn_addProject" class="savebtn" > Add Project </button>
<button class="cancelbtn"> Reset </button>

   <?php

     $process = null;
     $seconds = null;
     $foot = null;
     $drawing = null;


     if(isset($_POST['btn_addProject']))
     {
       $description = $_POST['txt_description'];
       $status = $_POST['cmb_status'];

          for($i = 0; $i < $numProcess; $i++)
          {
              if($i == 0){$process = $_POST['txt_process'.$i];}
              else{$process .= ', ' . $_POST['txt_process'.$i];}
          }

          if(saveProject($host,$port,$user,$pass,$database,$projectName,$animationDuration,$numEp,$numProcess,
                               $process,$description,$status))
                               {
                                 echo '<meta http-equiv="refresh" content="0; URL=generalproductionreport.php" />';
                               }


     }

    ?>

  </form>
	</fieldset>
	</center>

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

function getUserData($host,$port,$user,$pass,$database,$projectName)
{
  $dataArray = array();
  $conn = sqlConnection($host,$port,$user,$pass,$database);
  $sql = "SELECT * FROM AMS_PROJECTS WHERE PROJECT_NAME = '$projectName'";
  $projectName = array();
  $animationDuration = array();
  $numScene = array();
  $numProcess = array();
  $process = array();
  $project_description = array();
  $project_status = array();

            $result = $conn->query($sql);
            $counter = 0;
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc())
                 {
                   $numProcess[$counter] = $row['NUM_OF_ANIMATION_PROCESS'];
                   $process[$counter] = $row['ANIMATION_PROCESS'];

                   $counter++;
                }
            }


  $dataArray[0] = $numProcess;
  $dataArray[1] = $process;

  return $dataArray;
}

function saveProject($host,$port,$user,$pass,$database,$projectName,$animationDuration,$numEp,$numProcess,
                     $process,$description,$status)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $sql = "INSERT INTO AMS_PROJECTS(PROJECT_NAME,ANIMATION_DURATION,EPISODE_COUNT,NUM_OF_ANIMATION_PROCESS,
                                   ANIMATION_PROCESS,PROJECT_DESCRIPTION,PROJECT_STATUS)
                      VALUES('$projectName','$animationDuration','$numEp','$numProcess', '$process',
                             '$description','$status')";


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

function displayTable($i,$num)
{
 $numProcess = $i + 1;

  echo "<fieldset id=\"fieldProcess\" >
<legend><b>$numProcess</b></legend>
 <dl>
  <dt><input type = \"text\" class=\"textbox\"  name = \"txt_process$i\" placeholder = \"Process $numProcess\"></dt>
</dl>";

if($num > 0 && $i != $num-1)
{
echo  "<h1 style=\"margin-left:10px; float:right\">&#x2192;</h1>";
}

echo "</fieldset>";
}
