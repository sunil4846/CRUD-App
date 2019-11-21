<?php include 'db.php'; 

$page = (isset($_GET['page']) ? (int)$_GET['page'] :1); //pagination 
$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <= 50 ? (int)$_GET['per-page']:5);  //logic of pagination, 5 data will be printed perpage
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql ="select * from tasks limit ".$start.",".$perPage." ";

$total = $db->query("select * from tasks")->num_rows; //display the number of rows i.e 10 or something

$pages = ceil($total/$perPage); //print total number of pages

$rows = $db->query($sql);
?>

<!DOCTYPE html>

<html>
<head>

	<title>CRUD Application</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<center><h1>ToDo List </h1></center>	
		<div class="row" style="margin-top: 70px;">
			<div class="col-md-10 col-md-offset-1" > <!-- md means mediumsize of column-->
				<button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success" >Add task</button><!--data-toggle:-(1)means it is used to aim API javascript of bootstrap (2)It tells bootstrap what to do-->
					<!--data-target:-(1)uses their premade javascript components (2)its tells bootstrap which elements is going to open-->
				<button type="button" class="btn btn-default pull-right"  onclick="print()">Print</button><!--print option -->
					<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					    	<div class="modal-header">
					        	<button type="button" class="close" data-dismiss="modal">&times;</button>
					        	<h4 class="modal-title">Add task</h4>
					      	</div>
					      	<div class="modal-body">
					        	<form method="post" action="add.php">
					        		<div class="form-group">
					        			<label>Task Name:</label>
					        			<input type="text" required name="task" class="form-control">
					        		</div>
					        		<input type="submit" name="send" value="Add task" class="btn btn-success">
					        	</form>
					      	</div>
					      	<div class="modal-footer">
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      	</div>
					    </div>

					</div>
				</div>
				<div class="col-md-12 text-center">
					<p>Search</p>
					<form action="search" method="post" class="form-group">
						<input type="text" placeholder="search" name="search" class="form-control">
					</form>
				</div>
				<hr><br>
				<table class="table table-hover"  >
					<thead>
					    <tr>
					    	<th scope="col">id</th>
					    	<th scope="col">Task</th>
					    </tr>
					</thead>
					<tbody>
				    
				    	
					    <?php while($row = $rows->fetch_assoc()):?>
					    	<tr>
					    		<th ><?php echo $row['id']; ?></th>
					        	<td class="col-md-10"><?php echo $row['name'] ;?></td>
					        	<td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
					        	<td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td> 
		        			</tr>
					    <?php endwhile; ?>
					    	
					   	
					</tbody>
				</table>
				<center>
					<ul class="pagination">
						<?php for ($i=1; $i <= $pages ; $i++): ?>
						<li><a href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage;?>"><?php echo $i; ?></a></li>
						<?php endfor; ?>
					</ul>
				</center>
			</div>
		</div>
	</div>
</body>
</html>