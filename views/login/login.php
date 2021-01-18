<?php include '../../config/conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/loginstyles.css">
    <title>UiTM Voting System</title>
</head>
<body>
    <?php
        echo '<script>console.log('. json_encode($_POST) .')</script>';
        if(isset($_POST["studentID"])) {
            $conn = OpenCon();
            session_start();
                        
            $studentID = $_POST["studentID"];
            $sql = "SELECT * FROM Users WHERE studentID = $studentID";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['login_user'] = $studentID;
                    $_SESSION['user_type'] = $row['userType'];
                    header("location: ../home/home.php");
                }
            } else {
                $sql = "SELECT * FROM Candidates WHERE candidateID = $studentID";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<script>console.log("masuk sini", '. json_encode($row) .')</script>';
                        $_SESSION['login_user'] = $studentID;
                        $_SESSION['user_type'] = $row['userType'];
                        header("location: ../home/home.php");
                    }
                } else {
                    echo "Your Login Name or Password is Invalid";
                }
            }
            CloseCon($conn);
        }
    ?>
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <form id="form" class="form" method="POST">
            <div class="form-control">
                <label for="username">Student ID</label>
                <input type="text" placeholder="" id="studentID" name="studentID"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Password</label>
                <input type="password" placeholder="" id="password"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="acc-exist-wrapper">
                <p class="acc-exist">
                    <a href="../register/registration.php">Register an account</a>
                </p>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>