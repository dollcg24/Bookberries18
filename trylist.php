<?php  
   define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'roshan333');
   define('DB_DATABASE', 'ip_project');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
 $query = "SELECT * FROM `books` WHERE 1";  
 $result = mysqli_query($db, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>www.BookBerries.com</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
			<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Books List</h3>  
                <br />  
                <div class="table-responsive">  
                     <div align="right">  
                          <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Sell Your Book</button>  
                     </div>  
                     <br />  
                     <div id="book_table">  
                          <table class="table table-bordered">  
                               <tr>  
                                    <th width="40%">Book Name</th>
									<th width="15%">Edit</th>
									<th width="15%">View</th>
									<th width="15">Buy</th>
                                     
                               </tr>  
                               <?php  
                               while($row = mysqli_fetch_array($result))  
                               {  
                               ?>  
                               <tr>  
                                    <td><?php echo $row["bookname"]; ?></td>
                                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
                                    <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>  
                                    <td><a href="new_pm.php"><input type="button" name="buy" value="buy" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs buy_data" /></a></td>  
                               
							   </tr>
									
	
                               <?php  
                               }  
                               ?>
								<div class="foot"><a href="<?php echo $url_home; ?>">Go Home</a> - <a href="index.php">BookBerries</a></div><br><br>
                          </table>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Book Details</h4>  
                </div>  
                <div class="modal-body" id="book_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Update data</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Your username</label>  
                          <input type="text" name="user" id="user" class="form-control" />  
                          <br /> 
						  <label>Enter Book Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Author Name</label>  
                          <input type="text" name="author" id="author" class="form-control" />
                          <br />  
                          <label>Publication Year</label>  
                          <input type="text" name="year" id="year" class="form-control" />  
                          <br />  
                          <label>Enter Price</label>  
                          <input type="text" name="price" id="price" class="form-control" />  
                          <br />  
                            
                          <input type="hidden" name="book_id" id="book_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var book_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{book_id:book_id},  
                dataType:"json",  
                success:function(data){  
                     $('#user').val(data.user);  
					 $('#name').val(data.name);  
                     $('#author').val(data.author);  
                     $('#year').val(data.year);  
                     $('#price').val(data.price);  
                     $('#book_id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#user').val() == "")  
           {  
                alert("username is required");  
           }
			
		   if($('#name').val() == "")  
           {  
                alert("Name is required");  
           }
			
           else if($('#author').val() == '')  
           {  
                alert("Author is required");  
           }  
           else if($('#year').val() == '')  
           {  
                alert("year is required");  
           }  
           else if($('#price').val() == '')  
           {  
                alert("Price is required");  
           }  
           else  
           {  
                $.ajax({  
                     url:"insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#book_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var book_id = $(this).attr("id");  
           if(book_id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{book_id:book_id},  
                     success:function(data){  
                          $('#book_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  
 </script>
 