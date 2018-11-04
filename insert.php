<?php  
   define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $user = mysqli_real_escape_string($db, $_POST["user"]);
	  $name = mysqli_real_escape_string($db, $_POST["name"]);  
      $author = mysqli_real_escape_string($db, $_POST["author"]);  
      $year = mysqli_real_escape_string($db, $_POST["year"]);  
      $price = mysqli_real_escape_string($db, $_POST["price"]);  
      $id=mysqli_real_escape_string($db, $_POST["book_id"]);
	  if($_POST["book_id"] != '')  
      {  
           $sql = $db->prepare('UPDATE books 
    SET username = ?, 
         bookname= ? , 
        author= ? , 
        publication_year = ?, 
        price = ?  
    WHERE id =?');
echo $db->error;
  $sql->bind_param("sssiii", 
        $user, 
        $name, 
        $author, 
        $year, 
        $price, 
        $id
        ); 
		
           $message = 'Data Updated';  
      }  
      else  
      {  
             $sql = $db->prepare("INSERT INTO `books`(`username`, `bookname`, `author`, `publication_year`, `price`)VALUES(?,?,?,?,?)");
			echo $db->error;
			$sql->bind_param("sssss",$user,$name, $author,$year,$price);
	       $message = 'Data Inserted';  
      }  
      if($sql->execute())  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM books ORDER BY id DESC";  
           $result = mysqli_query($db, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="55%">Book Name</th>
						  <th width="15%">Edit</th>
						  <th width="15%">View</th>
						  <th width="15">buy</th>
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["bookname"] . '</td>
						  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
						  <td><a href="new_pm.php"><input type="button" name="view" value="buy" id="' . $row["id"] . '" class="btn btn-info btn-xs buy_data" /></a></td>  
						  
					 </tr>  
                ';  
           }  
           $output .= '<div class="foot"><a href="<?php echo $url_home; ?>">Go Home</a> - <a href="index.php">BookBerries</a></div><br><br></table>';  
      }  
      echo $output;  
 }  
 ?>