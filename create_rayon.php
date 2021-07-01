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
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $reference = isset($_POST['reference']) ? $_POST['reference'] : '';
    // Insert new record into the adherent table
    $stmt = $pdo->prepare('INSERT INTO rayon VALUES (?, ?, ?)');
    $stmt->execute([$id, $nom, $reference]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>
<div class="content update">
	<h2>Create Rayon</h2>
    <form action="create_rayon.php" method="post">
	<label for="id">id</label>
            <input type="text" name="id" id="id">
            <label for="nom">nom</label>
            <input type="text" name="nom" id="nom">
		
            <label for="reference">reference</label>
            <input type="number" name="reference" id="reference">		
            <input type="submit"/></p>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>