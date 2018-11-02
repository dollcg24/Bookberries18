<?php
include('config1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Sign up</title>
		<style>
body {font-family: Arial, Helvetica, sans-serif;
	bckground-image=url("https://image.shutterstock.com/image-photo/empty-wooden-table-top-blur-260nw-630334283.jpg");
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
    </head>
    <body>
    	
<?php
//We check if the form has been sent
if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
{
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['avatar'] = stripslashes($_POST['avatar']);
	}
	//We check if the two passwords are identical
	if($_POST['password']==$_POST['passverif'])
	{
		//We check if the password has 6 or more characters
		if(strlen($_POST['password'])>=6)
		{
			//We check if the email form is valid
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				//We protect the variables
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$email = mysql_real_escape_string($_POST['email']);
				$avatar = mysql_real_escape_string($_POST['avatar']);
				//We check if there is no other user using the same username
				$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				if($dn==0)
				{
					//We count the number of users to give an ID to this one
					$dn2 = mysql_num_rows(mysql_query('select id from users'));
					$id = $dn2+1;
					//We save the informations to the databse
					if(mysql_query('insert into users(id, username, password, email, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
					{
						//We dont display the form
						$form = false;
?>
<div class="message">You have successfuly been signed up. You can log in.<br />
<a href="connexion.php">Log in</a></div>
<?php
					}
					else
					{
						//Otherwise, we say that an error occured
						$form = true;
						$message = 'An error occurred while signing up.';
					}
				}
				else
				{
					//Otherwise, we say the username is not available
					$form = true;
					$message = 'The username you want to use is not available, please choose another one.';
				}
			}
			else
			{
				//Otherwise, we say the email is not valid
				$form = true;
				$message = 'The email you entered is not valid.';
			}
		}
		else
		{
			//Otherwise, we say the password is too short
			$form = true;
			$message = 'Your password must contain at least 6 characters.';
		}
	}
	else
	{
		//Otherwise, we say the passwords are not identical
		$form = true;
		$message = 'The passwords you entered are not identical.';
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
    <form action="sign_up.php" style="border:1px solid #ccc" method="post">
        Please fill the following form to sign up:<br />
		<br><br>
        <div class="container">
            <label for="username">Username</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
			<input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="password">Password<span class="small">(6 characters min.)</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
			<input type="password" name="password" /><br />
            <label for="passverif">Password<span class="small">(verification)</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
			<input type="password" name="passverif" /><br />
            <label for="email">Email</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;
			<input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="avatar">Avatar<span class="small">(optional)</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;
			<input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <br><br>
			<input type="submit" value="Sign up" />
		</div>
    </form>
</div>
<?php
}
?>
		<div class="foot"><a href="<?php echo $url_home; ?>">Go Home</a> - <a href="index.php">BookBerries</a></div>
	</body>
</html>