<?php

/**
 * Description of Book
 *
 * @author Anthony
 */
class Book {

    private $isbn;
    private $title;
    private $author;
    private $description;
    private $publisher;
    private $publish_date;
    private $cover;
    private $genre;

    public function __construct() {
        $this->genre = new Genre();
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getPublish_date() {
        return $this->publish_date;
    }

    public function getCover() {
        return $this->cover;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }

    public function setPublish_date($publish_date) {
        $this->publish_date = $publish_date;
    }

    public function setCover($cover) {
        $this->cover = $cover;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function __set($name, $value) {
        if (!isset($this->genre)) {
            $this->genre = new Genre();
        }
        if (isset($value)) {
            switch ($name) {
                case 'id':
                    $this->genre->setId($value);
                    break;
                case 'name':
                    $this->genre->setName($value);
                    break;
                default :
                    break;
            }
        }
    }

}
