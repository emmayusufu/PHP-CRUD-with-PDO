<?php
/** @var $pdo PDO */
require_once "../../database.php";

$search = $_GET['search'] ?? '';
if($search){
    $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC ');
    $statement->bindValue(':title', "%$search%");
}
else {
    $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC ');
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include_once "../views/partials/header.php";?>
<div class="container">
    <h1>Products CRUD</h1>
    <p>
        <a href="create.php" class="btn btn-success">Create Product</a>
    </p>

    <form method="get" action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search for products..." value="<?php echo $search ?>" />
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Actions</th>
        </tr>

        </thead>
        <tbody>
        <?php foreach ($products as $i => $product) : ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td>
                    <img class="thumb-image" src="<?php echo $product['image'] ?>"
                         alt="/<?php echo $product['title'] ?>"/>
                </td>
                <td><?php echo $product["title"] ?></td>
                <td><?php echo $product["description"] ?></td>
                <td><?php echo $product["price"] ?></td>
                <td><?php echo $product["create_date"] ?></td>
                <td>
                    <a href="../products/update.php?id=<?php echo $product['id'] ?>" type="submit"
                       class="btn btn-outline-primary btn-sm">Edit</a>
                    <form style="display: inline-block" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>"/>
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
