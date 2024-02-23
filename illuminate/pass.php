<?php

$name = "INVALID DETAILS";
// Database connection details

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);

    // SQL query to check if the provided email and phone exist in the database
    $sql = "SELECT * FROM illuminate WHERE phone = '$phone' OR email = '$email' ORDER BY CASE WHEN phone = '$phone' THEN 1 ELSE 2 END ";
    // echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data found in the database, show the pass
        $row = $result->fetch_assoc();
        $name = $row["name"]; // Assuming there is a 'name' column in the table

    }


else {
        // Data not found in the database
        echo "No matching data found in the database.";
        echo '<script>alert("Pass not genrated or Payment not made Please contact the Organizer - +91 83800 66588");
        
        window.location="https://ecell-met.tech/illuminate/";
        </script>';
        // header("location: ");

    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Illuminate Workshop 2023 Entry Pass</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<style>
    .logo{
        width : 150px;
        height : auto;
    }
</style>
    <div class="container mt-5">
        <div class="card text-center">
        <img src="met.png" class="img-fluid" alt="Responsive image">
            <div class="card-header bg-dark text-light">
                <h3>IIT Bombay E-Cell Illuminate Workshop 2023</h3>
            </div>
            <div class="card-body">
                <h2 class="card-title">Entry Pass</h2>
                <h3 class="card-text">This pass grants access to the Illuminate Workshop 2023 and Collect the IIT KIT.</h3>
                <div class="row">
                    <div class="col">
                    <img src="iit.png" class="logo"  class="img-fluid" alt="Responsive image">
                    </div>

                    <div class="col">
                    <img class="logo" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo 'ILLUMINATE - ' .$name .'- Phone ' .$phone; ?>"  alt="QR Code" class="img-thumbnail">
                </div>

                    <div class="col">
                    <img src="metecell.png" class="logo"  class="img-fluid" alt="Responsive image">
                    </div>
                </div>

                <h4><ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Name:</strong> <?php echo $name;?> &nbsp; <strong>Phone :</strong> <?php echo $phone;?>
                    </li>

                
                        
                   

                    <li class="list-group-item">
                        <strong>Date:</strong> 25th November 2023 &nbsp; <strong>Time:</strong> 10:00 AM to 5:30 PM
                    </li>
                    <li class="list-group-item">
                        
                    
                        <strong>Venue:</strong> <a href="https://maps.app.goo.gl/LciLtgVCc2QbZswcA">IOTP Seminar Hall, IOT BTech Building, MET Bhujbal Knowledge City, Adgaon,
                        Nashik</a>
                    </li>
                </ul></h4>
                 <p class="card-text">Kindly carry your Institute Photo ID Card along with you.</p>
<hr>
                <h4>Contact Us </h4>
              <h5>  <b> Siddharth Perkar : </b> <a href="tel:+917249461185">+91 7249 461185</a> <br>
                <b> Tanmay Hirodar : </b><a href="tel:+918380066588">+91 83800 66588</a></h5>
            </div>
            <div class="card-footer text-muted bg-dark text-light"> 
                <p class="mb-0">© 2023 Illuminate Workshop. All rights reserved with Tanmay Hirodkar</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
