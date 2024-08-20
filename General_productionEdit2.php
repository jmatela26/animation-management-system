<?php

   session_start();

   $id = $_SESSION['ID'];
   $projectName = $_SESSION['projectName'];
   $animationDuration = $_SESSION['animationDuration'];
   $ep_count = $_SESSION['ep_count'];
   $numProcess = $_SESSION['numProcess'];
   $process = $_SESSION['process'];
   $description = $_SESSION['description'];
   $status = $_SESSION['status'];

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
<button onclick = "goBack()" class="previous" style ="width:auto;">&laquo; Back</button>
  <form method="POST">

<fieldset id = "fieldaddprocess" >
<legend><h1 style="color:#990000" ><b>Add Process</b></h1></legend>
<div id="process">
<?php

if(!empty($process)){$processArray = explode(",",$process);}
  else{$processArray = null;}

  for($i = 0 ; $i < $numProcess; $i++)
  {
      displayTable($i,$numProcess,$processArray[$i]);
  }

?>
</div>

<center>
<textarea name = "txt_description" placeholder="Project Description" class="textbox">
  <?php echo $description;?>
</textarea>
<br/>
<br/>
Project Status: <select name = "cmb_status" class="textbox">
  <?php if(!empty($status))
        {echo "<option value = \"$status\">$status</option>";}
  ?>
<option value = "approved">Approved</option>
<option value = "revise">Revise</option>
<option value = "disapproved">Disapproved</option>
</select>
<br/>
<br/>

<center>
<button name = "btn_updateProject" class="savebtn" > Update Project </button>
</center>
   <?php

     $process = null;
     $seconds = null;
     $foot = null;
     $drawing = null;


     if(isset($_POST['btn_updateProject']))
     {
       $description = $_POST['txt_description'];
       $status = $_POST['cmb_status'];
       $processArray = array();

       for($i = 0 ; $i < $numProcess; $i++)
       {
          $processArray[$i] = $_POST['txt_process'.$i];
       }


          if(editProject($host,$port,$user,$pass,$database,$id,$projectName,$animationDuration,$ep_count,$numProcess,
                               $processArray,$description,$status))
                               {
                                 echo "<script>alert('Project Updated!');</script>";
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


function editProject($host,$port,$user,$pass,$database,$id,$projectName,$animationDuration,$ep_count,$numProcess,
                     $processArray,$description,$status)
{
  $isSaved = false;
  $conn = sqlConnection($host,$port,$user,$pass,$database);

  $process = implode(',',$processArray);

  $sql = "UPDATE AMS_PROJECTS
          SET PROJECT_NAME = '$projectName',
          ANIMATION_DURATION = '$animationDuration',
          EPISODE_COUNT = '$ep_count',
          NUM_OF_ANIMATION_PROCESS = '$numProcess',
          ANIMATION_PROCESS = '$process',
          PROJECT_DESCRIPTION = '$description',
          PROJECT_STATUS = '$status'
          WHERE PROJECT_ID = $id;";


  if($conn->query($sql) === TRUE){ $isSaved = true;}
  else
  {echo "<scipt>alert('Error: \" . $sql . \"<br>\". $conn->error');</script>";}
    $conn->close();

  return $isSaved;
}

function displayTable($i,$num,$process)
{
 $numProcess = $i + 1;

  echo "<fieldset id=\"fieldProcess\" >
<legend><b>$numProcess</b></legend>
 <dl>
  <dt>
  <input type = \"text\" class=\"textbox\"  name = \"txt_process$i\"
  value =\"$process\"placeholder = \"Process $numProcess\"><br/><br/><br/></dt>
</dl>";

if($num > 0 && $i != $num-1)
{
echo  "<h1 style=\"margin-left:10px; float:right\">&#x2192;</h1><br/>";

}

echo "</fieldset>";
}
?>
<script>
function goBack() {
    window.history.back();
}
function goNext()
{
 	window.history.forward();
}
</script>
