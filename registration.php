<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login-res.css">

    <title>Registration Form</title>
</head>
<body>

<div class="container">
    <?php
    if(isset($_POST["FirstName"])){
        $LastName = $_POST["LastName"];
        $FirstName = $_POST["FirstName"];
        $MiddleName = $_POST["MiddleName"];
        $Country = $_POST["country"];
        $Municipality = $_POST["province"];
        $City = $_POST["city_municipality"];
        $Barangay = $_POST["barangay"];
        $LotBlk = $_POST["lot_blk"];
        $Street = $_POST["street"];
        $Subdivision = $_POST["subdivision"];
        $ContactNumber = $_POST["contact_number"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $RepeatPassword = $_POST["repeat_password"];
        $errors = array();

        // Validate if all fields are empty
        if (empty($LastName) || empty($FirstName) || empty($MiddleName) || empty($Country) || empty($Municipality) || empty($City) || empty($Barangay) || empty($LotBlk) || empty($Street) || empty($Subdivision) || empty($ContactNumber) || empty($email) || empty($password) || empty($RepeatPassword)) {
            array_push($errors, "All fields are required");
        }
        // Validate if the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }
        // Password should not be less than 8 characters
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        // Check if passwords match
        if ($password != $RepeatPassword){
            array_push($errors, "Passwords do not match");
        }

        // Password hashing
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        require_once "database.php";

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCount = $result->num_rows;
        if ($rowCount > 0) {
            array_push($errors, "Email Already Exists!");
        }

        if (count($errors) > 0){
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users(LastName, FirstName, MiddleName, Country, Municipality, City, Barangay, LotBlk, Street, Subdivision, ContactNumber, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssss", $LastName, $FirstName, $MiddleName, $Country, $Municipality, $City, $Barangay, $LotBlk, $Street, $Subdivision, $ContactNumber, $email, $passwordHash);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
            } else {
                echo "<div class='alert alert-danger'>Registration failed. Please try again later.</div>";
            }
        }
    }
    ?>
    <h3>Registration form</h3>
    <h4>Fullname</h4>
    <form action="registration.php" method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="LastName">LastName</label>
                    <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Lastname" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="FirstName">FirstName</label>
                    <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="Firstname" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="MiddleName">MiddleName</label>
                    <input type="text" class="form-control" name="MiddleName" id="MiddleName" placeholder="Middle" required>
                </div>
            </div>
        </div>
        <!-- Country, State, City selection dropdowns -->
        <h4>Location</h4>
        <div class="form-group">
            <!-- Country -->
            <select id="countries" name="country" class="form-control" required>
                <option disabled selected>Select Country</option>
            </select>
        </div>

        <!-- Province -->
        <div class="form-group">
            <select id="provinces" name="province" class="form-control" required>
                <option disabled selected>Select Province</option>
            </select>
        </div>

        <!-- City/Municipality -->
        <div class="form-group">
            <select id="cities" name="city_municipality" class="form-control" required>
                <option disabled selected>Select City/Municipality</option>
            </select>
        </div>

        <!-- Barangay -->
        <div class="form-group">
            <select id="barangay" name="barangay" class="form-control" required>
                <option disabled selected>Select Barangay</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="lot_blk" id="lot_blk" placeholder="Lot/BLK" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="street" id="street" placeholder="Street" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="subdivision" id="subdivision" placeholder="Subdivision" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" required>
        </div>

        <!-- Other fields and dropdowns -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="**********" required>
        </div>
        <div class="form-group">
            <label for="repeat_password">Please Repeat Password</label>
            <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="**********" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Register Now!
                <span class="btn-icon"><i class="fas fa-user-plus"></i></span>
            </button>
        </div>

        <div>
            <p class="already-registered-text">Already Registered? <a href="login.php" class="already-registered-link">Login Here</a></p>
        </div>
    </form>

</div>

<script src="./js/intlTelInput.min.js"></script>
<script src="./js/country.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="./js/province_barangay_city.js"></script>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#contact_number");
        var iti = window.intlTelInput(input, {
            utilsScript: "./js/utils.js",
            separateDialCode: true,
        });

        // Event listener for handling changes in the input
        input.addEventListener("change", function() {
            // Check if the input value already contains the dial code
            if (!input.value.startsWith('+')) {
                var selectedCountryData = iti.getSelectedCountryData();
                var countryCode = selectedCountryData.dialCode;

                // Remove leading zeros
                input.value = input.value.replace(/^0+/, '');

                // Add the dial code only if it's not already present
                input.value = '+' + countryCode + input.value;
            }
        });
    });
</script> -->

</body>
</html>
