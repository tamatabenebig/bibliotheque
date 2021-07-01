<?php 
include 'functions.php';
$conn = pdo_connect_mysql();
$reponse =$conn->query('SELECT * FROM rayon');
?>
<?php echo template_header('delete'); ?>

<div class="content delete">
	<h2>Delete fiche Rayon</h2>
</div>

 <?php
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "DELETE FROM `rayon` WHERE `id`= " . $_GET['id'];

    $query = $conn->prepare($sql);

    $query->bindValue('id', $id, PDO::PARAM_INT);
    $query->execute();   
	header('Location: rayon.php'); 
}

require_once('close.php');?> 
<?php echo template_footer(); ?>