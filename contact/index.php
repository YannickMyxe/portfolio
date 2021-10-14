<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_yannick');

date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$findme = isset($_POST['radio-findme']) ? (string)$_POST['radio-findme'] : '';
$msgName = '';
$msgMessage = '';
$msgEmail = '';
$msgFindme = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Please fill in your name';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Please leave a message';
        $allOk = false;
    }

    if (trim($email) === '') {
        $msgEmail = 'Please enter your email adress so I can contact you back';
        $allOk = false;
    }

    if (trim($findme) === '') {
        $msgFindme = 'Please select one of the following options';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, email, message, findme, added_on) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $email, $message, $findme, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact me</title>    
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
        <div class="contact">
            <h1>Contact</h1>
            <p>You have a question or want to work together? ... get in contact!</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="name" id="name">Your name: </label>
                <input name="name" id="name" class="text" type="text" placeholder="Enter your name..." value="<?php echo htmlentities($name); ?>">
                <span class="message error"><?php echo $msgName; ?></span>

                <label for="email">Your e-mail: </label>
                <input name="email" id="email" class="text" type="email" placeholder="Enter your e-mail adress..." value="<?php echo htmlentities($email); ?>">
                <span class="message error"><?php echo $msgEmail; ?></span>

                <label for="message">Your message</label>
                <textarea name="message" id="message" class="text" placeholder="Enter your message here..."><?php echo htmlentities($message); ?></textarea>
                <span class="message error"><?php echo $msgMessage; ?></span>

                <label class="radiotitle">How did you find me?</label>
                <input type="radio" id="friends" name="radio-findme" value="friends" <?php if(isset($_POST['radio-findme']) && $_POST['radio-findme'] === 'friends'){echo 'checked';}?>>
                <label for="friends">Friends</label><br>
                <input type="radio" id="social" name="radio-findme" value="socialmedia" <?php if(isset($_POST['radio-findme']) && $_POST['radio-findme'] === 'socialmedia'){echo 'checked';}?>>
                <label for="social">Social Media</label><br>
                <input type="radio" id="google" name="radio-findme" value="google" <?php if(isset($_POST['radio-findme']) && $_POST['radio-findme'] === 'google'){echo 'checked';}?>>
                <label for="google">Google</label>
                <span class="message error"><?php echo $msgFindme; ?></span>
                <p>
                    <button type="submit" id="btnSubmit" name="btnSubmit">Send your message</button>
                </p>
            </form>
        </div>
    </main>
    <footer>
        <p>Footer (c) 2021 Yannick Van kercvkoorde - socials - copyright - address</p>
    </footer>
</body>
</html>

