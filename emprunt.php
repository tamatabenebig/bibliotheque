<?php
include 'functions.php';
// Your PHP code here.
// Home Page template below.

$conn = pdo_connect_mysql();
$reponse =$conn->query('SELECT * FROM emprunt');

?>
<?php echo template_header('Read'); ?>
<?php	
	$pdo_statement = $conn->prepare("SELECT * FROM emprunt");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="content read">
	<h2>Voir les Emprunts</h2>
	<a href="create.php" class="create-contact">Créer un emprunt</a>
	<table>
        <thead>
            <tr>
                <td>idLivre</td>
                <td>idAdherent</td>
                <td>dateEmprunt</td>
                <td>dRetourMax</td>
                <td>dateRetour</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="table-body">
	<?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["idLivre"]; ?></td>
		<td><?php echo $row["idAdherent"]; ?></td>
		<td><?php echo $row["dateEmprunt"]; ?></td>
        <td><?php echo $row["dRetourMax"]; ?></td>
		<td><?php echo $row["dateRetour"]; ?></td>
		<td class="actions">
                    <a href="update.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$row['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
	  </tr>
    <?php
		}
	}
	?>
  </tbody>
    </table>
</div>

<?php echo template_footer(); ?>