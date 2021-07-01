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
    $idLivre = isset($_POST['idLivre']) ? $_POST['idLivre'] : '';
    $idAdherent = isset($_POST['idAdherent']) ? $_POST['idAdherent'] : '';
    $dateEmprunt = isset($_POST['dateEmprunt']) ? $_POST['dateEmprunt'] : '';
    $dRetourMax = isset($_POST['dRetourMax']) ? $_POST['dRetourMax'] : '';
    $dateRetour = isset($_POST['dateRetour']) ? $_POST['dateRetour'] : '';
    // Insert new record into the adherent table
    $stmt = $pdo->prepare('INSERT INTO adherent VALUES (?, ?, ?)');
    $stmt->execute([$id, $idLivre, $idAdherent, $dateEmprunt, $dRetourMax, $dateRetour]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
            <label for="id">id</label>
            <input type="text" name="id" id="id">
            <label for="idAdherent">idAdherent</label>
            <input type="text" name="idAdherent" id="idAdherent">
			<label for="idLivre">idLivre</label>
            <input type="text" name="idLivre" id="idLivre">
            <label for="dateEmprunt">dateEmprunt</label>
            <input type="number" name="dateEmprunt" id="dateEmprunt">
            <label for="dRetourMax">dRetourMax</label>
            <input type="number" name="dRetourMax" id="dRetourMax">	
            <label for="dateRetour">dateRetour</label>
            <input type="number" name="dateRetour" id="dateRetour">		
            <input type="submit"/></p>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>