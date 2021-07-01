<?php
include 'functions.php';
// Your PHP code here.
// Home Page template below.

$conn = pdo_connect_mysql();
$reponse =$conn->query('SELECT * FROM livre');

?>
<?php echo template_header('Read'); ?>
<?php	
	$pdo_statement = $conn->prepare("SELECT * FROM livre");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="content read">
	<h2>Voir les Livres</h2>
	<a href="create_book.php" class="create-contact">Créer fiche livre</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>titre</td>
                <td>auteur</td>
                <td>disponible</td>
                <td>cardNumber</td>
                <td>idRayon</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="table-body">
	<?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["titre"]; ?></td>
		<td><?php echo $row["auteur"]; ?></td>
        <td><?php echo $row["disponible"]; ?></td>
		<td><?php echo $row["cardNumber"]; ?></td>
        <td><?php echo $row["idRayon"]; ?></td>
		<td class="actions">
                    <a href="update_book.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_book.php?id=<?=$row['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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