<?php

/**
 * Description of PDOUtil
 *
 * @author Anthony
 */
class PDOUtil {

    public static function createPDOConnection() {
        $link = new PDO('mysql:host=localhost;dbname=pwl20181', 'root', '');
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }

    public static function closePDOConnection(PDO $link) {
        $link = NULL;
    }

}
