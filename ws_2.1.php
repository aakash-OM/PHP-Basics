<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "aakash1";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Task 1: create database with table
$sql = "CREATE DATABASE students";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
$dbname = "students";
mysqli_select_db($conn, $dbname);


// create table with constraints
$sql = "CREATE TABLE mytable (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  age INT(3) NOT NULL CHECK (age > 0),
  gender ENUM('male','female','other') NOT NULL,
  city VARCHAR(30),
  country VARCHAR(30),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_name_city (name, city),
  FOREIGN KEY (city) REFERENCES cities(city)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// Task 2: Retrieve all records from the students table and display them in a table format
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Task 3: Add a new student record to the students table using a web form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Validate form data
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        echo "Please fill out all fields.";
    } else {
        // Insert new student record into the database
        $sql = "INSERT INTO students (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Task 4: Retrieve a specific student record based on the id field
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<p>Record found:</p>";
        echo "<p>ID: " . $row["id"] . "</p>";
        echo "<p>Name: " . $row["name"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>Phone: " . $row["phone"] . "</p>";
        echo "<p>Address: " . $row["address"] . "</p>";
    } else {
        echo "Record not found.";
    }
}

// Task 5 - Update existing student record
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // Validate form data
  if (empty($name) || empty($email) || empty($phone) || empty($address)) {
      echo "All fields are required";
  } else {
      $sql = "UPDATE students SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
      if (mysqli_query($conn, $sql)) {
          echo "Record updated successfully";
      } else {
          echo "Error updating record: " . mysqli_error($conn);
      }
  }
}
?>

// close connection
$conn->close();
?>

<!-- Task 3 - Add new student form -->
  <h2>Add New Student Record</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label>Phone:</label>
    <input type="tel" name="phone" required><br><br>
    <label>Address:</label>
    <textarea name="address" rows="4" cols="50" required></textarea><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html>


    <!-- Task 5 - Update student record form -->
    <form action="update.php" method="post">
  <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
  <label for="name">Name:</label>
  <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>
  <label for="email">Email:</label>
  <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>
  <label for="phone">Phone:</label>
  <input type="tel" name="phone" value="<?php echo $student['phone']; ?>" required><br>
  <label for="address">Address:</label>
  <input type="text" name="address" value="<?php echo $student['address']; ?>" required><br>
  <input type="submit" value="Update">
</form>
