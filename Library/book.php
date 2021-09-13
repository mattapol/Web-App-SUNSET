<?php
require('connectDB.php');
$sql = "SELECT * FROM book_library, book_type WHERE book_library.type_ID = book_type.type_id";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT * FROM book_library, book_type 
    WHERE book_library.type_ID = book_type.type_id AND book_library.type_ID = ".(int)$_POST["typeID"];
}
$result = $conn->query($sql);

echo "|<a href='Index.php'>Indext</a>|<a href='history.php'>History</a>|<a href='book.php'>Book</a>|<br>
    <b>Book List</b><br>
    <form method='POST' action='book.php'>
        <select name='typeID' id='typeID'>
            <option value='1'>documentary</option>
            <option value='2'>law</option>
            <option value='3'>travel</option>
        </select>
    <input type='submit' value='Go'>
</form>";

if ($result->num_rows > 0) {
  // output data of each row
  echo " <table border='1'><tr><th>Book id</th> <th>Name</th> <th>Type</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['book_ID'] . "</td>";
    echo "<td>" . $row['Book_name'] . "</td>";
    echo "<td>" . $row['type_name'] . "</td>";
    echo "</tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>