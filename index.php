<?php
session_start();

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = htmlspecialchars($_POST['first_name']);
    $last  = htmlspecialchars($_POST['last_name']);
    $fullName = $first . " " . $last;

    // Store message in session
    $_SESSION['toastr_message'] = "Hello, $fullName!";
    $_SESSION['toastr_title'] = "Welcome!";

    // Redirect to same page to prevent resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Toastr with Bootstrap</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 text-primary">Enter Your Name</h3>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ✅ JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // ✅ Toastr basic setup
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
        <?php
        // ✅ If there’s a toastr message in session, show it
        if (isset($_SESSION['toastr_message'])) {
            $msg = $_SESSION['toastr_message'];
            $title = $_SESSION['toastr_title'];
            echo "toastr.success('$msg', '$title');";

            // Clear session variables after showing
            unset($_SESSION['toastr_message']);
            unset($_SESSION['toastr_title']);
        }
        ?>
    </script>

</body>

</html>