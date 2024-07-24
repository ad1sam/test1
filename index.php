<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-3" style="background-color: #00ff5573;">
        PHP Complete CRUD
    </nav>
    <div class="container">
        <?php
        // Display messages from GET parameter
        if (isset($_GET['msg'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'
                    . htmlspecialchars($_GET['msg']) .
                 '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        }
        ?>
        <a href="add_new.php" class="btn btn-danger mb-3">Add New</a>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_con.php";
                $sql = "SELECT * FROM `crudtutorial`";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>" . htmlspecialchars($row['first_name']) . "</td>
                                <td>" . htmlspecialchars($row['last_name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['gender']) . "</td>
                                <td>
                                    <a href='edit.php?id=" . intval($row['id']) . "' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                                    <a href='delete.php?id=" . intval($row['id']) . "' class='link-dark'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
