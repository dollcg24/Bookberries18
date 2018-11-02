<?php
include('config1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <style>
body {font-family: Arial, Helvetica, sans-serif;
	bckgroung-image=url("https://image.shutterstock.com/image-photo/empty-wooden-table-top-blur-260nw-630334283.jpg");
}
* {box-sizing: border-box
   }

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
    width: auto;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
    
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus{
    background-color: #ddd;
    outline: none;
}

.imgcontainer {
    text-align: center;
    margin: 0px 50px 0px 0px;
}

img.avatar {
    width: 10%;
    border-radius:100%;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color:blue;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: auto;
    opacity: 0.9;
    
    
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color:red;
    
    
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  text-align: center;
  width: auto;
  
}

/* Add padding to container elements */
.container {
    padding: 16px;
    text-align: center;
}


/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
    
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: auto;
      
    }
}
</style>
		<title>www.BookBerries.com</title>
    </head>
    <body>
    	
<?php
//If the user is logged, we log him out
if(isset($_SESSION['username']))
{
	//We log him out by deleting the username and userid sessions
	unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">You have successfuly been loged out.<br />
<a href="<?php echo $url_home; ?>">Home</a></div>
<?php
}
else
{
	$ousername = '';
	//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
		}
		//We get the password of the user
		$req = mysql_query('select password,id from users where username="'.$username.'"');
		$dn = mysql_fetch_array($req);
		//We compare the submited password and the real one, and we check if the user exists
		if($dn['password']==$password and mysql_num_rows($req)>0)
		{
			//If the password is good, we dont show the form
			$form = false;
			//We save the user name in the session username and the user Id in the session userid
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
?>
<div class="message">You have successfuly been logged. You can access to your account.<br />
<a href="trylist.php">View Books</a></div>
<?php
		}
		else
		{
			//Otherwise, we say the password is incorrect.
			$form = true;
			$message = 'The username or password is incorrect.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//We display a message if necessary
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//We display the form
?>
<div class="content">
    <form action="connexion.php" method="post">
        Please type your IDs to log in:<br />
        <div class="container">
            <label for="username">Username</label>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <label for="password">Password</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="password" name="password" id="password" /><br />
            <input type="submit" value="Log in" />
		</div>
    </form>
</div>
<?php
	}
}
?>
		<div class="foot"><a href="<?php echo $url_home; ?>">Go Home</a> - <a href="index.php">BookBerries</a></div>
	</body>
</html>