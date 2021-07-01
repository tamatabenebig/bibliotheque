<?php
include 'functions.php';
// Your PHP code here.
// Home Page template below.

$conn = pdo_connect_mysql();
$reponse =$conn->query('SELECT * FROM adherent');

?>
<?php echo template_header('Read'); ?>
<?php	
	$pdo_statement = $conn->prepare("SELECT * FROM adherent");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<div class="content read">
	<h2>Voir les adhérent</h2>
	<a href="create_adh.php" class="create-contact">Créer un adherent</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Nb livre empruntée</td>
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
		<td><?php echo $row["prenom"]; ?></td>
        <td><?php echo $row["nbLivreEmprunte"]; ?></td>
	
		<td class="actions">
                    <a href="update_adh.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_adh.php?id=<?=$row['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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