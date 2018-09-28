<!DOCTYPE html>
<html>
<head>
	<title>WorldSkills - Microservice Example</title>
	<style>
		header { background-color: #003764; padding: 50px; border-radius: 20px; }
		* { font-family: "Trebuchet MS"}
		p { font-style:italic; }
		#containerApp { padding:30px 20px; border: 3px solid #003764; margin:-15px 0; border-radius: 20px;}
		li { color:blue; }
	</style>
</head>
<body>
	<header>
		<img src="https://www.worldskills.org/application/themes/worldskills_org/img/logo/logo.svg" />
	</header>
	<div id="containerApp">
		<h1>WorldSkills Micro-service example</h1>
		<p>This is an example of layer separation in the software development environment, as you can see this face represents the Front-End side of the application.</p>
		<h2>Occupations List:</h2>
		<ul>
			<?php 

				$json = file_get_contents('http://occupation-service');

				$obj = json_decode($json);

				$occupations = $obj->occupation;

				foreach ($occupations as $occupation) {
					echo "<li>$occupation</li>";
				} 

			?>

		</ul>
	</div>
</body>
</html>