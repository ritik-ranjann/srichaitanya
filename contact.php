<?php include("includes/header/header.php");
pageTitle("Contact Sri Chaitanya techno School - Empowering Minds, Shaping Futures"); ?>
<?php include_once("includes/header/header-close.php"); ?>
<?php 
//handle form here
?>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate the inputs (basic validation)
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare and bind the SQL statement to insert the data
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Execute the statement
        if ($stmt->execute()) {
            $success = "Thank you for submitting your query, we will get back to you soon!";
        } else {
            $error = "There was an error saving your message. Please try again.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!-- Contact Start -->
<div class="container-fluid bg-secondary px-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Contact For Any Queries</h1>
                <!-- Display any success or error messages -->
<?php if (isset($success)) { echo '<p style="color: green;">' . $success . '</p>'; } ?>
<?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row g-3">
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="form-floating-1" placeholder="John Doe" name="name">
                                <label for="form-floating-1">Full Name</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="form-floating-2" placeholder="name@example.com" name="email">
                                <label for="form-floating-2">Email address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="form-floating-3" placeholder="Subject" name="phone">
                                <label for="form-floating-3">Phone</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Message" id="form-floating-4" style="height: 150px" name="message"></textarea>
                                <label for="form-floating-4">Message</label>
                              </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6" style="min-height: 400px;">
                <div class="position-relative h-100">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28027.195639500867!2d77.4287893384606!3d28.587790994076467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5007a3163ed%3A0x588956052d7b9e82!2sShri%20Chaitanya%20Techno%20School!5e0!3m2!1sen!2sin!4v1722784570992!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php include("includes/footer/footer.php"); ?>
