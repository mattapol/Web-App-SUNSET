<?php
require('connectDB.php');
$sql = "SELECT * FROM user_library, book_library WHERE user_library.book_id = book_library.book_ID AND book_library.status = 'ยืม' ";
$result = $conn->query($sql);
echo "|<a href='Index.php'>Indext</a>|<a href='history.php'>History</a>|<a href='book.php'>Book</a>|";
if ($result->num_rows > 0) {
  // output data of each row
  echo " <table border='1'><tr><th>user id</th> <th>Name</th> <th>Lastname</th> <th>borrow Book</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['userID'] . "</td>";
    echo "<td>" . $row['fristname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['Book_name'] . "</td>";
    echo "</tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>