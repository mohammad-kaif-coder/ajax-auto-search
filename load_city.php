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

$search_term = isset($_POST["city"])? $_POST["city"] : '';
$sql = "SELECT * FROM address WHERE city LIKE '%{$search_term}%'";
$result = mysqli_query($conn,$sql);

$output = "<ul>";
if(mysqli_num_rows($result)> 0){
    while($row = mysqli_fetch_assoc($result)){
       $output.="<li>{$row['city']}</li>"; 
    }
    
    
}else{
    $output.="<li>address not found</li>"; 
    
}
$output .= "</ul>";
echo $output;

?>

