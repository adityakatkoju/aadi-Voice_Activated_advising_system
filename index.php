<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
	<link href='style.css' rel='stylesheet' type='text/css'>
		<script src="jquery-3.2.1.js"></script>
		<script type='text/javascript'>
		var recognition = new webkitSpeechRecognition();

		recognition.onresult = function(event) { 
			console.log('result');
		  	var saidText = "";
		  	for (var i = event.resultIndex; i < event.results.length; i++) {
		        if (event.results[i].isFinal) {
		            saidText = event.results[i][0].transcript;
		        } else {
		            saidText += event.results[i][0].transcript;
		        }
		    }
		 	
		    document.getElementById('speechText').value = saidText;
		   	
		   	// Search Posts
		   	searchPosts(saidText);
		}

		function startRecording(){
			recognition.start();
		}

		// Search Posts
		function searchPosts(saidText){

			$.ajax({
				url: 'getData.php',
				type: 'post',
				data: {speechText: saidText},
				success: function(response){
					$('.container').empty();
					$('.container').append(response);
				}
			});
		}

		</script>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
	<div class='search_container'>
			<!-- Search box-->
			<input type='text' id='speechText' > &nbsp; <input type='button' id='start' value='Start' onclick='startRecording();'>
		</div>

		<!-- Search Result -->
		<div class="container"></div>
    <p>
        <!-- <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a> -->
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>