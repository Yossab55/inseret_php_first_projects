<?php

include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  // if (in_array("insert", $_GET)) {
  //   header("location: http://localhost/projects/project_001/inseret.php");
  //   exit;
  // }

  if ($_GET != null) {
    if (array_key_exists("delete", $_GET)) {
      $key_delete = array_keys($_GET["delete"]);
      $sql_delete = "DELETE FROM persons WHERE Id =$key_delete[0]";
      $statement_delete = $db_work->prepare($sql_delete);
      $statement_delete->execute();

      header("Location: index.php");
    }

    if (array_key_exists("edit", $_GET)) {
      $key_edit = array_keys($_GET["edit"]);
      // session_start();
      // $_SESSION["id"] = $key_edit[0];
      header("Location: edit.php?id=" . $key_edit[0]);
    }
    if (in_array("truncate", $_GET)) {
      $sql_truncate = "TRUNCATE TABLE persons";
      $statement_truncate = $db_work->prepare($sql_truncate);
      $statement_truncate->execute();
      header("Location: index.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>see forms</title>
</head>

<body>
  <!-- START welcome section -->
  <nav>
    <h2>Hello try this web site</h2>
    <p>try to sign names and edit it and remove it from data base from this web site ❤️</p>
    <p>sorry there is no css in this web site why ? because i'm lazy 😂❤️</p>
  </nav>
  <!-- END welcome section -->

  <!-- strat work -->
  <!-- START first button to sign names  -->
  <!-- <form action="" method="get">
      <input type="submit" value="insert" name="insert">
    </form> -->
  <a href="inseret.php">
    <button>Insert</button>
  </a>
  <!-- END first button to sign names  -->

  <!-- start show data -->
  <?php

  $sql_count = "SELECT COUNT(*) as number_rows FROM persons";
  $statement_count = $db_work->prepare($sql_count);
  $statement_count->execute();
  $number_of_rows = $statement_count->fetch(PDO::FETCH_ASSOC);

  if ($number_of_rows["number_rows"] > 0) {
  ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Email</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql_select_data = "SELECT * FROM persons ORDER BY Id";
        $statement_select = $db_work->prepare($sql_select_data);
        $statement_select->execute();
        while ($result = $statement_select->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<th>" . $result["Id"] . "</th>";
          echo "<th>" . $result["First_Name"] . "</th>";
          echo "<th>" . $result["Last_Name"] . "</th>";
          echo "<th>" . $result["Email"] . "</th>";
          echo "<th>"; ?>
          <form action="" method="get" style="margin: 0">
            <input type="submit" value="edit" name="edit[<?php echo $result['Id'] ?>]">
          </form>
          <?php
          echo "</th>";
          echo "<th>"; ?>
          <form action="" method="get" style="margin: 0">

            <input type="submit" value="delete" name="delete[<?php echo $result['Id'] ?>]">
          </form>
        <?php
          echo "</th>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <form action="" method="get">
      <input type="submit" value="truncate" name="truncate">
    </form>
  <?php
  } else {

    echo "<h2> there is no data </h2>";
  }
  ?>
  <!-- end show data -->

</body>

</html>