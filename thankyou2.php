<?php
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email');
$bday = filter_input(INPUT_POST, 'bday');
//echo $bday;
//    $employeeID = filter_input(INPUT_POST, 'employeeID');
/* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg;  */


// Validate inputs​

if ($firstname == null || $lastname == null || $email == null) {
    $error = "Invalid input data. Check all fields and try again.";
    /* include('error.php'); */
    echo "Form Data Error: " . $error;
    exit();
} else {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');



    try {
        include_once './database/db.php';
        $db = Database::getDB();
    } catch (Exception $ex) {
        echo 'connection error: ' . $e->getMessage();
        exit();
    }
    // Add the product to the database  ​

    $query = 'INSERT INTO signUp 
                        (firstname, lastname, email, bday)
                      VALUES 
                        (:firstname, :lastname, :email, :bday)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':bday', $bday);
    //            $statement->bindValue(':employeeID', $employeeID);
    $statement->execute();
    $statement->closeCursor();
    /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */
}
?>


<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>Hops :: Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/styles1.css">
    <link href="https://fonts.googleapis.com/css?family=Merienda|Passion+One" rel="stylesheet">
</head>

<body>

    <header>
        <div id="topnav">
        <nav>
                <ul>

                    <li><a href="index.html" id="home">Home</a></li>

                    <li><a href="signup.html">Sign Up</a></li>

                    <li><a href="contact.aspx">Contact</a></li>

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
                <h3>Thank You for signing up!</h3>
            </div>
        </div>
    </header>

</body>

</html>