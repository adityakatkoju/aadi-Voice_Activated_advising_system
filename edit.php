<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($con, $_POST['id']);
	
	$name = mysqli_real_escape_string($con, $_POST['name']);
	// $age = mysqli_real_escape_string($mysqli, $_POST['age']);
	// $email = mysqli_real_escape_string($mysqli, $_POST['email']);	
	
	// checking empty fields
	if(empty($name) ) {	
			
		// if(empty($name)) {
		// 	echo "<font color='red'>Name field is empty.</font><br/>";
		// }
		
		// if(empty($age)) {
		// 	echo "<font color='red'>Age field is empty.</font><br/>";
		// }
		
		// if(empty($email)) {
		// 	echo "<font color='red'>Email field is empty.</font><br/>";
		// }		
	} else {	
		//updating the table
		$result = mysqli_query($con, "UPDATE courses SET name='$name' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT * FROM courses WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
