<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $books = '';
    if (file_exists('books.json')) {
        $json = file_get_contents('books.json');
        $books = json_decode($json, true);
    } else {
        $books = array();
    }
    foreach($books as $key => $book) {
        echo "key => $key id => $id<br>";
        if($key==$id)
        {
            unset($books[$id]);
        }
    }
    echo "<br>";
    $book_str = json_encode($books);
    file_put_contents('books.json', $book_str);
    header('Location: index.php');

    
} else {
    header('Location: 404.php');
}

?>
<?php
echo "$id";
?>