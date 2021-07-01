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
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $nbLivreEmprunte = isset($_POST['nbLivreEmprunte']) ? $_POST['nbLivreEmprunte'] : '';
       
        // Update the record
        $stmt = $pdo->prepare('UPDATE adherent SET id = ?, nom = ?, prenom = ?, nbLivreEmprunte = ?  WHERE id = ?');
        $stmt->execute([$id, $nom, $prenom, $nbLivreEmprunte, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the adherent table
    $stmt = $pdo->prepare('SELECT * FROM adherent WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $adherent = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$adherent) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update adherent<?=$adherent['id']?></h2>
    <form action="update_adh.php?id=<?=$adherent['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nom">Nom</label>
        <input type="text" name="id" value="<?=$adherent['id']?>" id="id">
        <input type="text" name="nom" value="<?=$adherent['nom']?>" id="nom">
        <label for="prenom">prenom</label>
        <label for="nbLivreEmprunte">nbLivreEmprunte</label>
        <input type="text" name="prenom" value="<?=$adherent['prenom']?>" id="prenom">
        <input type="text" name="nbLivreEmprunte" value="<?=$adherent['nbLivreEmprunte']?>" id="nbLivreEmprunte">
       
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>