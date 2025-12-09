<?php
// ---------- PHP: Handle Form Submission ----------
$submitted = false;
$errors = [];
$data = [
    "full_name" => "",
    "email" => "",
    "phone" => "",
    "dob" => "",
    "gender" => "",
    "course" => "",
    "address" => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get values
    foreach ($data as $key => $value) {
        if (isset($_POST[$key])) {
            $data[$key] = trim($_POST[$key]);
        }
    }

    // Simple server-side validation
    if ($data["full_name"] === "") $errors["full_name"] = "Full Name is required.";
    if ($data["email"] === "") $errors["email"] = "Email is required.";
    if ($data["phone"] === "") $errors["phone"] = "Phone Number is required.";
    if ($data["dob"] === "") $errors["dob"] = "Date of Birth is required.";
    if ($data["gender"] === "") $errors["gender"] = "Gender is required.";
    if ($data["course"] === "") $errors["course"] = "Course is required.";
    if ($data["address"] === "") $errors["address"] = "Address is required.";

    if (empty($errors)) {
        $submitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Registration Form</title>

    <!-- Basic CSS styling -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 220px;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-group:last-child {
            margin-right: 0;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 4px;
        }

        .radio-group label {
            font-weight: normal;
        }

        .btn-submit {
            display: block;
            width: 200px;
            margin: 20px auto 0;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #0056b3;
        }

        .error-msg {
            color: #d40000;
            font-size: 12px;
            margin-top: 2px;
        }

        .success-box {
            margin-top: 25px;
            padding: 15px 20px;
            border-radius: 6px;
            background: #e8f8ec;
            border: 1px solid #3bb273;
        }

        .success-box h2 {
            margin-top: 0;
            color: #2f7d4a;
        }

        .success-details p {
            margin: 6px 0;
            line-height: 1.6;
        }

        .label-bold {
            font-weight: bold;
            color: #333;
        }

        .error-list {
            background: #ffe9e9;
            color: #a10000;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #ffb3b3;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
            .form-group {
                margin-right: 0;
            }
        }
    </style>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- JavaScript + jQuery -->
    <script>
        $(document).ready(function () {
            // Client-side validation using jQuery
            $("#regForm").on("submit", function (e) {
                let valid = true;
                $(".error-msg").text(""); // clear previous errors

                if ($("#full_name").val().trim() === "") {
                    $("#err_full_name").text("Full Name is required.");
                    valid = false;
                }

                if ($("#email").val().trim() === "") {
                    $("#err_email").text("Email is required.");
                    valid = false;
                }

                if ($("#phone").val().trim() === "") {
                    $("#err_phone").text("Phone Number is required.");
                    valid = false;
                }

                if ($("#dob").val().trim() === "") {
                    $("#err_dob").text("Date of Birth is required.");
                    valid = false;
                }

                if ($("input[name='gender']:checked").length === 0) {
                    $("#err_gender").text("Please select gender.");
                    valid = false;
                }

                if ($("#course").val().trim() === "") {
                    $("#err_course").text("Please select a course.");
                    valid = false;
                }

                if ($("#address").val().trim() === "") {
                    $("#err_address").text("Address is required.");
                    valid = false;
                }

                // If not valid, prevent form from submitting to PHP
                if (!valid) {
                    e.preventDefault();
                    $("html, body").animate({scrollTop: 0}, "slow");
                }
            });

            // If PHP says submitted successfully, animate the result box
            <?php if ($submitted): ?>
            $(".success-box").hide().fadeIn(800);
            <?php endif; ?>
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Online Registration Form</h1>

    <!-- Show server-side errors if any -->
    <?php if (!empty($errors)) : ?>
        <div class="error-list">
            <strong>Please fix the following errors:</strong>
            <ul>
                <?php foreach ($errors as $msg) : ?>
                    <li><?php echo htmlspecialchars($msg); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form id="regForm" method="post" action="">
        <div class="form-row">
            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" id="full_name" name="full_name"
                       value="<?php echo htmlspecialchars($data['full_name']); ?>">
                <div class="error-msg" id="err_full_name"></div>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email"
                       value="<?php echo htmlspecialchars($data['email']); ?>">
                <div class="error-msg" id="err_email"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="text" id="phone" name="phone"
                       value="<?php echo htmlspecialchars($data['phone']); ?>">
                <div class="error-msg" id="err_phone"></div>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth *</label>
                <input type="date" id="dob" name="dob"
                       value="<?php echo htmlspecialchars($data['dob']); ?>">
                <div class="error-msg" id="err_dob"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Gender *</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="gender" value="Male"
                            <?php if ($data['gender'] === "Male") echo "checked"; ?>>
                        Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Female"
                            <?php if ($data['gender'] === "Female") echo "checked"; ?>>
                        Female
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Other"
                            <?php if ($data['gender'] === "Other") echo "checked"; ?>>
                        Other
                    </label>
                </div>
                <div class="error-msg" id="err_gender"></div>
            </div>

            <div class="form-group">
                <label for="course">Course Applying For *</label>
                <select id="course" name="course">
                    <option value="">-- Select Course --</option>
                    <option value="B.E Computer Science"
                        <?php if ($data['course'] === "B.E Computer Science") echo "selected"; ?>>
                        B.E Computer Science
                    </option>
                    <option value="B.E Electronics"
                        <?php if ($data['course'] === "B.E Electronics") echo "selected"; ?>>
                        B.E Electronics
                    </option>
                    <option value="B.E Mechanical"
                        <?php if ($data['course'] === "B.E Mechanical") echo "selected"; ?>>
                        B.E Mechanical
                    </option>
                    <option value="BCA"
                        <?php if ($data['course'] === "BCA") echo "selected"; ?>>
                        BCA
                    </option>
                    <option value="B.Sc IT"
                        <?php if ($data['course'] === "B.Sc IT") echo "selected"; ?>>
                        B.Sc IT
                    </option>
                </select>
                <div class="error-msg" id="err_course"></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" style="flex: 1;">
                <label for="address">Address *</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($data['address']); ?></textarea>
                <div class="error-msg" id="err_address"></div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Submit Application</button>
    </form>

    <!-- Display formatted data on successful submission -->
    <?php if ($submitted) : ?>
        <div class="success-box">
            <h2>Application Submitted Successfully!</h2>
            <div class="success-details">
                <p><span class="label-bold">Full Name:</span>
                    <?php echo htmlspecialchars($data['full_name']); ?></p>
                <p><span class="label-bold">Email:</span>
                    <?php echo htmlspecialchars($data['email']); ?></p>
                <p><span class="label-bold">Phone Number:</span>
                    <?php echo htmlspecialchars($data['phone']); ?></p>
                <p><span class="label-bold">Date of Birth:</span>
                    <?php echo htmlspecialchars($data['dob']); ?></p>
                <p><span class="label-bold">Gender:</span>
                    <?php echo htmlspecialchars($data['gender']); ?></p>
                <p><span class="label-bold">Course Applied For:</span>
                    <?php echo htmlspecialchars($data['course']); ?></p>
                <p><span class="label-bold">Address:</span><br>
                    <?php echo nl2br(htmlspecialchars($data['address'])); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
