<?php
require "../confiq.php";
require "../common.php";

if (isset($_GET["productid"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["productid"];

    $sql = "DELETE FROM productlist WHERE productid = :productid";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':productid', $id);
    $statement->execute();

    $success = "Product successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM productlist";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
    
<?php if ($success) {
	$success;
	echo $success;
	} ?>
    
<h2>Delete products</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>Type</th>
      <th>Prize</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["productid"]); ?></td>
      <td><?php echo escape($row["product"]); ?></td>
      <td><?php echo escape($row["producttype"]); ?></td>
      <td><?php echo escape($row["prize"]); ?></td>
      <td><a href="delete.php?productid=<?php echo escape($row["productid"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>