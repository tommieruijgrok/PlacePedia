<?php
    session_start();
    
  
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'true'){
        header('location: profile.php');
    } else {
        //header("location: profile.php");
    }
    include "include/head.php";
?>
<html  >

    <head>
        <title>Inloggen | PlacePedia</title>

        <link rel="stylesheet" href="stylesheet/PWS.css">
       
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>

    <body>
    <script src="script/PWS.js" defer></script>
    
    <div id="container" >
            
            <div id="login" class="animated-fast fade-up">
            
                <h2 class="animate__bounceInUp" >Inloggen op PlacePedia</h2>
                <form action="process/signupProcess.php" method="POST">
                    <input type="email" placeholder="Email" name="formEmail">
                   
                    <input class="password-input "  id="password-input"  maxlength="25" placeholder="Password" type="password" name="formPassword">
                    <div class="strength-meter" id="strength-meter"></div>
                    <input list="WP" style="max-height: 100px; overflow: scroll"  name="WP"  required/>
                    <datalist id="WP" ></datalist>

              
                  
                    <input type="submit">
                </form>
                <div style="display: block; margin: 0px auto; text-align: center">
                    <a style="font-size: 12px; font-weight: bold; color: unset; text-decoration: none" href="login.php">Inloggen op PlacePedia!</a>
                </div>
            </div>
            <div id="map" class="mapFullScreen"></div>
        </div>
       
    </body>


        
</html>


<?php
include "script/loginMap.php";