<?php
session_start();
include("../connect_db/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $AdminID = $_POST['Id'];
// if(isset($_SESSION['username'])) {
//   echo "Your session is running " . $_SESSION['userName'];
// }
    

// if (!isset($_SESSION['username'])) {
//     header('Location: ../home/');
//     exit();
//     }
// MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque_ia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $id = sanitize($_POST["id"]);
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $tel = sanitize($_POST["tel"]);

    // Update user data in the database
    $sql = "UPDATE users SET name='$name', email='$email', tel='$tel' WHERE AdminId=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch user data from the database
$id = session_id(); // Assuming the user is logged in with ID 1 (you should implement proper authentication)
$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $tel = $row["tel"];
} else {
    echo "User not found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Profile</title>
</head>
<body>

    <div class="profile-container">
        <h2>User Profile</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>

            <label for="tel">Tel:</label>
            <input type="tel" name="tel" value="<?php echo $tel; ?>" required>

            <input type="submit" value="Update Profile">
        </form>
    </div>

</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
---- Include the above in your HEAD tag -------

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        Kshiti Ghelani
                                    </h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                       

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>1</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>PASSWORD</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>********</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti Ghelani</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>kshitighelani@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>123 456 7890</p>
                                            </div>
                                        </div>
                            
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    
</body>
</html> -->


