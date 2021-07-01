<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $reference = isset($_POST['reference']) ? $_POST['reference'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE rayon SET id = ?, nom = ?, reference = ?  WHERE id = ?');
        $stmt->execute([$id, $nom, $reference, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the rayon table
    $stmt = $pdo->prepare('SELECT * FROM rayon WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $rayon = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$rayon) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update rayon<?=$rayon['id']?></h2>
    <form action="update_rayon.php?id=<?=$rayon['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nom">Nom</label>
        <input type="text" name="id" value="<?=$rayon['id']?>" id="id">
        <input type="text" name="nom" value="<?=$rayon['nom']?>" id="nom">
        <label for="reference">reference</label>
        <input type="number" name="reference" value="<?=$rayon['reference']?>" id="reference">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>