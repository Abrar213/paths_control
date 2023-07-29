<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style10.css">
</head>
<body>
	<div>
					<form  action="#" method="POST">
							<label>Directions</label>
							<input type="text" name="Order of Directions" class="O" ><br>
							<label>Forwards :</label>
							<input type="text" name="Forwards" class = "F"><br>
							<label>Right    :</label>
							<input type="text" name="Right" class = "R"><br>
							<label>Left     :</label>
							<input type="text" name="Left" class = "L"><br>
							<div class = "mahrez">
								<input type="submit" name="save" value="save">
								<input type="reset" name="delete" value="reset">
							</div>
					</form>
		</div>
		<div class="wrapper">	
		<button class="buttonH">start</button>
		</div>
		<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Robot";
// check connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

if (isset($_POST['save'])) {
						$forwards = mysqli_real_escape_string($conn, $_POST['Forwards']);
						$right = mysqli_real_escape_string($conn, $_POST['Right']);
						$left = mysqli_real_escape_string($conn, $_POST['Left']);

				$sql = "INSERT INTO `paths` (`Forwards`, `Right`, `Left`) VALUES ('$forwards','$right', '$left')";
				if(mysqli_query($conn, $sql)){
							// success
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
									mysqli_close($conn);

	}



		
 ?>

		<canvas></canvas>

		<script>
			var canvas = document.querySelector('canvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var orderOfDirection = document.querySelector(".O")
var ForwardInput = document.querySelector(".F")
var RightInput = document.querySelector(".R")
var LeftInput = document.querySelector(".L")

var button = document.querySelector(".buttonH")

var Forwards = 0 *7;
var Right = 0 *7;
var Left = 0 *7;
var str = "";
ctx = canvas.getContext("2d");
orderOfDirection.addEventListener("input" , function(){
str = orderOfDirection.value;
})

ForwardInput.addEventListener("input" , function(){
Forwards = ForwardInput.value *7;
})

RightInput.addEventListener("input" , function(){
Right = RightInput.value*7;
})

LeftInput.addEventListener("input" , function(){
Left = LeftInput.value*7;
})






button.addEventListener("click" , function(){
	ctx.beginPath();


	ctx.clearRect(0, 0, 1500, 1500);

	canvas_arrow(ctx, 700, 300,700, 300-Forwards);
	ctx.stroke();
	endOf = [700, 300-Forwards , "F"];
	//-----------------------------------------

	if (str[1]=="R"){
	canvas_arrow(ctx, endOf[0], endOf[1], endOf[0]+Right, endOf[1]);
	endOf =[endOf[0]+Right, endOf[1] , "R"]
	ctx.stroke();
	}
	else if (str[1]=="L"){
	canvas_arrow(ctx, endOf[0], endOf[1], endOf[0]-Left, endOf[1]);
	endOf = [endOf[0]-Left, endOf[1] , "L"]
	ctx.stroke();

	}

	
	if (str[2]=="R"){
		if(endOf[2]=="R"){
			canvas_arrow(ctx, endOf[0], endOf[1], endOf[0], endOf[1] + Right);
			ctx.stroke();
			}
		else if(endOf[2]=="L"){
			canvas_arrow(ctx, endOf[0], endOf[1], endOf[0], endOf[1] - Right);
			ctx.stroke();
			}
	}
	else if (str[2]=="L"){
			if(endOf[2]=="R"){
				console.log("here ")
			canvas_arrow(ctx, endOf[0], endOf[1], endOf[0], endOf[1] - Left);
			ctx.stroke();
			}
		else if(endOf[2]=="L"){
			canvas_arrow(ctx, endOf[0], endOf[1], endOf[0], endOf[1] + Left);
			ctx.stroke();
			}
	}






})





function canvas_arrow(context, fromx, fromy, tox, toy) {
  var headlen = 10; // length of head in pixels
  var dx = tox - fromx;
  var dy = toy - fromy;
  var angle = Math.atan2(dy, dx);
  context.moveTo(fromx, fromy);
  context.lineTo(tox, toy);
  context.lineTo(tox - headlen * Math.cos(angle - Math.PI / 6), toy - headlen * Math.sin(angle - Math.PI / 6));
  context.moveTo(tox, toy);
  context.lineTo(tox - headlen * Math.cos(angle + Math.PI / 6), toy - headlen * Math.sin(angle + Math.PI / 6));
}

	</script>
</body>
</html>
