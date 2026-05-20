<?php
// Student ID: 2243091
// Student Name: Hamoud Mahdi
// Lab 10 - Task 3: Database Connection

echo "<h2>Task 3: Database Connection</h2>";

// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$port = 3307;

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);

    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<div style='color: green; font-weight: bold;'>✓ Database Connection Successful!</div><br>";

    // Execute SHOW DATABASES query
    $stmt = $conn->query("SHOW DATABASES");

    // Fetch all databases
    $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Display results
    echo "<h3>Available Databases:</h3>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>No.</th><th>Database Name</th></tr>";

    $counter = 1;
    foreach ($databases as $db) {
        echo "<tr>";
        echo "<td>{$counter}</td>";
        echo "<td>{$db}</td>";
        echo "</tr>";
        $counter++;
    }

    echo "</table>";

    // Alternative: Display as list
    echo "<h3>List Format:</h3>";
    echo "<ul>";
    foreach ($databases as $db) {
        echo "<li>{$db}</li>";
    }
    echo "</ul>";

    // Connection info
    echo "<hr>";
    echo "<p><strong>Connection Details:</strong></p>";
    echo "<ul>";
    echo "<li>Server: {$servername}</li>";
    echo "<li>Username: {$username}</li>";
    echo "<li>Total Databases: " . count($databases) . "</li>";
    echo "</ul>";

} catch(PDOException $e) {
    echo "<div style='color: red; font-weight: bold;'>✗ Connection failed: " . $e->getMessage() . "</div>";
}

// Close connection
$conn = null;
?>