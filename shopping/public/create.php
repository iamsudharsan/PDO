<?php
require "../confiq.php";
require "../common.php";
if (isset($_POST['submit'])){
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		$new_product = array(
		"product" => $_POST['product'],
		"producttype"  => $_POST['producttype'],
		"prize" => $_POST['prize']
		);
	
		//INSERT INTO productlist (product, producttype, prize) values (:product, :producttype, :prize) 

		$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"productlist",
		implode(", ", array_keys($new_product)),
		":" . implode(", :", array_keys($new_product))
);

$statement = $connection->prepare($sql);
$statement->execute($new_product);
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
 if (isset($_POST['submit']) && $statement) {
?>
<blockquote><?php echo escape($_POST['product']);?>, successfully added.</blockquote>
<?php
 }
?>

<h2>Add a product</h2>

<form method="post">
	<label for="product">Product</label>
	<input type="text" name="product" id="product" required>
	<label for="producttype">Type</label>
	<input type="text" name="producttype" id="producttype" required>
	<label for="prize">Prize</label>
	<input type="text" name="prize" id="prize" required>
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php
 include "templates/footer.php";
?>