<?php

//function createMySqlConnection() {
//    $link = mysqli_connect('localhost', 'root', '', 'pwl20181', '3306') or die(mysqli_connect_error());
//    mysqli_autocommit($link, FALSE);
//    return $link;
//}
//
//function createPDOConnection() {
//    $link = new PDO('mysql:host=localhost;dbname=pwl20181', 'root', '');
//    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
//    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    return $link;
//}
//
//function closePDOConnection($link) {
//    $link = NULL;
//}

//function login($username, $password) {
//    $link = createPDOConnection();
//    $query = 'SELECT name, username FROM user WHERE username = ? AND password = ? LIMIT 1';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $username, PDO::PARAM_STR);
//    $stmt->bindParam(2, $password, PDO::PARAM_STR);
//    $stmt->execute();
//    $result = $stmt->fetch();
//    closePDOConnection($link);
//    return $result;
//}
//function getAllGenre() {
//    $link = createPDOConnection();
//    $query = 'SELECT * FROM genre';
//    $result = $link->query($query);
//    closePDOConnection($link);
//    return $result;
//}
//function getOneGenre($id) {
//    $link = createPDOConnection();
//    $query = 'SELECT * FROM genre WHERE id = ?';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $id, PDO::PARAM_INT);
//    $stmt->execute();
//    $result = $stmt->fetch();
//    closePDOConnection($link);
//    return $result;
//}
//function addGenre($name) {
//    $link = createPDOConnection();
//    $query = 'INSERT INTO genre(name) VALUES(?)';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $name, PDO::PARAM_STR);
//    $link->beginTransaction();
//    if ($stmt->execute()) {
//        $link->commit();
//    } else {
//        $link->rollBack();
//    }
//    closePDOConnection($link);
//}
//function deleteGenre($genreId) {
//    $link = createPDOConnection();
//    $query = 'DELETE FROM genre WHERE id = ?';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $genreId, PDO::PARAM_INT);
//    $link->beginTransaction();
//    if ($stmt->execute()) {
//        $link->commit();
//    } else {
//        $link->rollBack();
//    }
//    closePDOConnection($link);
//}
//function updateGenre($name, $id) {
//    $link = createPDOConnection();
//    $query = 'UPDATE genre SET name = ? WHERE id = ?';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $name, PDO::PARAM_STR);
//    $stmt->bindParam(2, $id, PDO::PARAM_INT);
//    $link->beginTransaction();
//    if ($stmt->execute()) {
//        $link->commit();
//    } else {
//        $link->rollBack();
//    }
//    closePDOConnection($link);
//}
//function getAllBook() {
//    $link = createPDOConnection();
//    $query = 'SELECT * FROM book b JOIN genre g ON g.id = b.genre_id';
//    $result = $link->query($query);
//    closePDOConnection($link);
//    return $result;
//}
//function addBook($isbn, $title, $author, $publisher, $publishDate, $description,
//        $cover, $genreId) {
//    $link = createPDOConnection();
//    $query = 'INSERT INTO book(isbn, title, author, publisher, publish_date, description, cover, genre_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $isbn, PDO::PARAM_STR);
//    $stmt->bindParam(2, $title, PDO::PARAM_STR);
//    $stmt->bindParam(3, $author, PDO::PARAM_STR);
//    $stmt->bindParam(4, $publisher, PDO::PARAM_STR);
//    $stmt->bindParam(5, $publishDate, PDO::PARAM_STR);
//    $stmt->bindParam(6, $description, PDO::PARAM_STR);
//    $stmt->bindParam(7, $cover, PDO::PARAM_STR);
//    $stmt->bindParam(8, $genreId, PDO::PARAM_INT);
//    $link->beginTransaction();
//    if ($stmt->execute()) {
//        $link->commit();
//    } else {
//        $link->rollBack();
//    }
//    closePDOConnection($link);
//}

//function updateBook($isbn, $title, $author, $publisher, $publishDate,
//        $description, $cover, $genreId) {
//    $link = createPDOConnection();
//    $query = 'UPDATE book SET title = ?, author = ?, description = ?, publisher = ?, publish_date = ?, genre_id = ? WHERE isbn = ?';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(8, $isbn, PDO::PARAM_STR);
//    $stmt->bindParam(1, $title, PDO::PARAM_STR);
//    $stmt->bindParam(2, $author, PDO::PARAM_STR);
//    $stmt->bindParam(3, $publisher, PDO::PARAM_STR);
//    $stmt->bindParam(4, $publishDate, PDO::PARAM_STR);
//    $stmt->bindParam(5, $description, PDO::PARAM_STR);
//    $stmt->bindParam(6, $cover, PDO::PARAM_STR);
//    $stmt->bindParam(7, $genreId, PDO::PARAM_INT);
//    $link->beginTransaction();
//    if ($stmt->execute()) {
//        $link->commit();
//    } else {
//        $link->rollBack();
//    }
//    closePDOConnection($link);
//}

//function getOneBook($isbn) {
//    $link = createPDOConnection();
//    $query = 'SELECT * FROM book WHERE isbn = ?';
//    $stmt = $link->prepare($query);
//    $stmt->bindParam(1, $isbn, PDO::PARAM_STR);
//    $stmt->execute();
//    $result = $stmt->fetch();
//    closePDOConnection($link);
//    return $result;
//}
