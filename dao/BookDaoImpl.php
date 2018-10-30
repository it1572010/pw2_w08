<?php

/**
 * Description of BookDaoImpl
 *
 * @author Anthony
 */
class BookDaoImpl {

    public function getAllBook() {
        $link = PDOUtil::createPDOConnection();
        $query = 'SELECT * FROM book b JOIN genre g ON g.id = b.genre_id';
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Book');
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function getOneBook($isbn) {
        $link = PDOUtil::createPDOConnection();
        $query = 'SELECT * FROM book WHERE isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $isbn, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function addBook(Book $book) {
        $link = PDOUtil::createPDOConnection();
        if ($book->getCover() != Null) {
            $query = 'INSERT INTO book(isbn, title, author, publisher, publish_date, description, cover, genre_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        } else {
            $query = 'INSERT INTO book(isbn, title, author, publisher, publish_date, description, genre_id) VALUES(?, ?, ?, ?, ?, ?, ?)';
        }
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $book->getIsbn(), PDO::PARAM_STR);
        $stmt->bindValue(2, $book->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(3, $book->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(4, $book->getPublisher(), PDO::PARAM_STR);
        $stmt->bindValue(5, $book->getPublish_date(), PDO::PARAM_STR);
        $stmt->bindValue(6, $book->getDescription(), PDO::PARAM_STR);
        if ($book->getCover() != Null) {
            $stmt->bindValue(7, $book->getCover(), PDO::PARAM_STR);
            $stmt->bindValue(8, $book->getGenre()->getId(), PDO::PARAM_INT);
        } else {
            $stmt->bindValue(7, $book->getGenre()->getId(), PDO::PARAM_INT);
        }

        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteBook(Book $book) {
        $link = PDOUtil::createPDOConnection();
        $query = 'DELETE FROM book WHERE isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $book->getIsbn(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function updateBook(Book $book) {
        $link = PDOUtil::createPDOConnection();
        if ($book->getCover() != Null) {
            $query = 'UPDATE book SET title = ?, author = ?, description = ?, publisher = ?, publish_date = ?, genre_id = ? WHERE isbn = ?';
        } else {
            $query = 'UPDATE book SET title = ?, author = ?, description = ?, publisher = ?, publish_date = ?, genre_id = ?, cover=? WHERE isbn = ?';
        }
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $book->getTitle(), PDO::PARAM_STR);
        $stmt->bindValue(2, $book->getAuthor(), PDO::PARAM_STR);
        $stmt->bindValue(3, $book->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(4, $book->getPublisher(), PDO::PARAM_STR);
        $stmt->bindValue(5, $book->getPublish_date(), PDO::PARAM_STR);
        $stmt->bindValue(6, $book->getGenre()->getId(), PDO::PARAM_INT);
        if ($book->getCover() != Null) {
            $stmt->bindValue(7, $book->getCover(), PDO::PARAM_STR);
            $stmt->bindValue(8, $book->getIsbn(), PDO::PARAM_STR);
        } else {
            $stmt->bindValue(7, $book->getIsbn(), PDO::PARAM_STR);
        }
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

}
