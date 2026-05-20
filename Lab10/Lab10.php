<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPIT-405 Lab 10</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .task {
            background: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        h3 {
            color: #34495e;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 12px;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        hr {
            margin: 15px 0;
            border: none;
            border-top: 2px dashed #ccc;
        }
    </style>
</head>
<body>
<h1 style="text-align: center; color: #2c3e50;">CPIT-405 Lab 10 Solutions</h1>
<p style="text-align: center;">
    <strong>Student ID:</strong> 2243091 |
    <strong>Student Name:</strong> Hamoud Mahdi
</p>
<hr style="border-top: 3px solid #2c3e50;">

<!-- Task 1: Power Function -->
<div class="task">
    <?php
    echo "<h2>Task 1: Power Function</h2>";

    // Recursive approach
    function powerRecursive($base, $exponent) {
        if ($exponent == 0) {
            return 1;
        }

        if ($exponent > 0) {
            return $base * powerRecursive($base, $exponent - 1);
        } else {
            return 1 / powerRecursive($base, -$exponent);
        }
    }

    // Iterative approach
    function powerIterative($base, $exponent) {
        $result = 1;
        $absExponent = abs($exponent);

        for ($i = 0; $i < $absExponent; $i++) {
            $result *= $base;
        }

        if ($exponent < 0) {
            return 1 / $result;
        }

        return $result;
    }

    echo "<h3>🔄 Recursive Method:</h3>";
    echo "2<sup>3</sup> = " . powerRecursive(2, 3) . "<br>";
    echo "5<sup>2</sup> = " . powerRecursive(5, 2) . "<br>";
    echo "10<sup>0</sup> = " . powerRecursive(10, 0) . "<br>";
    echo "2<sup>-2</sup> = " . powerRecursive(2, -2) . "<br>";

    echo "<h3>➰ Iterative Method:</h3>";
    echo "2<sup>3</sup> = " . powerIterative(2, 3) . "<br>";
    echo "5<sup>2</sup> = " . powerIterative(5, 2) . "<br>";
    echo "10<sup>0</sup> = " . powerIterative(10, 0) . "<br>";
    echo "2<sup>-2</sup> = " . powerIterative(2, -2) . "<br>";
    ?>
</div>

<!-- Task 2: OOP Implementation -->
<div class="task">
    <?php
    echo "<h2>Task 2: OOP - Person and Professor Classes</h2>";

    // Display the class diagram
    echo "<div class='diagram'>";
    echo "<h3>Class Diagram:</h3>";
    echo "<img src='https://cpit405.gitlab.io/images/labs/lab-8-pic-1.png' alt='Class Diagram'>";
    echo "</div>";

    echo "<hr>";

    // Parent Class: Person
    class Person {
        protected $name;

        public function __construct($name) {
            $this->name = $name;
        }

        public function speak() {
            return "Hello, I am speaking!";
        }

        public function getName() {
            return $this->name;
        }
    }

    // Child Class: Professor (inherits from Person)
    class Professor extends Person {
        private $salary;

        public function __construct($name, $salary) {
            parent::__construct($name);
            $this->salary = $salary;
        }

        public function Teach() {
            return "I am teaching a class!";
        }

        public function getSalary() {
            return $this->salary;
        }
    }

    // Demo Code
    echo "<h3>📋 Class Structure:</h3>";
    echo "<ul>";
    echo "<li><strong>Person Class (Parent):</strong>";
    echo "<ul>";
    echo "<li>Property: name (String)</li>";
    echo "<li>Methods: speak(), getName()</li>";
    echo "</ul></li>";
    echo "<li><strong>Professor Class (Child):</strong>";
    echo "<ul>";
    echo "<li>Inherits from Person</li>";
    echo "<li>Property: salary (Float)</li>";
    echo "<li>Method: Teach()</li>";
    echo "</ul></li>";
    echo "</ul>";

    echo "<h3>🧪 Demo:</h3>";

    // Create Person object
    $person = new Person("Ahmed Ali");
    echo "<div style='background: #e8f4f8; padding: 15px; border-left: 4px solid #3498db; margin: 10px 0;'>";
    echo "<strong>👤 Person Object:</strong><br>";
    echo "Name: " . $person->getName() . "<br>";
    echo "Action: " . $person->speak() . "<br>";
    echo "</div>";

    // Create Professor object
    $professor = new Professor("Dr. Mohammed Hassan", 15000.50);
    echo "<div style='background: #e8f8e8; padding: 15px; border-left: 4px solid #27ae60; margin: 10px 0;'>";
    echo "<strong>👨‍🏫 Professor Object:</strong><br>";
    echo "Name: " . $professor->getName() . " (inherited from Person)<br>";
    echo "Salary: " . number_format($professor->getSalary(), 2) . " SAR<br>";
    echo "Action 1: " . $professor->speak() . " (inherited from Person)<br>";
    echo "Action 2: " . $professor->Teach() . " (Professor's own method)<br>";
    echo "</div>";
    ?>
</div>

<!-- Task 3: Database Connection -->
<div class="task">
    <?php
    echo "<h2>Task 3: Database Connection</h2>";

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $port = 3307;

    try {
        // Create PDO connection
        $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);

        // Set error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "<p class='success'>✓ Database Connection Successful!</p>";

        // Execute SHOW DATABASES query
        $stmt = $conn->query("SHOW DATABASES");

        // Fetch all databases
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Display results in table
        echo "<h3>📊 Available Databases:</h3>";
        echo "<table>";
        echo "<tr><th>No.</th><th>Database Name</th></tr>";

        $counter = 1;
        foreach ($databases as $db) {
            echo "<tr>";
            echo "<td style='text-align: center;'>{$counter}</td>";
            echo "<td>{$db}</td>";
            echo "</tr>";
            $counter++;
        }

        echo "</table>";

        // Connection summary
        echo "<div style='background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;'>";
        echo "<h3>📌 Connection Summary:</h3>";
        echo "<ul>";
        echo "<li><strong>Server:</strong> {$servername}</li>";
        echo "<li><strong>Username:</strong> {$username}</li>";
        echo "<li><strong>Total Databases:</strong> " . count($databases) . "</li>";
        echo "<li><strong>SQL Query Used:</strong> SHOW DATABASES;</li>";
        echo "</ul>";
        echo "</div>";

    } catch(PDOException $e) {
        echo "<p class='error'>✗ Connection failed: " . $e->getMessage() . "</p>";
        echo "<div style='background: #f8d7da; padding: 15px; border-left: 4px solid #dc3545;'>";
        echo "<h4>Troubleshooting:</h4>";
        echo "<ul>";
        echo "<li>Make sure XAMPP/WAMP is running</li>";
        echo "<li>Check if MySQL/MariaDB service is started</li>";
        echo "<li>Verify your database credentials</li>";
        echo "</ul>";
        echo "</div>";
    }

    // Close connection
    $conn = null;
    ?>
</div>

<footer style="text-align: center; margin-top: 50px; padding: 20px; background: #2c3e50; color: white; border-radius: 8px;">
    <p>CPIT-405 Internet Applications | King Abdulaziz University</p>
    <p>Lab 10 - PHP and MariaDB</p>
</footer>

</body>
</html>