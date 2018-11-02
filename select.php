<?php 
  define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   
 if(isset($_POST["book_id"]))  
 {  
      $output = '';  
	  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 
	  $query = "SELECT * FROM books WHERE id = '".$_POST["book_id"]."'";  
      $result = mysqli_query($db, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Book Name</label></td>  
                     <td width="70%">'.$row["bookname"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Author</label></td>  
                     <td width="70%">'.$row["author"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Publication year</label></td>  
                     <td width="70%">'.$row["publication_year"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Selling price</label></td>  
                     <td width="70%">'.$row["price"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Sellers username </label></td>  
                     <td width="70%">'.$row["username"].'</td>  
                </tr>
				 <tr>  
                     <td width="30%"><label>Book Id</label></td>  
                     <td width="70%">'.$row["id"].'</td>  
                </tr>
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>