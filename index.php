<?php
session_start(); session_destroy(); session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <style>

        body{
        background-image:url(background.jpg);
        background-size:cover;
        background-attachment:fixed;
        background-repeat:no-repeat;
        }
        input.text{
        align-items: center;
        border:2px solid #66ccff;
        font-size: 20px;
        }
        input.password
        {
        align-items: center;
        border:2px solid #66ccff;
        font-size: 20px;
        }

        input.text:hover
        {border-color: #0077b3;}
        input.password:hover{border-color: #0077b3;}
        input.button
        {
          margin-top:10px;
          width: 100px;
          height:50px;
          border-color:#66ccff;
          background-color:#66ccff;
          color:black;
        }
        input.button:hover
        {
            border-color:#004466;
            background-color:#004466;
            color:white;
        }
        div1
        {
            margin-left:600px;
            margin-top: 1000px;

        }
        div2
        {
          margin:100px;
          line-height:100px;

        }
        form{
          margin:auto;
          z-index: 1;
          background: #FFFFFF;
          max-width: 360px;
          height: 200px;
          width: 200px;
          padding: 50px;
          padding-bottom:10px;
          padding-left:50px;
          padding-right:90px;

          text-align: center;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0

        }
        h2
        {
          margin-left:50px;
          font-style: italic;
          color:#004466;
        }
        span.josiah:hover
        {
          color:green;
        }
        span.cedric:hover
        {
          color:pink;
        }
        </style>
    </head>
<body>
  <center><img src = "logo2.png" style="margin-bottom:-160px"></center>

        <div2>
          <p></p>
        </div2>
       <form method="POST" >

        <div1>

        <table align="center">
          <h2 style="margin-top:-60px">AMS</h2>
            <tr>
                <td><input type="text" name="txt_username" value="" placeholder="Username" class="text"/>
            </tr>
            <tr>
                <td><input type="password" name="txt_password" value="" placeholder="Password" class="password"/>
            </tr>
            <tr>
                <td><input type="submit" name="btn_login" value="Login" class="button"/></td>
          </tr>
              <tr>
                <td style="color:grey"><center><h3>Powered by <span class="josiah">JG</span><span class="cedric">CJ</span>
                  TM</h3></center></td>
                </tr>
        </table><br>


     </div1>
        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $port = 3306;
            $database = "AMS_DB";


            if(isset($_POST['btn_login']))
            {
                $username = $_POST['txt_username'];
                $password = $_POST['txt_password'];

                if(!empty($username))
                {
                    if(!empty($password))
                    {
                        checkLogin($host, $port, $user, $pass, $database, $username, $password);
                    }
                    else
                    { echo "<script>alert('Please fill in your password');</script>";}
                }
                else {echo "<script>alert('Please fill in your username');</script>";}

            }



        ?>
        </form>
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


function checkLogin($host,$port,$user,$pass,$database,$username,$password)
{

    $access = null;
    $sql = "SELECT * FROM AMS_USERS WHERE USERNAME = '$username' AND PASSWORD = '$password'";

    $conn = sqlConnection($host, $port, $user, $pass, $database);
    $result = $conn->query($sql);
         if ($result->num_rows > 0)
             {
               while($row = $result->fetch_assoc())
                {
                  $access = $row['USER_PRIVILAGE'];
               }
                $conn->close();
                $_SESSION['user'] = $username;
                $_SESSION['access'] = $access;

                if(strtoupper($access) != 'CHECKER')
                {
                  echo "<script>alert('Login successful');</script>";
                  echo '<meta http-equiv="refresh" content="0; URL=home.php" />';
                }
                else {
                  echo "<script>alert('Login successful');</script>";
                  echo '<meta http-equiv="refresh" content="0; URL=episode.php" />';
                }

             }
       else
             {
                echo "<script>alert('Incorrect username or password');</script>";
             }

             for($x = 0; $x < sizeof($id);$x++)
                             {

                                 echo "<tr>";
                                 echo "<td>".getName($id[$x], $host, $user, $pass, $database, $port)."</td>";

                               $tempDay = 0;
                               $a = 0;
                               for($j = 0; $j < sizeof($monthArray);$j++)
                               {

                                 for($i = $tempDay; $i < $daysInAMonth[$j]; $i++)
                                 {

                                    if(sortPresentDays($host, $user, $pass, $database, $port, $barangay, $emp_id[$x], $dateRange[$a], $monthArray[$j], $j))
                                      {
                                        $dayArray[$i] = "&#10004;";
                                        $totalPresentDays++;

                                        echo "<td style=\"background-color:green;\" "
                                        . "align='center'></td>";

                                      }
                                      else
                                      {
                                          $dayArray[$i] = "&nbsp&nbsp&nbsp ";
                                          echo "<td align='center'>".$dayArray[$i]."</td>";
                                      }


                                     $a++;

                                 }
                               echo "<td style='border:0px'>&nbsp</td>";


                               }

            }
}


/*<input type="text" name="txt_username" value="" placeholder="Username" class="text"/><br>
      <center> <input type="password" name="txt_password" value="" placeholder="Password" class="password"/></center>*/
