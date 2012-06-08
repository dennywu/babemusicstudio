<?php
    require_once('mysql.class.php');
    require_once('global.inc.php');
    require_once('repository/BookRepository.php');
    
    $action = $_GET['action'];
    switch ($action) {
        case 'getBooks':
            $offset = $_GET["offset"];
            $books = getBooks($offset);
            echo json_encode($books);
            break;
	case 'getByCategory':
            $category = $_GET["id"];
            $offset = $_GET["offset"];
            $books = getBookByCategory($category, $offset);
            echo json_encode($books);
            break;
	case 'countBook':
            $total = countBook();
            echo json_encode($total);
            break;
	case 'update':
            break;
    }
?>
