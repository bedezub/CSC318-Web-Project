<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();
        if(isset($_POST['status'])) {
            if($_POST['status'] == "update") {
                echo '<script>console.log("masuk sini", '. json_encode($_POST) .')</script>';
                if($_POST['userpassword'] == $_POST['confirmpassword']) {
                    $candidateID = $_POST['candidateID'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $userpassword = $_POST['userpassword'];
                    $sql = "UPDATE Candidates 
                    SET email = '$email', username = '$username', userpassword = $userpassword 
                    WHERE candidateID = $candidateID";
                    $result = $conn->query($sql);
                } else {
                    echo '<script>console.log("Password not match", '. json_encode($_POST) .')</script>';
                }
            } 
        }

        $sql  = "SELECT * FROM Candidates WHERE CandidateID = $login_id";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $candidate = $result->fetch_assoc();
        }

        if($candidate['faculty'] == "fskm") {
            $faculty = "Fakulti Sains Komputer dan Matematik";
        } else {
            $faculty = "Fakulti Perladangan dan Agroteknologi";
        }
    ?>
    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Profile Details</h1>
                                        </div>
                                        <form class="user" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                                        name="candidateID" value="<?php echo $candidate['candidateID']; ?>" placeholder="Student ID" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                                                        name="userType" value="<?php echo $candidate['userType']; ?>" placeholder="User Type" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                                name="username" value="<?php echo $candidate['username']; ?>"placeholder="Full Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                                name="email" value="<?php echo $candidate['email']; ?>"placeholder="Email Address">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user"
                                                    name="userpassword" value="<?php echo $candidate['userpassword']; ?>" id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user"
                                                    name="confirmpassword" value="<?php echo $candidate['userpassword']; ?>" id="exampleInputPassword" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="faculty" value="<?php echo $faculty; ?>" id="exampleRepeatPassword" placeholder="faculty" readonly>
                                            </div>
                                            <input type="hidden" name="status" value="update">
                                            <button type="sumbit" class="btn btn-primary btn-user btn-block">
                                                Update Profile
                                            </button>
                                        </form>
                                        <!-- <a href="login.html" class="btn btn-success btn-user btn-block">
                                            Add Profile Picture
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include '../../views/layout/footer.php'?>
        </div>
    </div>
    <?php include '../../views/layout/scrollTop.php'?>
    <?php include '../../views/layout/modal.php'?>
    <?php include '../../views/layout/javascript.php'?>
</body>
</html>