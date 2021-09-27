<html>
<head>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
<div class="container">

    <div class="form">
    <form action="map.php"  method="get">

         <datalist id="form"  type="text" placeholder="Town-name" name="stad"></datalist>
        <input id="submit" type="submit" value="search">
    </form>

    </div>


    <?php

        echo " <div class='head'><h1>Placespedia</h1>";
        echo "<p>Many places more towns.</div>";
    ?>



    <div class="inlog">
       <a id="inlog" href="inlog.php">inlog</a>
    </div>
</div>
    <div class="map">
        <img src="img/map.png" width=700px;>
    </div>


</body>
</html>

