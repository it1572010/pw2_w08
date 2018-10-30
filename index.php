<?php
//include_once './db_function/db_function.php';
include_once './dao/BookDaoImpl.php';
include_once './dao/GenreDaoImpl.php';
include_once './dao/UserDaoImpl.php';
include_once './entity/Book.php';
include_once './entity/Genre.php';
include_once './entity/User.php';
include_once './util/PDOUtil.php';

session_start();
if (!isset($_SESSION['user_login'])) {
    $_SESSION['user_login'] = FALSE;
}

$navigation = filter_input(INPUT_GET, 'navito');
if (!isset($navigation)) {
    $navigation = 'home';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP 02</title>
        <link rel="stylesheet" href="css/jquery.dataTables.css" />
        <link rel="stylesheet" href="css/styles.css" />
        <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/my_js.js"></script>
    </head>
    <body>
        <div class="page">
            <?php
            if (!$_SESSION['user_login']) {
                include_once './view_login.php';
            } else {
                ?>
                <nav>
                    <ul>
                        <li><a href="?navito=home">Home</a></li>
                        <li><a href="?navito=pg1">Page 1</a></li>
                        <li><a href="?navito=pg2">Genre</a></li>
                        <li><a href="?navito=pg3">Book</a></li>
                        <li><a href="?navito=logout">Logout</a></li>
                    </ul>
                </nav>
                <?php
                switch ($navigation) {
                    case 'home':
                        include_once './home.php';
                        break;
                    case 'pg1':
                        include_once './page1.php';
                        break;
                    case 'pg2':
                        include_once './view_genre.php';
                        break;
                    case 'pg3':
                        include_once './view_book.php';
                        break;
                    case 'edpg2':
                        include_once './edit_genre.php';
                        break;
                    case 'edpg3':
                        include_once './edit_book.php';
                        break;
                    case 'logout':
                        session_unset();
                        session_destroy();
                        header("location:index.php");
                        break;
                    default:
                        include_once './home.php';
                        break;
                }
            }
            ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>
    </body>
</html>
