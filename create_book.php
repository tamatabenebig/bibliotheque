<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
    $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';
    $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
    $idRayon = isset($_POST['idRayon']) ? $_POST['idRayon'] : '';
    // Insert new record into the adherent table
    $stmt = $pdo->prepare('INSERT INTO livre VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $titre, $auteur, $disponible, $cardNumber, $idRayon]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
<div class="content update">
	<h2>Create Contact</h2>
    <form action="create_book.php" method="post">
            <label for="id">id</label>
            <input type="text" name="id" id="id">
            <label for="titre">titre</label>
            <input type="text" name="titre" id="titre">
            <label for="auteur">auteur</label>
            <input type="text" name="auteur" id="auteur">
			<label for="disponible">disponible</label>
            <input type="number" name="disponible" id="disponible">
            <label for="cardNumber">cardNumber</label>
            <input type="number" name="cardNumber" id="cardNumber">	
            <label for="idRayon">Rayon</label>
            <input type="number" name="idRayon" id="idRayon">		
            <input type="submit"/></p>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>