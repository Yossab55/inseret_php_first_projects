<?php
include("connect_db.php");
session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") :
    if(in_array("update",$_POST)) :

      if($_POST["fname"] == null || $_POST["lname"] == null) {
        die("<h1>name can not be unknown</h1>");
      }
      if($_POST['email'] == null) {
        die("<h1>EMAIL can not be unknown</h1>");
      }
      
      $data = [
        'fname' => $_POST["fname"],
        'lname' => $_POST["lname"],
        'email' => $_POST["email"]
      ];
      $sql_insert = "UPDATE persons (First_name, Last_name, Email) values (:fname, :lname, :email) ";
      $sql_insert = "UPDATE persons SET First_name=:fname, Last_name=:lname, Email=:email  WHERE Id =". $_SESSION['id'];
      $db_work->prepare($sql_insert)->execute($data);
      echo "<h1>update value completed</h1>";
      endif;

      if(in_array("home", $_POST)) {
        

        header("Location: http://localhost/projects/project_001/");
      }
      
      
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
    <h2>please update your values</h2>
    <?php


      $sql_select_row = "SELECT First_Name, Last_Name, Email FROM persons WHERE Id=".$_SESSION['id'] ;
      $statement_select = $db_work->prepare($sql_select_row);
      $statement_select->execute();
      $result = $statement_select->fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="" method="post">
      <label for="fname">First Name</label>
      <br>
      <input type="text" name="fname" id="fname" maxlength ="30" value =<?php echo $result["First_Name"]?>>
      <span>max length 30</span>
      <br>
      <br>

      <label for="lname">Last Name</label>
      <br>
      <input type="text" name="lname" id="lname" maxlength ="30" value= <?php echo $result["Last_Name"]?>>
      <span>max length 30</span>
      <br>
      <br>

      <label for="email">Your Email</label>
      <br>
      <input type="email" name="email" id="email" value = <?php echo $result["Email"]?> style="width:300px">
      <br>
      <br>
      <input type="submit" value="update" name="update">
    </form>
    <form action="" method="post">
      <input type="submit" value="home" name="home">
    </form>
</body>
</html>