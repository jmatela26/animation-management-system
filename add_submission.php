<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $port  = 3306;
    $database = 'AMS_DB';

    $id = $_SESSION['id'];
    $scene = $_SESSION['scene'];

 ?>
 <!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css.css">
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
    <h2 class="container fadeInRight animated" style = "margin-top: -50px"> Add Submission: <?php echo $scene?></h2>
  <div id="kahon">
    <form method="POST" enctype="multipart/form-data">

      <label><b>Upload File</b></lable>
      <p style="border:1px solid #ccc; margin-top:5px; padding:5px; padding-top:15px;">
        <input type="File" name="file"
             onchange="readURL(this);" style="margin-left:150px;" required/>
     <label id="demo"></label>
      <br><br></p>



          <button name="btn_update" onclick="upload()">Add Submission</button>
            <button name="btn_cancel" onclick="javascript:window.location='http://localhost:81/ams/mytask.php';">Cancel</button>


          <?php

            if(isset($_POST['btn_update']))
            {
              $file = $_FILES['file'];
              $fileName = $_FILES['file']['name'];
              $fileTmpName = $_FILES['file']['tmp_name'];
              $fileSize = $_FILES['file']['size'];
              $fileError = $_FILES['file']['error'];
              $fileType = $_FILES['file']['type']; $fileExt = explode('.', $fileName);
              $fileActualExt = strtolower(end($fileExt));

                try
                {

                    $fileUploaded = uploadFile($fileTmpName,$fileActualExt,$fileError,$fileSize);

                }
                catch (Exception $e)
                {
                    echo "<script>alert('Error in uploading file: ' $e);</script>";
                    $fileUploaded = null;
                }

                $filePath = "uploads/" . $fileUploaded;

                  if($fileUploaded != null)
                  {
                      date_default_timezone_set("Asia/Manila");
                      $date =  date("Y/m/d");

                      if(addSubmission($host,$user,$pass,$database,$port,$id,$fileUploaded,$date))
                      {
                         echo "<script>alert('Submission Successfully Added!');</script>";
                          echo '<meta http-equiv="Refresh" content="0; url=mytask.php">';
                      }
                  }
                  else
                  {
                    echo "<script>alert('There was a problem in uploading your file, please try again later.');</script>";
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

function uploadFile($fileTmpName,$fileActualExt,$fileError,$fileSize)
{
    $fileNameNew = uniqid('',true) . '.' . $fileActualExt;
    $fileDestination = 'uploads/'.$fileNameNew;
    move_uploaded_file($fileTmpName, $fileDestination);
    $img_id = $fileNameNew;

    return $img_id;

}


function addSubmission($host,$user,$pass,$database,$port,$id,$file,$date)
{
  $isSaved = false;

  $sql = "UPDATE AMS_TASK
          SET TASK_FILE = '$file',
          SUBMISSION_DATE = '$date'
          WHERE ID = $id";

  $conn = sqlConnection($host,$port,$user,$pass,$database);

  if($conn->query($sql) === TRUE)
  {
    $isSaved = true;
    $conn->close();
  }


   return $isSaved;

}
?>

<script>

function upload()
{
  document.getElementById("demo").innerHTML = "<progress id=\"progressBar\" max=\"200\" value=\"1\"></progress>";
  addTenPercent();
}

function addTenPercent() {

    var bar = document.getElementById("progressBar");
    setInterval(addTenPercent, 100);
    bar.value += 5;
};

$(document).ready(function(){

    var interval = 1, //How much to increase the progressbar per frame
        updatesPerSecond = 1000/60, //Set the nr of updates per second (fps)
        progress =  $('progress'),
        animator = function(){
            progress.val(progress.val()+interval);
            $('#val').text(progress.val());
            if ( progress.val()+interval < progress.attr('max')){
               setTimeout(animator, updatesPerSecond);
            } else {
                $('#val').text('Done');
                progress.val(progress.attr('max'));
            }
        }

});
setTimeout(animator, updatesPerSecond);


</script>
