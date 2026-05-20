<?php
// Student ID: [Your ID]
// Student Name: [Your Name]
// Lab 10 - Task 2: Class Diagram Implementation

echo "<h2>Task 2: OOP - Person and Professor Classes</h2>";

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
echo "<h3>Demo:</h3>";

// Create Person object
$person = new Person("Ahmed Ali");
echo "<strong>Person Object:</strong><br>";
echo "Name: " . $person->getName() . "<br>";
echo "Speak: " . $person->speak() . "<br>";
echo "<hr>";

// Create Professor object
$professor = new Professor("Dr. Mohammed Hassan", 15000.50);
echo "<strong>Professor Object:</strong><br>";
echo "Name: " . $professor->getName() . "<br>";
echo "Salary: " . number_format($professor->getSalary(), 2) . " SAR<br>";
echo "Speak: " . $professor->speak() . "<br>";
echo "Teach: " . $professor->Teach() . "<br>";
?>