<?php
function pdo_connect_mysql() {
    // AJOUTER LE CODE DE CONNECTION ICI
    try {
      $conn = new PDO("mysql:host=localhost;dbname=bibliothèque", "root", "");
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      return $conn;

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      return false;
    }
}

/**
 * function permettant de printer la template de header
 */
function template_header($title) {
  echo <<<EOT
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>$title</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
      <nav class="navtop">
        <div>
          <h1>Bibliothèque</h1>    
          <a href="adherent.php"><i class="fas fa-address-book"></i>Adherent</a>
          <a href="book.php"><i class="fas fa-book"></i></i>Catalogue</a>
          <a href="emprunt.php"><i class="fas fa-calendar-check"></i></i>Emprunt</a>
          <a href="rayon.php"><i class="fas fa-folder-plus"></i></i>Rayon</a>
          <a href="index.php"><i class="fas fa-home"></i>Retour</a>
          <a href="login.php"><i class="fas fa-sign-in-alt"></i>login</a>
          <a href="register.php"><i class="fas fa-user-check"></i></i>register</a>

        </div>
      </nav>
  EOT;
}


/**
 * function permettant de printer la template de footer
 */
function template_footer() {
  $year = date("Y");
  echo <<<EOT
        <footer>
          <p>©$year bibliothèque.nc</p>
        </footer>
      </body>
  </html>
  EOT;
}
?>