<?php
$bookDao = new BookDaoImpl();
$genreDao = new GenreDaoImpl();
//  Kode untuk menghapus data
$deleteCommand = filter_input(INPUT_GET, 'command');
if (isset($deleteCommand) && $deleteCommand == 'delbok') {
    $idYangDihapus = filter_input(INPUT_GET, 'sid');
    $toBeDeletedBook = new Book();
    $toBeDeletedBook->setIsbn($idYangDihapus);
    $bookDao->deleteBook($toBeDeletedBook);
}

//  Kode untuk menambah data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $isbn = filter_input(INPUT_POST, 'txtIsbn');
    $title = filter_input(INPUT_POST, 'txtTitle');
    $author = filter_input(INPUT_POST, 'txtAuthor');
    $publisher = filter_input(INPUT_POST, 'txtPublisher');
    $publishDate = filter_input(INPUT_POST, 'txtPublishDate');
    $description = filter_input(INPUT_POST, 'txtDescription');
    $cover = filter_input(INPUT_POST, 'fileCover');
    $genreId = filter_input(INPUT_POST, 'comboGenre');

//    echo $_FILES['fileCover']['name'] . '<br>';
//    echo $_FILES['fileCover']['type'] . '<br>';
//    echo $_FILES['fileCover']['size'] . '<br>';
//    echo $_FILES['fileCover']['tmp_name'] . '<br>';
//    addBook($isbn, $title, $author, $publisher, $publishDate, $description,
//            $genreId);
    if (isset($_FILES['fileCover']['name'])) {
        $targetDirectory = 'uploads/';
        $fileExtension = pathinfo($_FILES['fileCover']['name'],
                PATHINFO_EXTENSION);
        $targetFile = $targetDirectory . $isbn . '.' . $fileExtension;

        //  Check allowed file type
        $allowedType = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, TRUE);
        if (in_array($_FILES['fileCover']['type'], $allowedType)) {
            $uploadOk = TRUE;
        }
        if (isset($uploadOk) && $uploadOk) {
            move_uploaded_file($_FILES['fileCover']['tmp_name'], $targetFile);
            $newBook = new Book();
            $newBook->setAuthor($author);
            $newBook->setCover($targetFile);
            $newBook->setDescription($description);
            $genre = new Genre();
            $genre->setId($genreId);
            $newBook->setGenre($genre);
            $newBook->setIsbn($isbn);
            $newBook->setPublish_date($publishDate);
            $newBook->setPublisher($publisher);
            $newBook->setTitle($title);
            var_dump($newBook);
            $bookDao->addBook($newBook);
//            addBook($isbn, $title, $author, $publisher, $publishDate,
//                    $description, $targetFile, $genreId);
        }
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Input New Genre</legend>
        <label for="txtIsbnId">ISBN</label>
        <input type="text" id="txtIsbnId" name="txtIsbn" autofocus="" placeholder="Name" maxlength="13" required="" class="form-input"/>
        <label for="txtTitleId">Title</label>
        <input type="text" id="txtTitleId" name="txtTitle" placeholder="Title" required="" class="form-input" />
        <label for="txtAuthorId">Author</label>
        <input type="text" id="txtAuthorId" name="txtAuthor" placeholder="Author" required="" class="form-input"/>
        <label for="txtPublisherId">Publisher</label>
        <input type="text" id="txtPublisherId" name="txtPublisher" placeholder="Publisher" required="" class="form-input"/>
        <label for="txtPublishDateId">Publish Date</label>
        <input type="date" id="txtPublishDateId" name="txtPublishDate" placeholder="Publish Date" required="" class="form-input" />
        <label for="txtDescriptionId">Description</label>
        <textarea id="txtDescriptionId" name="txtDescription" placeholder="Description" class="form-input" rows="5" required="" maxlength="300"></textarea>
        <label for="fileCoverId">Cover</label>
        <input type="file" id="fileCoverId" name="fileCover" accept="image/jpg, image/jpeg, image/png" class="form-input" />
        <label for="comboGenreId">Genre</label>
        <select name="comboGenre" id="comboGenreId" required="" class="form-input">
            <?php
            $genres = $genreDao->getAllGenres();
            /* @var $genre Genre */
            foreach ($genres as $genre) {
                echo '<option value="' . $genre->getId() . '">' . $genre->getName() . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="btnSubmit" value="Save" class="button button-default"/>
    </fieldset>
</form>

<?php
$books = $bookDao->getAllBook();
/* @var $book Book */
echo '<table border="1" id="myTable" class="display">';
echo '<thead>';
echo '<tr>';
echo '<th>ISBN</th>';
echo '<th>Book Desc</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($books as $book) {
    echo '<tr>';
    if ($book->getCover() != NULL) {
        echo '<td><img src="' . $book->getCover() . '" alt="cover" class="thumbnail"><br>' . $book->getIsbn() . '</td>';
    } else {
        echo '<td>' . $book->getIsbn() . '</td>';
    }
    echo '<td>';
    echo 'Title : ' . $book->getTitle() . '<br>';
    echo 'Author : ' . $book->getAuthor() . '<br>';
    echo 'Publisher : ' . $book->getPublisher() . '<br>';
    echo 'Genre : ' . $book->getGenre()->getName();
    echo '</td>';
    echo '<td><button onclick="editBook(\'' . $book->getIsbn() . '\')" class="button button-normal">Edit</button><button onclick="deleteBook(\'' . $book->getIsbn() . '\')" value="button" class="button button-delete">Delete</button></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
