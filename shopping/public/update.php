<?php

require "../confiq.php";
require "../common.php";

try {
	$connection = new PDO($dsn, $username, $password, $options);
	
	$sql = "SELECT * FROM productlist";
	$statement = $connection->prepare($sql);
	$statement-> execute();

	$result = $statement->fetchAll();
}
catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage(); 
}
?>

<?php require "templates/header.php"; ?>

<h2>Update products</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>Type</th>
      <th>Prize</th>
	  <th>Edit</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["productid"]); ?></td>
      <td><?php echo escape($row["product"]); ?></td>
      <td><?php echo escape($row["producttype"]); ?></td>
      <td><?php echo escape($row["prize"]); ?></td>
	  <td><a href="update-single.php?productid=<?php echo escape($row["productid"]); ?>">Edit</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>