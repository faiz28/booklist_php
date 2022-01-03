<?php

include_once('config.php');
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
    <link rel="stylesheet" href="assets/style.css" type="text/css">

    <title> Book store</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <a href="<?php echo 'index.php' ?>" class="btn btn-lg btn-secondary">Home</a>
            </div>
        </div>
    </header>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="search-container">
                <form>
                    <div>
                        <input type="text" placeholder="Search by title" name="query"
                            style="padding: 5px;    margin-right: -7px;">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <br>
    <br>
    <div class="container">
        <div class="row">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Availablity</th>
                    <th>ISBN</th>
                    <th>Option</th>

                </tr>
                <?php if ($books_size == 0) : ?>

                <h4>Sorry, No item found;</h4>

                <?php endif; ?>
                <?php foreach ($books as $key => $book) : ?>


                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td>
                        <a href="#">
                            <?php echo $book['title']; ?>
                        </a>
                    </td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['available'] ? 'True' : 'False'; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td>
                        <script>
                        function myFunction() {
                            alert("Delete one item!");
                        }
                        </script>
                        <a href="<?php echo $BASE_URL . '/' . 'delete.php?id=' . $key  ?>">
                            <button class="btn btn-lg btn-danger" onclick="myFunction()">Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <a href="<?php echo $BASE_URL . '/' . 'create.php' ?>">
                <button class="btn btn-lg btn-primary">Create</button>
            </a>
        </div>
    </div>


</body>

</html>
