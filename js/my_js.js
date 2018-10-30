function deleteGenre(id) {
    var confirmation = window.confirm("Are you sure want to delete?")
    if (confirmation) {
        window.location = "index.php?navito=pg2&command=delete&sid=" + id;
    }
}

function editGenre(id) {
    window.location = "index.php?navito=edpg2&command=update&sid=" + id;
}

function deleteBook(isbn) {
    var confirmation = window.confirm("Are you sure want to delete?")
    if (confirmation) {
        window.location = "index.php?navito=pg3&command=delbok&sid=" + isbn;
    }
}

function editBook(isbn) {
    window.location = "index.php?navito=edpg3&command=upbok&sid=" + isbn;
}
