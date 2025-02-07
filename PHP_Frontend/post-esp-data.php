<?php
$api_key_value = "YOUR_API_KEY";

$api_key = $uid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $uid = test_input($_POST["uid"]);

        // Database connection
        $servername = "localhost";
        $username = "root"; // default XAMPP user
        $password = ""; // default XAMPP password is empty
        $dbname = "YOUR_DATABASE";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Search for the client by UID in the 'data_jeton' table
        $sql = "SELECT nom, prenom, solde FROM YOUR_TABLE_NAME WHERE uid = '$uid'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Get the current solde
            $row = $result->fetch_assoc();
            $solde = $row["solde"];

            if ($solde > 0) {
                // Subtract 1 from the solde
                $newSolde = $solde - 1;
                $sql = "UPDATE YOUR_TABLE_NAME SET solde = '$newSolde' WHERE uid = '$uid'";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Transaction successful. New solde: " . $newSolde;
                } else {
                    echo "Error updating solde: " . $conn->error;
                }
            } else {
                echo "Insufficient balance.";
            }
        } else {
            echo "UID not found in the database.";
        }

        $conn->close();
    } else {
        echo "Wrong API Key!";
    }
} else {
    echo "No data received";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
