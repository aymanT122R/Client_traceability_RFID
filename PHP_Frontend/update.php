<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST["uid"];
    $newSolde = $_POST["solde"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "YOUR_DATABASE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update client solde
    $sql = "UPDATE YOUR_TABLE_NAME SET solde = '$newSolde' WHERE uid = '$uid'";

    if ($conn->query($sql) === TRUE) {
        echo "Client solde updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
