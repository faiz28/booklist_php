<?php

// check the json file is exists or not
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
} else {
    $books = array();
}


// search item
$query = $_GET['query'];
$size_search = strlen($query);
$query = strtolower($query);
$query = explode(" ", $query);

$search_item = array();
foreach ($books as $key => $book) {
    $title = strtolower($book['title']);

    for ($i = 0; $i < sizeof($query); $i += 1) {
        if ($query[$i] == "" || $query[$i] == " ") continue;
        if (strpos((string)$title, (string)($query[$i])) !== false) {
            array_push($search_item, $books[$key]);
        }
    }
}

if ($size_search != 0) {
    $books = $search_item;
}
$books_size = sizeof($books);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style.css" type="text/css">

    <title> Book store</title>
</head>

<body>

    <div class="container">
        <div class="row navbar">
            <div class="logo">
                <a href="<?php echo 'index.php' ?>" class="btn btn-lg btn-primary">Home</a>
            </div>
            <div class="search-container">
                <form class="example">
                    <div>
                        <input type="text" placeholder="Search by title" name="query">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Availablity</th>
                    <th>Pages</th>
                    <th>ISBN</th>
                    <th>Option</th>

                </tr>
                <?php if ($books_size == 0) : ?>

                <h4>Sorry, No item found;</h4>

                <?php endif; ?>
                <?php foreach ($books as $key => $book) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><a href="#"><?php echo $book['title']; ?></a></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['available'] ? 'True' : 'False'; ?></td>
                    <td><?php echo $book['pages']; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td><a href="<?php echo 'delete.php?id=' . $key  ?>"><button class="btn btn-lg btn-danger"
                                onclick="return confirm('Are you want to delete item?')">Delete</button></a></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <div class="create">
                <a href="<?php echo 'create.php' ?>">
                    <button class="btn btn-lg btn-primary">Create</button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>
