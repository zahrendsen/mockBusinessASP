<?php
/**********************************************
 * Date 9/6/2019   Name: Zach Ahrendsen       *
 * 9/12 created login page for admin view     *
 *********************************************/ 
$action = filter_input(INPUT_POST, 'action');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
include '/srv/disk17/3054436/www/mynameiszach.com/hops//database/db.php';





if ($action == NULL){
    echo $action;
} else if (empty($username) || empty($password)) {
    header ("Location: login.php");
}

else {
    header ("Location: adminChoice.php");
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
        <form name="adminLogin" method="post" action="login.php">
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="hidden" name= "action" id="action" value="action">
            <input type="submit" name="Submit" id="Submit" value="Submit">
        </form>

    </section>
    <script type='text/javascript'>alert("For demonstration purposes the username and password fields will take any input to proceed.");</script>
</body>

</html>