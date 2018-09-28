<?php
if (isset($_POST['submit'])) {
	try {
		require "../confiq.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * FROM productlist WHERE producttype = :producttype";
		$type = $_POST['producttype'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':producttype', $type, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} 
	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php
 include "templates/header.php";
?>

<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Cart History</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Product</th>
					<th>Type</th>
					<th>Prize</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) { ?>
				<tr>
					<td><?php echo escape($row["productid"]); ?></td>
					<td><?php echo escape($row["product"]); ?></td>
					<td><?php echo escape($row["producttype"]); ?></td>
					<td><?php echo escape($row["prize"]); ?></td>
				</tr>
				<?php
				}
				?> 
			</tbody>
		</table>
	<?php
	}
	else { 
	?>
	<blockquote>No results found for <?php echo escape($_POST['producttype']); ?>.</blockquote>
	<?php } 
} 
?> 

<h2>Find product based on type</h2>

<form method="post">
	<label for="producttype">Type</label>
	<input type="text" id="producttype" name="producttype">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php
 include "templates/footer.php";
?>