
<?php
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM thumbnail"; // Replace with your specific query to fetch desired data from the thumbnail table
$result = $conn->query($sql);

$thumbnails = array();

if ($result->num_rows > 0) {
  // Loop through each row in the result set and add data to the thumbnails array
  while($row = $result->fetch_assoc()) {
    $thumbnails[] = $row; // Add the associative array containing thumbnail data to the thumbnails array
  }
}

$conn->close();

echo json_encode($thumbnails); // Encode the thumbnails array as JSON and return it
?>
