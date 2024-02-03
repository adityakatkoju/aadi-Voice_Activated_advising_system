<html>
<head>
	<title>Add Data</title>
	<!-- course name <input name = "cname" type="text"> -->
	
</head>

<body>

<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="cname"></td>
			</tr>
			
			<tr> 
				
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>


<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = mysqli_real_escape_string($con, $_POST['cname']);
	
		
	// checking empty fields
	if(empty($name) ) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($con, "INSERT INTO courses(name) VALUES('$name')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
