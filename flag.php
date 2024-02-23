
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment procces Flagship</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

<?php
// Include your database connection configuration here
// Database connection details


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $institute = $_POST["institute"];
    $year = $_POST["year"];

    // Use prepared statement to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO flagship (first_name, last_name, phone, email, institute, year) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssi", $firstName, $lastName, $phone, $email, $institute, $year);
    $sql->execute();

    // Check if the query was successful
    if ($sql->affected_rows > 0) {
        echo "<h2>Submitted Information:</h2>";
        echo "<p><strong>First Name:</strong> $firstName</p>";
        echo "<p><strong>Last Name:</strong> $lastName</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Institute:</strong> $institute</p>";
        echo "<p><strong>Year:</strong> $year</p>";
        echo "<p><strong>Submission Date-Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
        echo "<p><strong>PayUrl:</strong> <a href='upi://pay?pa=tnmy.fin-1@okhdfcbank&pn=Tanmay_Hirodkar&am=10.00&cu=INR&tn=ECELL-Flagship-$phone'>Make Payment</a></p>";
       
         $payurl = 'upi://pay?pa=tnmy.fin-1@okhdfcbank&pn=Tanmay_Hirodkar&am=10.00&cu=INR&tn=ECELL-Flagship-".$phone."';

      header("location: $payurl");


    } else {
        echo "Error: " . $sql->error;
    }

    // Close the connection
    $sql->close();
    $conn->close();
} else {
    // Redirect if accessed directly without form submission
    header("Location: index.html");
    exit();
}
?>
  </body>
</html>