<?php
session_start();

if(!isset($_SESSION['access_token'])){
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title>My profile</title>
</head>
<body>
<p><?php var_dump($_SESSION['userData']); ?> </p>	
<div class="container" style="margin-top: 100px">
	<div class="row justify-content-center">
		<div class="col-md-3">
			<img src="<?php echo $_SESSION['userData']['picture']['url'] ?>">
		</div>

		<div class="col-md-9">
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td>ID</td>
						<td><?php echo $_SESSION['userData']['id'] ?></td>
					</tr>
					<tr>
						<td>First Name</td>
						<td><?php echo $_SESSION['userData']['first_name'] ?></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><?php echo $_SESSION['userData']['last_name'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['userData']['email'] ?></td>
					</tr>
					<tr>
						<td>Facebook link</td>
						<td><?php echo $_SESSION['userData']['link'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<?php
				$arr = $_SESSION['userData']['feed'];
				$a = json_decode($arr,true);
				print_r($a->message);
				print_r($arr);
				//print_r($a);
				//print_r( $a['feed']);
				//echo $_SESSION['userData']['feed'];
				//echo "$a";
				foreach($arr as $result)
				{
				
					echo "<li>\n", $result['message'], "</li>";
					echo "<li>\n", $result['data']['link'],"</li><br>";

				}
			?>
		</div>
</div>
<script>console.log($_SESSION['userData']['feed'])</script>
</body>
</html>
