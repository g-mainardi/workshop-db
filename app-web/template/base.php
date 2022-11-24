<!DOCTYPE html>
<html lang="it">
	<head>
	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
		</script>
		<title><?php echo $SetParameters["titolo"]?></title>
	</head>
	<body>
		<header>
			<ul>
				<li>
					<h1><a href="index.php">DB - Garage</a></h1>
				</li>
				<li>
					<img src="./upload/mechanic_logo.png" alt="logo" />
				</li>
			</ul>
		</header>
		
		<main>
		<?php
		if(isset($SetParameters["file"])){
                require($SetParameters["file"]);
            }
        ?>
		</main>
		<footer>
			<ul>
				<li>
					<ul id="contacts">
						<li>
							<p>info@dbgarage.it</p>
							<p>348-1300234</p>
						</li>
						<li>
							<address>Via Cesare Pavese 50, 47521 Cesena(FC)</address>
						</li>
					</ul>
				</li>
			</ul>
		</footer>
	</body>
</html>