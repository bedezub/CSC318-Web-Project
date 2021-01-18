<?php include '../../config/conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/regstyles.css">
    <title>UiTM Voting System</title>
</head>
<body>
<?php 
        echo '<script>console.log('. json_encode($_POST) .')</script>';
        if(isset($_POST["email"])) {
            if($_POST['password'] == $_POST['confirmPassword']) {
                $conn = OpenCon();

                $email = $_POST['email'];
                $name = $_POST['name'];
                $studentID = $_POST['studentID'];
                $userType = $_POST['userType'];
                $faculty = $_POST['faculty'];
                $password = $_POST['password'];

                if($userType == "voter") {
                    $add = "INSERT INTO Users (studentID, email, username, userpassword, isAttend, userType, faculty)
                    VALUES ('$studentID', '$email', '$name', '$password', 0, '$userType', '$faculty')";    
                } else {
                    $add = "INSERT INTO Candidates (candidateID, email, username, userpassword, profilePicture, userType, faculty, manifesto)
                    VALUES ('$studentID', '$email', '$name', '$password', '', '$userType', '$faculty', '')";  
                }   

                if(mysqli_query($conn,$add)) {
                    echo '<script>console.log("Registration successful")</script>';
                } else {
                    echo '<script>console.log('. json_encode(mysqli_error($conn)) .')</script>';
                }

            } else {
                echo "Your Login Name or Password is Invalid";
            }
                CloseCon($conn);
        } 
    ?>
    <div class="container">
        <div class="header">
            <h2>Create Account</h2>
        </div>
        <form id="form" class="form" method="POST">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" placeholder="" id="email" name="email"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="name">Name</label>
                <input type="name" placeholder="" id="name" name="name"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="studentid">Student ID</label>
                <input type="text" placeholder="" id="studentid" name="studentID"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="userType">Student Type</label>
                <select type="password" id="userType" name="userType">
                    <option value="voter">Voter</option>
                    <option value="candidate">Candidate</option>
                </select>
            </div>
            <div>
                <label for="faculty">Faculty</label><br>
                <div style="margin-top: 10px;">
                    <input type="radio" id="fskm" name="faculty" value="fskm">
                    <label for="fskm">Fakulti Sains Komputer dan Matematik</label><br>
                </div>
                <div style="margin-top: 10px;">
                    <input type="radio" id="fpa" name="faculty" value="fpa">
                    <label for="fpa">Fakulti Perladangan dan Agroteknologi</label><br>
                </div>
            </div>

            <div class="form-control" style="margin-top: 10px;">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="password2">Confirm Password</label>
                <input type="password" placeholder="Confirm password" id="password2" name="confirmPassword"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="acc-exist-wrapper">
                <p class="acc-exist">Already have an account? <a href="../login/login.php">Click here</a></p>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <!-- TODO: Make this one functional -->
    <!-- <script src="../assets/js/regscript.js"></script> -->
</body>
</html>