<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login</title>
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
            height: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 100px;
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

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9rem;
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
            margin-top: 20px;
        }

        a {
            color: #28a745;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .welcome-message {
            color: #fff;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: left;
            transform: translateX(200px);
        }

        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 40px; /* Adjust padding to accommodate the eye icon */
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
    </script>
</head>
<body>
    <div class="welcome-message">
        Log in to e-Library
    </div>
    <div class="form-container">
        <div class="form-content">
            <form id="login-form" action="loginstudent.php" method="POST">
                <h2>Student Login</h2>
                <label for="registration-number">Registration Number:</label>
                <input type="text" id="registration-number" name="registration-number" pattern="(C|OD|B|M)(IT|CS|BM|A)-\d{2}-\d{4}-\d{4}" placeholder="BIT-01-0075-2022" required>
                
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-eye toggle-password" id="toggle-password" onclick="togglePassword()"></i>
                </div>

                <button type="submit">Login</button>
                <p>New user? <a href="registrationstudent.php">Sign up here</a></p>
            </form>
        </div>
    </div>

    <!-- Success and Error Modals -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Login Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You have successfully logged in! Redirecting to your panel...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Login Failed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Invalid registration number or password. Please try again.</p>
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

        $regNo = $_POST['registration-number'];
        $password = $_POST['password'];

        // Check if registration number exists and password is correct
        $sql = "SELECT * FROM scholars WHERE reg_no = '$regNo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                echo "<script>var myModal = new bootstrap.Modal(document.getElementById('successModal')); myModal.show(); setTimeout(() => { window.location.href = 'userpanel.html'; }, 2000);</script>";
            } else {
                echo "<script>var myModal = new bootstrap.Modal(document.getElementById('errorModal')); myModal.show();</script>";
            }
        } else {
            echo "<script>var myModal = new bootstrap.Modal(document.getElementById('errorModal')); myModal.show();</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
