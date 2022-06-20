<?php
require 'functions.php';
$connection = dbConnect();

$naam = '';
$email = '';
$bericht = '';


//opslag variabele (array) voor errors
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //gegevens opslaan
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $bericht = $_POST['bericht'];
    $tijdstip = date('Y-m-d H:i:s');


    //fouten controleren / valideren van input
    if (isEmpty($naam)) {
        $errors['naam'] = 'Vul uw naam in aub.';
    }
    if (!isvalidEmail($email)) {
        $errors['email'] = 'Dit is geen geldig email adres.';
    }
    if (!hasMinLength($bericht, 5)) {
        $errors['bericht'] = 'vul minimaal 5 tekens in.';
    }

    //print_r($errors);

    if (count($errors) == 0) {
        $sql = "INSERT INTO `berichten` (`naam`, `email`, `bericht`, `tijdstip`) 
            VALUES (:naam, :email, :bericht, :tijdstip);";
        $statement = $connection->prepare($sql);
        $params = [
            'naam' => $naam,
            'email' => $email,
            'bericht' => $bericht,
            'tijdstip' => $tijdstip
        ];
        $statement->execute($params);
        
        //stuur bezoeker door naar bedankt pagina
        header('location: bedankt.html');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamepagina</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/slideshow.js" defer></script>
    <script src="js/reviews.js" defer></script>
</head>

<body>
    <header class="navigatiebar">
        <a href="index.php">
            <img src="img/LogoSWGames.webp" width="150" alt="Star Wars Games Logo">
            <nav>
                <ul class="links">
                    <li><a href="index.php">Games</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="inloggen.html">Inloggen</a></li>
                    <li><a href="zoeken.html">Zoeken</a></li>
                </ul>
            </nav>
    </header>

    <main>
        <section class="afbeelding">
            <div class="col-2">
                <img src="img/1087325.webp" alt="Darthvader afbeelding" class="image1">
                <img src="img/Contact.webp" alt="Logo van Battlefront 2" class="image2">
            </div>
        </section>

        <section class="contact">
            <ul class="contactlijst">
                <li class="contactlijstitem">
                    <img src="img/contactformulier.webp" alt="afbeelding van contactformulier">
                </li>
                <li class="block">
                    <form action="contact.php" method="POST" novalidate>
                        <div class="form__field">
                            <label for="naam">Naam</label>
                            <input type="text" value="<?php echo $naam;?>" id="naam" name="naam" placeholder="Vul uw naam in" required>

                            <?php if (!empty($errors['naam'])) : ?>
                                <p class="form-error"><?php echo $errors['naam'] ?></p>
                            <?php endif; ?>

                        </div>
                        <div class="form__field">
                            <label for="email">Email</label>
                            <input type="email" value="<?php echo $email;?>" id="email" name="email" placeholder="Vul uw emailadres in" required>

                            <?php if (!empty($errors['email'])):?>
                                <p class="form-error"><?php echo $errors['email']?></p>
                            <?php endif;?>
                        </div>
                        <div class="form__field">
                            <label for="bericht">Bericht</label>
                            <textarea name="bericht" id="bericht" placeholder="Vul uw vraag of opmerking in" required><?php echo $bericht; ?></textarea>

                            <?php if (!empty($errors['bericht'])):?>
                                <p class="form-error"><?php echo $errors['bericht']?></p>
                            <?php endif;?>
                        </div>

                        <button type="submit" class="form__button">opsturen</button>
                    </form>
                </li>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer__section">
                <h3>Locatie</h3>
                <ul>
                    <li>Contactweg 36</li>
                    <li>1014 AN Amsterdam</li>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9739.458184559553!2d4.8560905!3d52.3910058!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5dffd675d740eddb!2sMediacollege%20Amsterdam!5e0!3m2!1snl!2snl!4v1652688761811!5m2!1snl!2snl" width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </ul>
            </div>
            <div class="footer__section">
                <h3>Navigatie</h3>
                <ul>
                    <li><a href="index.php">Homepage</a></li>
                    <li><a href="index.php">Games</a></li>
                    <li><a href="inloggen.html">Inloggen</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer__section">
                <h3>Algemeen</h3>
                <ul>
                    <li>
                        <a href="">Algemene voorwaarden</a>
                    </li>
                    <li>
                        <a href="">Privacybeleid</a>
                    </li>
                    <li>
                        <a href="">Cookiebeleid</a>
                    </li>
                    <li>
                        <a href="">Herroepingsrecht</a>
                    </li>
                </ul>
            </div>
            <div class="footer__section">
                <h3>Contact formulier</h3>
                <form class="footer__form">
                    <div>
                        <label for="naam">Naam</label>
                        <input id="naam" type="text">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email">
                    </div>
                    <div>
                        <label for="vraag">vraag / opmerking</label>
                        <textarea id="vraag" class="bigText"></textarea>
                    </div>
                    <input class="submit" type="submit" value="Verzenden">
                </form>
            </div>
        </div>
    </footer>
</body>

</html>