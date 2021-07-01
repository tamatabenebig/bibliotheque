<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
        $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';
        $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
        $idRayon = isset($_POST['idRayon']) ? $_POST['idRayon'] : '';
       
        // Update the record
        $stmt = $pdo->prepare('UPDATE livre SET id = ?, titre = ?, auteur = ?, disponible = ?, cardNumber = ?, idRayon = ?  WHERE id = ?');
        $stmt->execute([$id, $titre, $auteur, $disponible, $cardNumber, $idRayon, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the livre table
    $stmt = $pdo->prepare('SELECT * FROM livre WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$livre) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Livre<?=$livre['id']?></h2>
    <form action="update_book.php?id=<?=$livre['id']?>" method="post">
        <label for="id">ID</label>
        <label for="titre">titre</label>
        <input type="text" name="id" value="<?=$livre['id']?>" id="id">
        <input type="text" name="titre" value="<?=$livre['titre']?>" id="titre">
        <label for="auteur">auteur</label>
        <label for="disponible">disponible</label>
        <input type="text" name="auteur" value="<?=$livre['auteur']?>" id="auteur">
        <input type="number" name="disponible" value="<?=$livre['disponible']?>" id="disponible">
        <label for="cardNumber">cardNumber</label>
        <label for="idRayon">idRayon</label>
        <input type="number" name="cardNumber" value="<?=$livre['cardNumber']?>" id="cardNumber">
        <input type="number" name="idRayon" value="<?=$livre['idRayon']?>" id="idRayon">
       
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>