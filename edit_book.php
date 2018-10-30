<?php
$bookDao = new BookDaoImpl();
$genreDao = new GenreDaoImpl();

//  Kode untuk meletakkan data dalam form
$updateCommand = filter_input(INPUT_GET, 'command');
if (isset($updateCommand) && $updateCommand == 'upbok') {
    $isbnYangDicari = filter_input(INPUT_GET, 'sid');
    $book = $bookDao->getOneBook($isbnYangDicari);
}

//  Kode untuk update data
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $isbn = filter_input(INPUT_POST, 'txtIsbn');
    $title = filter_input(INPUT_POST, 'txtTitle');
    $author = filter_input(INPUT_POST, 'txtAuthor');
    $publisher = filter_input(INPUT_POST, 'txtPublisher');
    $publishDate = filter_input(INPUT_POST, 'txtPublishDate');
    $description = filter_input(INPUT_POST, 'txtDescription');
    $genreId = filter_input(INPUT_POST, 'comboGenre');
    $updateBook = new Book();
    $updateBook->setIsbn($isbn);
    $updateBook->setTitle($title);
    $updateBook->setAuthor($author);
    $updateBook->setPublisher($publisher);
    $updateBook->setPublish_date($publishDate);
    $updateBook->setDescription($description);
    $genre = new Genre();
    $genre->setId($genreId);
    $updateBook->setGenre($genre);
    $bookDao->updateBook($updateBook);
//    updateBook($isbn, $title, $author, $publisher, $publishDate, $description,
//            $cover, $genreId);
    header("location:index.php?navito=pg3");
}
?>

<form method="POST">
    <fieldset>
        <legend>Edit Genre</legend>
        <label for="txtIsbnId">ISBN</label>
        <input type="text" id="txtIsbnId" name="txtIsbn" placeholder="Name" maxlength="13" required="" value="<?php echo $book['isbn']; ?>" class="form-input" readonly=""/>
        <label for="txtTitleId">Title</label>
        <input type="text" id="txtTitleId" name="txtTitle" placeholder="Title" required=""  value="<?php echo $book['title']; ?>" class="form-input" autofocus=""/>
        <label for="txtAuthorId">Author</label>
        <input type="text" id="txtAuthorId" name="txtAuthor" placeholder="Author" required=""  value="<?php echo $book['author']; ?>" class="form-input"/>
        <label for="txtPublisherId">Publisher</label>
        <input type="text" id="txtPublisherId" name="txtPublisher" placeholder="Publisher" required=""  value="<?php echo $book['publisher']; ?>" class="form-input"/>
        <label for="txtPublishDateId">Publish Date</label>
        <input type="date" id="txtPublishDateId" name="txtPublishDate" placeholder="Publish Date" required=""  value="<?php echo $book['publish_date']; ?>" class="form-input" />
        <label for="txtDescriptionId">Description</label>
        <textarea id="txtDescriptionId" name="txtDescription" placeholder="Description" class="form-input" rows="5" required="" maxlength="300"><?php echo $book['description']; ?></textarea>
        <label for="comboGenreId">Genre</label>
        <select name="comboGenre" id="comboGenreId" required="" class="form-input">
            <?php
            $genres = $genreDao->getAllGenres();
            /* @var $genre Genre */
            foreach ($genres as $genre) {
                if ($genre->getId() == $book['genre_id']) {
                    echo '<option value="' . $genre->getId() . '" selected>' . $genre->getName() . '</option>';
                } else {
                    echo '<option value="' . $genre->getId() . '">' . $genre->getName() . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit" name="btnSubmit" value="Update" class="button button-default"/>
    </fieldset>
</form>
