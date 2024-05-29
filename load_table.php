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
$sql = "SELECT * FROM address WHERE city = '{$_POST['city']}'";
$result = mysqli_query($conn,$sql);
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output .= '<table border="">
    <tr>
        <td>ID</td>
        <td>CITY</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
        <td>{$row["id"]}</td>
        <td>{$row["city"]}</td>
    </tr>";
    }
    $output.="</table>";
    echo $output;
}else{
    echo "No record Found";
}
?>



