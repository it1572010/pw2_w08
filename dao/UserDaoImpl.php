<?php

/**
 * Description of UserDaoImpl
 *
 * @author Anthony
 */
class UserDaoImpl {

    public function login(User $user) {
        $link = PDOUtil::createPDOConnection();
        $query = 'SELECT name, username FROM user WHERE username = ? AND password = ? LIMIT 1';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result = $stmt->fetch();
        PDOUtil::closePDOConnection($link);
        return $result;
    }

}
