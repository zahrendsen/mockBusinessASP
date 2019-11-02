<!--/**************************************************************************
SUMMARY OF CHANGES
Date				 Author				Comments
------------------- ------------------- ----------------------------------
11/1/19				Zach Ahrendsen		created db, added necessary asp code
                                        to link contact page to visitor table in db
                                        -- updated navigation within website. 
                                           have not linked other forms from other pages
                                            to db as of now. reamining php pages
                                            still need to be changed.

**************************************************************************/-->

<%@ Page Language="C#" %>
<%@ Import Namespace="System.Data.SqlClient" %>

<!DOCTYPE html>
<script runat="server">
    protected void submitButton_Click(object sender, EventArgs e)
    {
        if (Page.IsValid)
        {
            // Code that uses the data entered by the user
            // Define data objects
            SqlConnection conn;
            SqlCommand comm;
            // Read the connection string from Web.config
            string connectionString =
                ConfigurationManager.ConnectionStrings[
                "HopsDb"].ConnectionString;
            // Initialize connection
            conn = new SqlConnection(connectionString);
            // Create command
            comm = new SqlCommand("EXEC InsertVisitor @fnameTextBox, @lnameTextBox, @emailTextBox, @reasonDropDown, @commentsTextBox", conn);
            comm.Parameters.Add("@fnameTextBox", System.Data.SqlDbType.VarChar, 60);
            comm.Parameters["@fnameTextBox"].Value = fname.Text;
            comm.Parameters.Add("@lnameTextBox", System.Data.SqlDbType.VarChar, 60);
            comm.Parameters["@lnameTextBox"].Value = lname.Text;
            comm.Parameters.Add("@emailTextBox", System.Data.SqlDbType.VarChar, 250);
            comm.Parameters["@emailTextBox"].Value = email.Text;
            comm.Parameters.Add("@reasonDropDown", System.Data.SqlDbType.VarChar, 20);
            comm.Parameters["@reasonDropDown"].Value = reason.SelectedItem.Value;
            comm.Parameters.Add("@commentsTextBox", System.Data.SqlDbType.VarChar, 500);
            comm.Parameters["@commentsTextBox"].Value = comments.Text;

            // Enclose database code in Try-Catch-Finally
            try
            {
                // Open the connection
                conn.Open();
                // Execute the command
                comm.ExecuteNonQuery();
                // Reload page if the query executed successfully
                Response.Redirect("thankyou.html");
            }
            catch (SqlException ex)
            {
                // Display error message
                dbErrorMessage.Text =
                   "Error submitting the data!" + ex.Message.ToString();

            }
            finally
            {
                // Close the connection
                conn.Close();
            }
        }
    }

</script>

<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">
    <meta charset="utf-8">
    <title>Hops :: Contact Us</title>
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
                <h3>Contact Us</h3>
            </div>
        </div>
    </header>
    <form runat="server">
        <label for="fname">First Name*</label>
        <asp:TextBox id="fname" name="fname" placeholder="Your name.." runat="server" required="true" />
        <label for="lname">Last Name*</label>
        <asp:TextBox id="lname" name="lname" placeholder="Your last name.." runat="server" required="true" />
        <label for="email">Email*</label>
        <asp:TextBox id="email" name="email" placeholder="name@email.com" runat="server" required="true" />
        <label for="reason">Reason For Contact</label>
        <asp:DropDownList name="reason" id="reason" runat="server">
            <asp:ListItem value="reasonDefault" Text="Select a Reason.." selected="true" />
            <asp:ListItem value="Question" Text="Question" />
            <asp:ListItem value="Comment" Text="Comment" />
            <asp:ListItem value="Complaint" Text="Complaint" />
        </asp:DropDownList>
        <label for="comments">Comments</label>
        <asp:TextBox id="comments" name="comments" placeholder="..." rows="10" TextMode="multiline" runat="server" required="true" />
        <asp:Button ID="submitButton" runat="server"
                    Text="Submit" onclick="submitButton_Click" />
        <br />
        <asp:Label ID="dbErrorMessage" runat="server"></asp:Label>

    </form>

</body>

</html>