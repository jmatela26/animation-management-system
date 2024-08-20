<?php
    session_start();
    $currentUser = $_SESSION['user'];
    $access = $_SESSION['access'];

    
    $userSize = strlen($currentUser);
    $rightMargin = '0';

    switch($userSize)
    {
      case '6': $rightMargin = '20px'; break;
      case '7': $rightMargin = '30px'; break;
      case '8': $rightMargin = '40px'; break;
      case '9': $rightMargin = '60px'; break;
      case '10': $rightMargin = '80px'; break;
      case '11': $rightMargin = '100px'; break;
      case '12': $rightMargin = '120px'; break;
      case '13': $rightMargin = '130px'; break;
      default: $rightMargin = '0';

    }



?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <!--<link rel="stylesheet"type="text/css" href="homepage.css">-->
        <link rel = "stylesheet" href = "animate.css">
        <style>


        /*body,html{
            height: 100%;
            margin: 0;
        }*/

        body{
        background-image:url(bghomepage.png);

        height:100%;
        background-position: center;
        background-size:cover;
        background-attachment:fixed;
        background-repeat:no-repeat;
    }

    img {
    opacity: 0.8;
    filter: alpha(opacity=70); /* For IE8 and earlier */
}

img:hover {
    opacity: 1.0;
    filter: alpha(opacity=100); /* For IE8 and earlier */

    }

    div1
    {
        margin-top: 1000px;
    }
    div2
    {
        margin: 100px;
        line-height: 100px;
    }
    div3{
      position: absolute;
      display:inline-block;
      top: 80px;
      right:<?php echo $rightMargin;?>;
      width: 200px;
      height: 100px;
      color: white;
      font-size: 40px;
    }
    div4{
      position: absolute;
      top: 120px;
      right: 0;
      width: 150px;
      height: 100px;
      color: white;
      font-size: 20px;
      font-style: italic;
    }
    div5
    {
      display: inline-block;
      position: absolute;
      top: 80px;
      right: 0;
      margin-right: 10px;
      width: 70px;
      height: 70px;
      color: white;
      background-color: darkblue;
    }
    div6
    {
      position: absolute;
      top: 80px;
      right: 0;
      margin-right: 10px;
      width: 70px;
      height: 70px;
      color: white;
      background-color: red;
    }


        </style>
    </head>
      <body>
<center><a href = "home.php"><img class="container rubberBand animated" src = "logo.png" ></a></center>
        <div2>
            <p></p>
        </div2>
        <div1>
            <table align="center" style = "margin-top:-100px">
                <form method="POST">
                  <div3 class="container fadeInLeft animated"><?php echo $currentUser;?></div3>
                  <div4 class="container fadeInRight animated">online</div4>
                  <?php if(strtoupper($access) == "ADMIN"){echo "<div5 class=\"container fadeInUp animated\"></div5>";}
                        else{echo "<div6 class=\"container fadeInUp animated\"></div6>";}?>
                    <colgroup></colgroup>
                    <?php displayLinks($access);?>


</form>
</table>
    </body>
</html>
<?php

  function displayLinks($access)
  {

    if(strtoupper($access) == "ADMIN")
    {
      echo "  <tr>
       <td class=\"container lightSpeedIn animated\">
                    <a href=\"layoutprojectreport.php\" alt=\"LPR\" ><image src=\"layoutprojectreporthover.png\" ></image></a>
                    <a href=\"manageusers.php\" alt=\"mUsers\" ><image src=\"manageuser.png\"></image></a></td>
                      </tr>
                      <tr>
                <td class=\"container lightSpeedIn animated\"><a href=\"generalproductionreport.php\" alt=\"GPR\" ><image src=\"generalproduct.png\"></image></a>
                  <a href=\"index.php\" alt=\"logout\" ><image src=\"lout.png\"></image></a></td>
                  </tr>";

    }
    else {
      echo "   <tr>
                <td class=\"container fadeInLeft animated\"><a href=\"mytask.php\" alt=\"LPR\" ><image src=\"mytask.png\"></image></a>
                    <a href=\"myassets.php\" alt=\"mUsers\" ><image src=\"assets.png\"></image></a></td>
                      </tr>
                      <tr align=\"center\">
                      <td class=\"container fadeInRight animated\">  <a href=\"index.php\" alt=\"logout\" ><image src=\"lout.png\"></image></a></td>
                      </tr>";

    }
  }
