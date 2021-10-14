<?php

// Constanten (connectie-instellingen databank)
define ('DB_HOST', 'localhost');
define ('DB_USER', 'yannick.vankerckvoor');
define ('DB_PASS', 'udb7K@22');
define ('DB_NAME', 'portfolio_yannick');


date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display&family=Roboto&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="/style/nav.css">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/contact.css">
    <title>My messages</title>
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
        <h1>My messages</h1>
        <?php if (sizeof($items) > 0) { ?>
        <ul class="messagelist">
            <?php foreach ($items as $item) { ?>
            <li><?php echo htmlentities($item['sender']); ?><?php echo ' ['.htmlentities($item['email']).'] ';?>: <?php echo htmlentities($item['message']); ?> (<?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?>)</li>
            <?php } ?>
        </ul>
        <?php
        } else {
            echo '<p>No messages recieved.</p>' . PHP_EOL;
        }
        ?>
    </main>
    <footer>
        <p>Footer (c) 2021 Yannick Van kercvkoorde - socials - copyright - address</p>
    </footer>
</body>