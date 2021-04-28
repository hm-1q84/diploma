<?php
  function print_table($conn, $sql) {
    $result = $conn->query($sql);
    $fields = $result->fetch_fields();
    echo "<table>";
    echo "<tr>";
    foreach ($fields as $field) {
      echo "<th>".$field->name."</th>";
    }
    echo "</tr>";
    foreach ($result as $row) {
      echo "<tr>";
      foreach ($fields as $field) {
        echo "<td>".$row[$field->name]."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }
?>