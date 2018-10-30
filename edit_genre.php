<?php
$genreDao = new GenreDaoImpl();

//  Kode untuk meletakkan data dalam form
$updateCommand = filter_input(INPUT_GET, 'command');
if (isset($updateCommand) && $updateCommand == 'update') {
    $idYangDicari = filter_input(INPUT_GET, 'sid');
    $genre = $genreDao->getOneGenre($idYangDicari);
}

//  Kode untuk update data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $name = filter_input(INPUT_POST, 'txtName');
    $updateGenre = new Genre();
    $updateGenre->setId($genre['id']);
    $updateGenre->setName($name);
    $genreDao->updateGenre($updateGenre);
//    updateGenre($name, $genre['id']);
    header("location:index.php?navito=pg2");
}
?>

<form method="POST">
    <fieldset>
        <legend>Edit Genre</legend>
        <label for="txtNameId">Name</label>
        <input type="text" id="txtNameId" name="txtName" autofocus="" placeholder="Name" class="form-input" value="<?php echo $genre['name']; ?>"/>
        <input type="submit" name="btnSubmit" value="Update" class="form-button"/>
    </fieldset>
</form>