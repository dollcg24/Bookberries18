<?php
include('config1.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="front.css">
	    <title>BookBerries</title>
		 
		
	</head>
    <body class="bgimg" 
	style="background-image: url('http://c6804845becd1fb9235e-f663ccb0e39b4b76d5e0eb5b6dc4141b.r35.cf1.rackcdn.com/G6MrUXU');
			
			background-color: #FFFFFF; 
			height: 100%;
			color:#FFFFFF;
			font-weight:bold;
		/* You must set a specified height */
			background-position: center; /* Center the image */
			background-repeat: no-repeat; /* Do not repeat the image */
			background-size:cover;
			background-image-opacity:0.5";>
        <div class="content">
<?php
//We display a welcome message, if the user is logged, we display it username
?>
<nav>
<div class="w3-top">
  <div class="w3-bar w3-font- w3-khaki w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>BB</b> BookBerries</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
	  
	  <a href="#about" class="w3-bar-item w3-button">About</a>
	  
	  
      <a href="connexion.php" class="w3-bar-item w3-button">Login</a>
      <a href="sign_up.php" class="w3-bar-item w3-button">Create account</a>
      
    </div>
  </div>
</div>
</nav>

<!-- Header -->
<link rel="stylesheet" type="text/css" href="front.css">
</link>
<div>

  <div align="center">
    <br><br>
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>BB</b></span> <span class="w3-hide-small w3-padding w3-black w3-opacity-min w3-text-white">BookBerries</span></h1>
    
  </div>
 </div>
<!-- Page content -->
<br><br>
<h3 align="center">Hello<?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?>,<br /></h3>
<h3 align="center">Welcome on our website.<br /></h3>

 <div class="w3-content w3-padding" style="max-width:1564px">
	<br>	
	
    <div class="w3-row-padding">
     <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Books</h3>
	  <?php
//If the user is logged, we display links to edit his infos, to see his pms and to log out
if(isset($_SESSION['username']))
{
//We count the number of new messages the user has
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
//The number of new messages is in the variable $nb_new_pm
$nb_new_pm = $nb_new_pm['nb_new_pm'];
//We display the links
?>
<div>
<div class="w3-col l4 m6 w3-margin-left"><button class="w3-button w3-light-grey w3-block"><a href="edit_infos.php"><h3>Edit my personnal informations</h3></a></button><br /></div>
<div class="w3-col l4 m6 w3-margin-left"><button class="w3-button w3-light-grey w3-block"><a href="list_pm.php"><h3>My personnal messages(<?php echo $nb_new_pm; ?> unread)</h3></a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="w3-col l4 m6 w3-margin-left"><button class="w3-button w3-light-grey w3-block"> <a href="trylist.php"><h3>View Books</h3></a></button></div>
<div class="w3-col l4 m6 w3-margin-left"><button class="w3-button w3-light-grey w3-block"><a href="buy.php"><h3>Got the book</h3></a></button></div>
<div class="w3-col l4 m6 w3-margin-left"><br /><button class="w3-button w3-light-grey w3-block"><a href="connexion.php"><h3>Logout</h3></a></button></div>
</div>

<?php
}
else
{
//Otherwise, we display a link to log in and to Sign up
?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <div class="w3-col l4 m6 w3-margin-bottom">
    <button class="w3-button w3-light-grey w3-block"><a href="connexion.php">View our books</a></button>
	</div>
  
<?php
}
?>
	
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
    <p><h3>We have introduced a website for second hand book buying and selling.As some books are really expensive so it is always better to buy second hand book.
	Our website will help you to buy as well as to sell your books.It is beneficial for buyer as he/she will get books at affordable rate.
	Also seller can sell their book at the price of their choice.So explore our website.<h3></p>
  </div>
   <!-- About Section -->	
 <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
    <p><h3>Lets get in touch.Contact us for any queries.Our email id is:</h3><h2> BookBerries@gmail.com </h2></p>        
  </div>
    </div>
	</div> 


		</div>
 </body>
</html>