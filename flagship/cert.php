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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Sanitize user inputs
    $email = sanitizeInput($_GET["email"]);
    $phone = sanitizeInput($_GET["phone"]);

    // SQL query to check if the provided email and phone exist in the database
    $sql = "SELECT * FROM flagship WHERE phone = '$phone' OR email = '$email' ORDER BY CASE WHEN phone = '$phone' THEN 1 ELSE 2 END ";
    // echo $sql;  
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data found in the database, show the pass
        $row = $result->fetch_assoc();
        $name = $row["first_name"]; // Assuming there is a 'name' column in the table

    }


else {
        // Data not found in the database
        echo "No matching data found in the database.";
        echo '<script>alert("Please contact the Organizer - +91 83800 66588");
        
        window.location="https://ecell-met.tech/flagship/";
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
    <title>CErtificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

     <style>
        @media print {
            @page {
                size: landscape;
                margin: 0; /* Set margin to 0 to remove default margin */
            }

            #cert, img{
                width:100%
            }

            /* Hide header and footer */
            header, footer, #button {
                display: none;
            }
        }

        /* Additional styles for the button */
        body {
            font-family: Arial, sans-serif;
            /* padding: 20px; */
        }

       
    </style>
</head>

<body>

    <div class="container" id="cert">
        <img src="blankcert.png" alt="Snow" style="width:100%; ">
       
        <div class="centered"><h3> <?php echo $name ; ?></h3></div>
      </div>
     <div  id="button" class="container mt-2">
     <a href="https://www.linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name=MET%20ECell%20Logo%20Guessing%20Competition&organizationId=100022407&issueYear=2023&issueMonth=12&certUrl=https://ecell-met.tech/flagship/cert.php%3Femail=<?php echo $email ?>&phone=<?php echo $phone ?>" target="_blank">
  <button id="button" class="btn btn-primary">Share on LinkedIn</button>
</a>

     <button id="button" class="btn btn-secondary" onclick="printPage()">Download</button>
    </div>
    <script>
        function printPage() {
            window.print();
        }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>  

