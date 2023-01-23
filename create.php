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
    $nama_dos = isset($_POST['nama_dos']) ? $_POST['nama_dos'] : '';
    $mata_kuliah = isset($_POST['mata_kuliah']) ? $_POST['mata_kuliah'] : '';
    $code_mk = isset($_POST['code_mk']) ? $_POST['code_mk'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO matkul VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $nama_dos, $mata_kuliah, $code_mk]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Data</h2>
    <form action="create.php" method="post">
        <label for="id">No</label>
        <label for="nama_dos">Nama Dosen</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama_dos" id="nama_dos">
        <label for="mata_kuliah">Mata Kuliah</label>
        <label for="code_mk">Code Mata Kuliah</label>
        <input type="text" name="mata_kuliah" id="mata_kuliah">
        <input type="text" name="code_mk" id="code_mk">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>