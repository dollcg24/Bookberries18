 <?php  
define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
 if(isset($_POST["insert"]))  
 {  
	  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));    	  
      $query = "INSERT INTO `imagetable`(`name`) VALUES($file)";  
      if(mysqli_query($db, $query))  
      {  
           echo "<script>alert('Image Inserted into Database')</script>";  
      }
      else
      {
		  die("unable to insert").mysqli_error();
	  }		  

 }	  
 ?> 