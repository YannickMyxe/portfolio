<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;
	$age = isset($_GET['age']) ? $_GET['age'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for contacting me</title>    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display&family=Roboto&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="/style/nav.css">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/contact.css">
</head>
<body>
<header>
        <div class="navcontainer">
            <div class="logo">
                <img src="https://via.placeholder.com/120x50" alt="logo">
                <a href="./">Home page</a>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/projects">Projects</a></li>
                    <li><a href="/cv">CV</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/contact" class="current-page">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
	<main>
	<div class="thank-you-message">
		
	<?php
		// Name sent in
		if ($name) {
			echo '<h1>Thank you</h1>';
			echo '<p>Thank you ' . htmlentities($name). ', I will contact you back as soon as possible!</p><p>In the mean time go back to the home page or click on the navbar to browse my portfolio.</p>';
			}
			// Age sent in
			else if ($age) {
				echo '<p>Thank you, ' . htmlentities($age). ' year old stranger</p>';
			}
			// Nothing sent in
			else {
				echo '<p>Thank you, stranger</p>';
			}
			echo '<a class="button" href="/">Return to Home page</a>';
			?>
	</div>
</main>
</body>
</html>
