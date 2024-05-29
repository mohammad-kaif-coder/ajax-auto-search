<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajax";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from AJAX request
$query = $conn->real_escape_string(isset($_POST['query'])? $_POST['query'] : '');

// Perform SQL query to retrieve auto-complete suggestions
$sql = "SELECT * FROM address WHERE addrs LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output auto-complete suggestions
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['addrs'] . "</p>";
    }
} else {
    echo "No suggestions found";
}

//$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Auto-complete Search</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<h2>Auto-complete Search</h2>
<input type="text" id="searchInput" placeholder="Type your search query..." name="query">

<div id="searchResults"></div>

<script>
   $(document).ready(function () {
    $('#searchInput').keyup(function () {
        var query = $(this).val();
        console.log("Query:", query); // Add this line to check if query is being captured correctly
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {query: query},
            success: function (response) {
                $('#searchResults').html(response);
            }
        });
    });
});

</script>

</body>
</html>
