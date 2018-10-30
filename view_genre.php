<?php
$genreDao = new GenreDaoImpl();

//  Kode untuk menghapus data
$deleteCommand = filter_input(INPUT_GET, 'command');
if (isset($deleteCommand) && $deleteCommand == 'delete') {
    $idYangDihapus = filter_input(INPUT_GET, 'sid');
    $toBeDeletedGenre = new Genre();
    $toBeDeletedGenre->setId($idYangDihapus);
    $genreDao->deleteGenre($toBeDeletedGenre);
//    deleteGenre($idYangDihapus);
}

//  Kode untuk menambah data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $name = filter_input(INPUT_POST, 'txtName');
    $newGenre = new Genre();
    $newGenre->setName($name);
    $genreDao->addGenre($newGenre);
//    addGenre($name);
}
?>

<form method="POST">
    <fieldset>
        <legend>Input New Genre</legend>
        <label for="txtNameId">Name</label>
        <input type="text" id="txtNameId" name="txtName" autofocus="" placeholder="Name" class="form-input"/>
        <input type="submit" name="btnSubmit" value="Save" class="button button-default"/>
    </fieldset>
</form>

<?php
$genres = $genreDao->getAllGenres();
/* @var $genre Genre */
echo '<table border="1" id="myTable" class="display">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>NAME</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($genres as $genre) {
    echo '<tr>';
    echo '<td>' . $genre->getId() . '</td>';
    echo '<td>' . $genre->getName() . '</td>';
    echo '<td><button onclick="editGenre(' . $genre->getId() . ')">Edit</button><button onclick="deleteGenre(' . $genre->getId() . ')">Delete</button></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
