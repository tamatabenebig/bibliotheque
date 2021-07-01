<?php
include 'functions.php';
// Your PHP code here.
// Home Page template below.

$conn = pdo_connect_mysql();
$reponse =$conn->query('SELECT * FROM rayon');

?>
<?php echo template_header('Read'); ?>
<?php	
	$pdo_statement = $conn->prepare("SELECT * FROM rayon");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="content read">
	<h2>Voir les Rayons</h2>
	<a href="create_rayon.php" class="create-contact">Créer un rayon</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Reference</td>
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
		<td><?php echo $row["nom"]; ?></td>
        <td><?php echo $row["reference"]; ?></td>
		<td class="actions">
                    <a href="update_rayon.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_rayon.php?id=<?=$row['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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