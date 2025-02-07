<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST["uid"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "YOUR_DATABASE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Search for client by UID
    $sql = "SELECT * FROM YOUR_TABLE_NAME WHERE uid = '$uid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display client info
        while ($row = $result->fetch_assoc()) {
            echo "UID: " . $row["uid"] . "<br>";
            echo "Nom: " . $row["Nom"] . "<br>";
            echo "Prenom: " . $row["Prenom"] . "<br>";
            echo "Solde: " . $row["solde"] . "<br>";
        }
    } else {
        echo "Client not found.";
    }

    $conn->close();
}
?>
