<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db_con.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    // Sanitize and validate input
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));

    // Prepare SQL statement
    $sql = "UPDATE `crudtutorial` SET `first_name`=?, `last_name`=?, `email`=?, `gender`=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $gender, $id);

    // Execute statement and handle response
    if ($stmt->execute()) {
        header("Location: index.php?msg=Data updated successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Error: " . $stmt->error . "
              </div>";
    }
    $stmt->close();
}

// Fetch current user data
$sql = "SELECT * FROM `crudtutorial` WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP CRUD Application</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        PHP Complete CRUD Application
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                </div>
                <div class="form-group mb-3">
                    <label>Gender:</label>
                    <div>
                        <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
                        <label for="male" class="form-check-label">Male</label>
                        <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
