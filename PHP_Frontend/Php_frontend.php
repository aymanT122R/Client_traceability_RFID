<?php
$api_key_value = "YOUR_API_KEY";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get API Key
    $api_key = test_input($_POST["api_key"] ?? '');

    // Database connection
    $servername = "localhost";
    $username = "root"; // default XAMPP user
    $password = ""; // default XAMPP password is empty
    $dbname = "YOUR_DATABASE";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($api_key == $api_key_value) {
        if (isset($_POST["insert"])) {
            // Insert New Client
            $uid = test_input($_POST["uid"]);
            $nom = test_input($_POST["nom"]);
            $prenom = test_input($_POST["prenom"]);
            $solde = test_input($_POST["solde"]);

            $sql = "INSERT INTO YOUR_TABLE_NAME (uid, nom, prenom, solde) VALUES ('$uid', '$nom', '$prenom', '$solde')";
            if ($conn->query($sql) === TRUE) {
                $message = "New client created successfully!";
            } else {
                $message = "Error: " . $conn->error;
            }
        } elseif (isset($_POST["search"])) {
            // Search for Client
            $uid = test_input($_POST["uid"]);
            $sql = "SELECT nom, prenom, solde FROM YOUR_TABLE_NAME WHERE uid = '$uid'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $message = "Client found: Nom: " . $row["nom"] . ", Prenom: " . $row["prenom"] . ", Solde: " . $row["solde"];
            } else {
                $message = "UID not found in the database.";
            }
        } elseif (isset($_POST["update"])) {
            // Update Client Solde
            $uid = test_input($_POST["uid"]);
            $newSolde = test_input($_POST["solde"]);

            $sql = "UPDATE YOUR_TABLE_NAME SET solde = '$newSolde' WHERE uid = '$uid'";
            if ($conn->query($sql) === TRUE) {
                $message = "Client's solde updated successfully!";
            } else {
                $message = "Error updating solde: " . $conn->error;
            }
        }
    } else {
        $message = "Wrong API Key!";
    }

    $conn->close();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Data Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            color: green;
            margin-bottom: 20px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Client Data</h2>
        
        <!-- Insert Client Form -->
        <form action="insert.php" method="POST">
            <h3>Insert New Client</h3>
            <label for="uid">UID:</label>
            <input type="text" name="uid" required>
            <label for="nom">Nom:</label>
            <input type="text" name="uid" value="<?php echo $uid; ?>" required>
            <label for="prenom">Prenom:</label>
            <input type="text" name="prenom" required>
            <label for="solde">Solde:</label>
            <input type="number" name="solde" required>
            <input type="submit" value="Insert Client">
        </form>

        <!-- Search Client Form -->
        <form action="search.php" method="POST">
            <h3>Search for Client by UID</h3>
            <label for="uid">UID:</label>
            <input type="text" name="uid" required>
            <input type="submit" value="Search Client">
        </form>

        <!-- Modify Client Solde Form -->
        <form action="update.php" method="POST">
            <h3>Update Client Solde</h3>
            <label for="uid">UID:</label>
            <input type="text" name="uid" required>
            <label for="solde">New Solde:</label>
            <input type="number" name="solde" required>
            <input type="submit" value="Update Solde">
        </form>
    </div>
</body>
</html>
