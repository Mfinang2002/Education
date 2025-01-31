<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            background-color: #28a745;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            width: 450px;
            height: 620px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 100px;
        }

        .form-content {
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            margin-bottom: 15px;
            color: #333;
            text-align: center;
            font-size: 1.5rem;
        }

        label {
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9rem;
        }

        input, select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
            width: 100%;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .form-group select, .form-group input {
            width: 100%;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.9rem;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            color: #555;
            text-align: center;
            font-size: 0.85rem;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .welcome-message {
            color: #fff;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: right;
            transform: translateX(-200px);
        }

        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 40px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }
    </style>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function toggleConfirmPassword() {
            const passwordField = document.getElementById('confirm-password');
            const toggleIcon = document.getElementById('toggle-confirm-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <div class="form-content">
            <form id="scholar-registration-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>Student Registration</h2>
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>

                <div class="form-group">
                    <div>
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="phone-number">Phone Number:</label>
                        <input type="tel" id="phone-number" name="phone-number" pattern="[0-9]{10}" required>
                    </div>
                </div>

                <label for="registration-number">Registration Number:</label>
                    <input type="text" id="registration-number" name="registration-number" pattern="(C|OD|B|M)(IT|CS|BM|A)-\d{2}-\d{4}-\d{4}" placeholder="BIT-01-0075-2022" required>


                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-eye toggle-password" id="toggle-password" onclick="togglePassword()"></i>
                </div>

                <label for="confirm-password">Confirm Password:</label>
                <div class="password-container">
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <i class="fas fa-eye toggle-password" id="toggle-confirm-password" onclick="toggleConfirmPassword()"></i>
                </div>

                <button type="submit">Register</button>
                <p>Already have an account? <a href="login.html">Login here</a></p>
            </form>
        </div>
    </div>
    <div class="welcome-message">
        Welcome to e-Library
    </div>

    <!-- Success and Error Modals -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your registration was successful! You can now <a href="login.html">login here</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Registration Failed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>There was an error with your registration. Please try again.</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "elibrary";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo "<script>var myModal = new bootstrap.Modal(document.getElementById('errorModal')); myModal.show();</script>";
            die();
        }

        $fullName = $_POST['full-name'];
        $gender = $_POST['gender'];
        $mobile = $_POST['phone-number'];
        $regNo = $_POST['registration-number'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Check if registration number already exists
        $checkRegNo = "SELECT * FROM scholars WHERE reg_no = '$regNo'";
        $result = $conn->query($checkRegNo);

        if ($result->num_rows > 0) {
            echo "<script>var myModal = new bootstrap.Modal(document.getElementById('errorModal')); myModal.show();</script>";
        } else {
            // Insert into database
            $sql = "INSERT INTO scholars (full_name, gender, mobile, reg_no, email, password) VALUES ('$fullName', '$gender', '$mobile', '$regNo', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>var myModal = new bootstrap.Modal(document.getElementById('successModal')); myModal.show();</script>";
            } else {
                echo "<script>var myModal = new bootstrap.Modal(document.getElementById('errorModal')); myModal.show();</script>";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>
