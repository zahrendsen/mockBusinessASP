

<?php

/**********************************************
 * Date 9/13/2019   Name: Zach Ahrendsen       *
 * Created admin report choice page directed  *
 * by successful login                        *    
 *********************************************/ 

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');



 try {
    include_once './database/db.php';
    $db = Database::getDB();
 } catch (Exception $ex) {
     echo 'connection error: ' . $e->getMessage();
     exit();

 }
 ?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>Hops :: Login (ADMIN)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles1.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/report.css">
    <link href="https://fonts.googleapis.com/css?family=Merienda|Passion+One" rel="stylesheet">
</head>

<body>

    <header>
        <div id="topnav">
            <nav>
                <ul>

                    <li><a href="index.html" id="home">Home</a></li>

                    <li><a href="signup.html">Sign Up</a></li>

                    <li><a href="contact.html">Contact</a></li>

                    <li><a href="login.php">Admin</a></li>

                </ul>
            </nav>
        </div>
        <div id="logocomplete">
            <div id="companyname">
                <h1>Hops Footwear</h1>
            </div>
            <img id="logoimg" src="images/rabbit.png" alt="rabbit" />
            <div id="slogan">
                <h3>Welcome Admin!</h3>
            </div>
        </div>
    </header>
    <section id="report">
    <h3>Please choose the Report you would like to generate:</h3>
        <p>
            <br>
            <br>
            <a href="adminContact.php">Visitor Contact Report</a>
            <br>
            <br>
            <a href="adminListEmployees.php">Employee List Report</a>
            <br>
            <br>
            <a href="adminSignUpList.php">Sign Up List Report</a>
        </p>
    </section>
</body>

</html>