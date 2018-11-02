<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>New PM</title>
    </head>
	<body class="img" style="background-image: url('https://img.freepik.com/free-photo/abstract-blur-and-defocused-library-and-book-store-shop-interior_1203-9330.jpg?size=338&ext=jpg');
			
			background-color: #FFFFFF; 
			height: 100%;
			font-weight:bold;
			color:#000000;
		/* You must set a specified height */
			background-position: center; /* Center the image */
			background-repeat: no-repeat; /* Do not repeat the image */
			background-size:cover;
			background-image-opacity:0.5";>
			<div align="center">
			<div class="content">
	<form action="buy.php" style="border:1px solid #ccc" method="POST">
	<label>Enter Boook Id:</label>
	<input type="text" id="user" name="user">
	<br>
	<br><br><br>
	<input type="submit" value="Got_Book">
	</form>
	<div class="foot"><a href="list_pm.php"><h3 color="#FFFFFF">Go to my personnal messages</h3></a> - <a href="index.php"><h3 color="#FFFFFF">BookBerries</h3></a></div>
	</div>
	</div>
	</body>
</html>
<?php
 define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   session_start();
   error_reporting(E_ALL);
ini_set('display_errors', 1);
  
  if(isset($_POST['user']))
  {
	  $user = mysqli_real_escape_string($db,$_POST['user']);
	  //$book = mysqli_real_escape_string($db,$_POST['book']);
	
	
		 if(mysqli_query($db,"DELETE FROM books WHERE id=$user"))
		 {
			 $db->error;
			 echo "<script>if(confirm('BOOK list updated')){document.location.href='trylist.php'};</script>";
			// echo "<script>alert('book sold');window.loaction.href='books_list.php';</script>";
		 }
         else
		 {
			 echo $db->error;
			 echo "<script>alert('Unable to update list');</script>";
		 }
 
 }
   		
  
   
  ?>