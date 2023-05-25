<?php
// Establish a connection to MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Record";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Task 1: Create Database and table

$sql = "CREATE DATABASE Record";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
$dbname = "students";
mysqli_select_db($conn, $dbname);


// Create the students table if it does not exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS students (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
f_name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
phone VARCHAR(20) NOT NULL,
address VARCHAR(100) NOT NULL
)";
if ($conn->query($sql_create_table) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

// Insert some sample data into the students table
$sql_insert_data = "INSERT INTO students (name, email, phone, address)
VALUES ('John Doe', 'john.doe@example.com', '1234567890', '123 Main St, Anytown, USA'),
       ('Jane Smith', 'jane.smith@example.com', '0987654321', '456 Oak Ave, Anycity, USA')";
if ($conn->query($sql_insert_data) === FALSE) {
  echo "Error inserting data: " . $conn->error;
}

// Retrieve data from students table
$sql_select_data = "SELECT * FROM students";
$result = $conn->query($sql_select_data);

// Display data in table format
if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

// Task 3: Add a new student record to the students table using a web form
  
  if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sql_insert_record = "INSERT INTO students (name, email, phone, address)
    VALUES ('$name', '$email', '$phone', '$address')";
    if ($conn->query($sql_insert_record) === FALSE) {
      echo "Error inserting record: " . $conn->error;
    } else {
      echo "New student record added successfully";
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



// Close the database connection
$conn->close();
?>


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
