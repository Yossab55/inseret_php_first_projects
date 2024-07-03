<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") :
  if ($_POST["insert"]) :

    if ($_POST["fname"] == null || $_POST["lname"] == null) {
      // die("<h1>name can not be unknown</h1>");
      $error = "Name can't be unknown";
    } else if ($_POST['email'] == null) {
      // die("<h1>EMAIL can not be unknown</h1>");
      $error = "Email can't be unknown";
    } else {
      include("connect_db.php");
      $data = [
        'First_name' => $_POST["fname"],
        'Last_name' => $_POST["lname"],
        'email' => $_POST["email"]
      ];
      $sql_insert = "INSERT INTO persons (First_name, Last_name, Email) values (:First_name, :Last_name, :email) ";
      $db_work->prepare($sql_insert)->execute($data);
      // echo "insert value completed";
      header('location: index.php');
    }
  endif;
endif;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>values</title>
</head>

<body>
  <h2>please insert your values</h2>
  <?php
  if (isset($error)) {
    echo "<h3 style=color:red;>*$error</h3>";
  }
  ?>
  <form action="" method="post">
    <label for="fname">First Name</label>
    <br>
    <input type="text" name="fname" id="fname" maxlength="30">
    <span>max length 30</span>
    <br>
    <br>

    <label for="lname">Last Name</label>
    <br>
    <input type="text" name="lname" id="lname" maxlength="30">
    <span>max length 30</span>
    <br>
    <br>

    <label for="email">Your Email</label>
    <br>
    <input type="email" name="email" id="email">
    <br>
    <br>
    <input type="submit" value="insert" name="insert">
  </form>
  <a href="index.php">Home</a>
</body>

</html>