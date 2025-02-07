<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $uid = $_POST["uid"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $solde = $_POST["solde"];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "YOUR_DATABASE";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert client into data_jeton table
    $sql = "INSERT INTO jeton_data (uid, nom, prenom, solde) VALUES ('$uid', '$nom', '$prenom', '$solde')";

    if ($conn->query($sql) === TRUE) {
        echo "New client added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
