<?php
function print_requests($conn, $sql) {
    $result = $conn->query($sql);
    $fields = $result->fetch_fields();
    echo "<table class='table'>";
    echo "<tr>";
    foreach ($fields as $field) {
        if ($field->name == 'id') {
            continue;
        }
        echo "<th>".$field->name."</th>";
    }
    echo "<th>delete</th>";
    echo "</tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($fields as $field) {
            if ($field->name == 'id') {
                continue;  
            }
            echo "<td>".$row[$field->name]."</td>";
        }
        echo "<td><a class='table__ref' href='requests.php?action=delete&id=".$row[$fields[0]->name]."'>delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function print_requests_prepStmt($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    $fields = $result->fetch_fields();
    echo "<table class='table'>";
    echo "<tr>";
    foreach ($fields as $field) {
        if ($field->name == 'id') {
            continue;
        }
        echo "<th>".$field->name."</th>";
    }
    echo "<th>delete</th>";
    echo "</tr>";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        echo "<tr>";
        foreach ($fields as $field) {
            if ($field->name == 'id') {
                continue;  
            }
            echo "<td>".$row[$field->name]."</td>";
        }
        echo "<td><a class='table__ref' href='requests.php?action=delete&id=".$row[$fields[0]->name]."'>delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>