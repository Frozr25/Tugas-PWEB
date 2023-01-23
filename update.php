<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama_dos = isset($_POST['nama_dos']) ? $_POST['nama_dos'] : '';
        $mata_kuliah = isset($_POST['mata_kuliah']) ? $_POST['mata_kuliah'] : '';
        $code_mk = isset($_POST['code_mk']) ? $_POST['code_mk'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, nama_dos = ?, mata_kuliah = ?, code_mk = ? WHERE id = ?');
        $stmt->execute([$no, $nama_dos, $mata_kuliah, $code_mk, $_GET['no']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM matkul WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['no']?>" method="post">
        <label for="id">No</label>
        <label for="nama_dos">Nama Dosen</label>
        <input type="text" name="id" value="<?=$contact['no']?>" id="id">
        <input type="text" name="nama_dos" value="<?=$contact['nama_dos']?>" id="nama_dos">
        <label for="mata_kuliah">Mata Kuliah</label>
        <label for="code_mk">Code Mata Kuliah</label>
        <input type="text" name="mata_kuliah" value="<?=$contact['mata_kuliah']?>" id="mata_kuliah">
        <input type="text" name="code_mk" value="<?=$contact['code_mk']?>" id="code_mk">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>