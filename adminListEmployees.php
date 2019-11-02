

<?php

/**********************************************
 * Date 9/11/2019   Name: Zach Ahrendsen      *
 * page created to retrieve employee list     *
 * from db.                                   *    
 *********************************************/ 
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
include './database/db.php';

// class Database {
//     private static  $dsn = 'mysql:host=localhost;dbname=hopsdb';
//     private static $username = 'root';
//     private static $password = 'Pa$$w0rd';
//     private static $db;

//     private function __construct() {}

//     public static function getDB () {
//         if (!isset(self::$db)) {
//             try {
//                 self::$db = new PDO(self::$dsn,
//                                      self::$username,
//                                      self::$password);
//             } catch (PDOException $e) {
//                 $error_message = $e->getMessage();
//                 include('../errors/database_error.php');
//                 exit();
//             }
//         }
//         return self::$db;
//     }
// }




$employees = EmployeeDB::getEmployees();
?>

<!DOCTYPE html>
<html>


    <head>
        <meta charset="utf-8">
        <title>Hops :: List Employees (ADMIN)</title>
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
                    <caption>Employee List Report</caption>
                    <thead>
                    <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>EmployeeID</td>
                </tr>
                    </thead>
                    <tbody>
                    <?php foreach($employees as $employee) :  ?>
                    
                        <tr>
                    <td><?php echo $employee->getFirstName();?></td>
                    <td><?php echo $employee->getLastName();?></td>
                    <td><?php echo $employee->getID();?></td>
            
                </tr>
                <?php endforeach; ?>   
                    </tbody>
           
                </table>
        </section>
    </body>

</html>