<?php

/**********************************************
 * Date 9/6/2019   Name: Zach Ahrendsen       *
 * Admin contact page to read input from      *
 * contact form.                              *    
 * Program successfully returned db info and  *
 * properly deletes as of 9/6                 *
 * 9/13 added delete logic to db.php as a     *
 * class/function. changed logic here to      *
 * match. delete still functions correctly 
 * 9/13 attempted to program editable employee
 * ID by drop down options. I was able to 
 * link the employeeDB to show available 
 * employee numbers but I can not get number
 * to save correctly. Tested I am changing 
 * the database correctly through function
 * but logic for array is incorrect.          *
 *********************************************/
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
include './database/db.php';

$employees = EmployeeDB::getEmployees();




try {
    $db = Database::getDB();
} catch (Exception $ex) {
    echo 'Database username/password or directory error!';
    exit();
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = 'list_visitor';
}

if ($action == 'list_visitor') {
    $query = 'SELECT * FROM visitor
  ORDER BY firstname';
    $statement = $db->prepare($query);
    $statement->execute();
    $visitors = $statement->fetchAll();
    $statement->closeCursor();
} else if ($action == 'delete_visitor') {
    VisitorContact::deleteVisitor();
} else if ($action == 'change_employee') {
    VisitorContact::changeVisitorEmployee();
}

?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>Hops :: Contact Us (ADMIN)</title>
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
            <caption>Visitor Contact Report</caption>
            <thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>E-Mail</td>
                    <td>Reason</td>
                    <td>Comments</td>
                    <td>Employee ID</td>
                    <td>Change Assigned Emp.</td>
                    <td>Save Edit</td>
                    <td>Delete Row</td>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($visitors as $visitor) { ?>


                    <tr>
                        <td><?php echo $visitor['firstName']; ?></td>
                        <td><?php echo $visitor['lastName']; ?></td>
                        <td><?php echo $visitor['email']; ?></td>
                        <td><?php echo $visitor['reason']; ?></td>
                        <td><?php echo $visitor['comments']; ?></td>
                        <td><?php echo $visitor['employeeID']; ?></td>
                        <td>
                            <form name="editform" action="adminContact.php" method="post">
                                <select name="newEmployeeID">
                                    <?php foreach ($employees as $employee) {  ?>
                                        <?php $newEmployee = $employee->getID(); ?>
                                        <option value="<?php echo $newEmployee; ?>">
                                            <?php echo $newEmployee; ?>
                                        </option>
                                    <?php }; ?>
                                </select>
                        </td>
                        <td>

                            <input type="hidden" name="action" value="change_employee">
                            <input type="hidden" name="visitorID" value="<?php echo $visitor['visitorID']; ?>" />
                            <input type="hidden" name="employeeID" value=" <?php echo $newEmployee; ?>" />
                            <input type="submit" value="Save" />
                            </form>
                        </td>
                        <td>
                            <form action="adminContact.php" method="post">
                                <input type="hidden" name="action" value="delete_visitor">
                                <input type="hidden" name="visitorID" value="<?php echo $visitor['visitorID']; ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>

                    </tr>
                <?php }; ?>

            </tbody>

        </table>


    </section>




</body>

</html>