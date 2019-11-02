<?php

/**********************************************
 * Date 9/11/2019   Name: Zach Ahrendsen      *
 * page created to retrieve employee list     *
 * from db.                                   *    
 *********************************************/
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
include './database/db.php';


try {
    $db = Database::getDB();
} catch (Exception $ex) {
    echo 'connection error: ' . $e->getMessage();
    exit();
}






    $query = 'SELECT * FROM signUp
                  ORDER BY email';
    $statement = $db->prepare($query);
    $statement->execute();
    $signups = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>Hops :: Sign UP List (ADMIN)</title>
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

        <table id="reportTable">
            <caption>Sign Up List Report</caption>
            <thead>
                <tr>
                    <td>Email</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Birthday</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($signups as $signup) :  ?>

                    <tr>
                        <td><?php echo $signup['email']; ?></td>
                        <td><?php echo $signup['firstName']; ?></td>
                        <td><?php echo $signup['lastName']; ?></td>
                        <td><?php echo $signup['bday']; ?></td>


                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </section>
</body>

</html>