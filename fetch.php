   <?php  
 //fetch.php  
   define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
 if(isset($_POST["book_id"]))  
 {  
      $query = "SELECT * FROM books WHERE id = '".$_POST["book_id"]."'";  
      $result = mysqli_query($db, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>