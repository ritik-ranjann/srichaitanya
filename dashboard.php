<?php include("includes/dashboard/header.php");
pageTitle("Dashboard | Sri Chaitanya techno School");
?>
<?php include_once("includes/dashboard/header-close.php");?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
// login user
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $form_username = $_POST['username'];
    $form_password = $_POST['password'];

   

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT id, password, role, block FROM user WHERE username = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
    $stmt->bind_param("s", $form_username);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($id, $password, $role, $block);
    echo "password: " . $password;

    // Fetch the result
    if ($stmt->fetch()) {
        // Verify the password and check if the user is allowed to log in
        if ($form_password == $password){
            echo "here";
            if ($role === 'admin' && $block == 0) {
                // Correct login - set the session
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $form_username;
                $_SESSION['role'] = $role;

                // Redirect to a protected page or the admin dashboard
                header("Location: dashboard.php"); // Change this to your admin page
                exit;
            } else {
                $error = "You do not have the required permissions or your account is blocked.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    // Close the statement
    $stmt->close();
}
?>

<?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <div class="form-container">
                <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <h2>Login</h2>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    <button type="submit">Login</button>
                </form>
            </div>
            <style>
                .form-container{
                    height: 100vh;
                    width: 100vw;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }
                .form-container form{
                    border: 2px solid #004445;
                    border-radius: 5px;
                    padding: 1rem;
                }
                .form-container form h2{
                    margin: 10px 0 30px 0;
                }
                .form-container form input{
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: 1px solid gray;
                }
                .form-container form button{
                    background: #004445;
                    color: #fff;
                    border-radius: 5px;
                    padding: 5px 20px;
                    width: 100%;
                }
            </style>
            <?php exit(); // Exit to avoid displaying the rest of the page if not logged in ?>
        <?php endif; ?>

<section class="about_section layout_padding">
            <h1>Contact Information</h1>
            <?php

            // Handle deletion if delete button is pressed
            if (isset($_POST['delete_id'])) {
                $delete_id = intval($_POST['delete_id']);
                $delete_sql = "DELETE FROM contacts WHERE id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $delete_id);
                if ($stmt->execute()) {
                    echo "<p>Record deleted successfully.</p>";
                } else {
                    echo "<p>Error deleting record: " . $conn->error . "</p>";
                }
                $stmt->close();
                
                // Refresh the page to update the table
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

            // Handle update if form is submitted
            if (isset($_POST['update_id'])) {
                $update_id = intval($_POST['update_id']);
                $update_name = $_POST['name'];
                $update_phone = $_POST['phone'];
                $update_email = $_POST['email'];
                $update_message = $_POST['message'];
                
                $update_sql = "UPDATE contacts SET name = ?, phone = ?, email = ?, message = ? WHERE id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("ssssi", $update_name, $update_phone, $update_email, $update_message, $update_id);
                if ($stmt->execute()) {
                    echo "<p>Record updated successfully.</p>";
                } else {
                    echo "<p>Error updating record: " . $conn->error . "</p>";
                }
                $stmt->close();
                
                // Refresh the page to update the table
                
            }

            $sql = "SELECT id, name, phone, email, message, created_at FROM contacts ORDER BY created_at DESC";
            $result = $conn->query($sql);
            
            ?>
<div class="contact-form-table">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                $count++;
                                $data = json_encode($row);
                                echo "<tr>";
                                echo "<td>$count</td>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['phone']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['created_at']}</td>";
                                echo "<td class='action'>
                                    <button class='view-btn' data-info='" . htmlspecialchars($data, ENT_QUOTES, 'UTF-8') . "'>View</button>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                                        <button type='submit' class='delete-btn'>Delete</button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Modal -->
            <div id="viewModal" class="modal">
                <div class="modal-content">
                    <h2>View/Update Record</h2>
                    <form id="updateForm" method="POST">
                        <input type="hidden" name="update_id" id="update_id">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" required><br>
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" required><br>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required><br>
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" required></textarea><br>
                        <div class="form-action-button">
                            <button class="close">Close</button>
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- about section ends -->

        <?php include_once("includes/footer/footer.php"); ?>
        
        <style>
        .about_section {
            padding: 1rem;
        }
        .contact-form-table {
            overflow: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        td {
            max-width: 300px;
            min-width: 150px;
            word-break: break-all;
        }
        th.action, td.action {
            text-align: center;
        }
        td.action button {
            padding: 10px 20px;
            background: #004445;
            color: #fff;
            border-radius: 5px;
            border: 0px;
        }
        td.action button.delete-btn {
            background: #f56565;
        }
        td.action button.view-btn {
            background: #4a90e2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1001; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        
        #updateForm{
            display: flex;
            flex-direction: column;
        }
        #updateForm input, #updateForm textarea{
            border: 1px solid gray;
            border-radius: 5px;
            padding: 5px 10px;
        }
        #updateForm button{
            background: #004445;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .action{
            display: flex;
            gap: 10px;
        }
        .form-action-button{
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .form-action-button .close{
            background: white !important;
            color: #004445 !important;
            border: 2px solid #004445 !important;
            text-shadow: none !important;
            opacity: 1 !important;
            font-size: medium !important;
            font-weight: normal !important;
        }
        .form-action-button button:hover{
            background: #046465 !important;
            color: #fff !important;
        }
        .action button{
            min-width: 100px;
        }
        </style>
        
        <script>
        // JavaScript for handling modal
        var modal = document.getElementById("viewModal");
        var span = document.getElementsByClassName("close")[0];
        var updateForm = document.getElementById("updateForm");
        
        document.querySelectorAll(".view-btn").forEach(button => {
            button.addEventListener("click", function() {
                var data = JSON.parse(this.getAttribute("data-info"));
                document.getElementById("update_id").value = data.id;
                document.getElementById("name").value = data.name;
                document.getElementById("phone").value = data.phone;
                document.getElementById("email").value = data.email;
                document.getElementById("message").value = data.message;
                modal.style.display = "block";
            });
        });
        
        span.onclick = function(e) {
            e.preventDefault();
            modal.style.display = "none";
        }
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
    </div>

    
<?php include("includes/footer/footer.php"); ?>

</body>

</html>