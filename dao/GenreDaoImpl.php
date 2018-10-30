<?php

/**
 * Description of GenreDaoImpl
 *
 * @author Anthony
 */
class GenreDaoImpl {

    public function getAllGenres() {
        $link = PDOUtil::createPDOConnection();
        $query = 'SELECT * FROM genre';
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Genre');
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function getOneGenre($id) {
        $link = PDOUtil::createPDOConnection();
        $query = 'SELECT * FROM genre WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }

    public function addGenre(Genre $genre) {
        $link = PDOUtil::createPDOConnection();
        $query = 'INSERT INTO genre(name) VALUES(?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $genre->getName(), PDO::PARAM_STR);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function deleteGenre(Genre $genre) {
        $link = PDOUtil::createPDOConnection();
        $query = 'DELETE FROM genre WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $genre->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

    public function updateGenre(Genre $genre) {
        $link = PDOUtil::createPDOConnection();
        $query = 'UPDATE genre SET name = ? WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $genre->getName(), PDO::PARAM_STR);
        $stmt->bindValue(2, $genre->getId(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closePDOConnection($link);
    }

}
