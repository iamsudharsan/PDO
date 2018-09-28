<?php
require "../confiq.php";
require "../common.php";

if (isset($_POST['submit'])) {
	//if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  try {
    $connection = new PDO($dsn, $username, $password, $options);  
	
	$product =[
      "productid"        => $_POST['productid'],
      "product" => $_POST['product'],
      "producttype"  => $_POST['producttype'],
	  "prize"     => $_POST['prize']
    ];
	

	$sql = "UPDATE productlist 
		   SET productid = :productid, 
			product = :product, 
			producttype = :producttype, 
			prize = :prize 
		   WHERE productid = :productid";
		   
	$statement = $connection->prepare($sql);
	$statement->execute($product);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_GET['productid'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['productid'];

    $sql = "SELECT * FROM productlist WHERE productid = :productid";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':productid', $id);
    $statement->execute();

    $product = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();	
  }
} else {
  echo "Something went wrong!";
  exit;
}
?>

<?php require "templates/header.php"; ?>

 <?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['product']); ?> successfully updated.</blockquote>
<?php endif; ?>


<h2>Edit a product</h2>

<form method="post">
	<input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <?php foreach ($product as $key => $value) : ?>
    <label for="<?php echo $key; ?>">
		<?php echo ucfirst($key); ?>
	</label>

	<input 
	  type="text" 
	  name="<?php echo $key; ?>" 
	  id="<?php echo $key; ?>" 
	  value="<?php echo escape($value); ?>" 
	  <?php echo ($key === 'productid' ? 'readonly' : null); ?>>
	  <?php endforeach; ?> 
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>


  
 