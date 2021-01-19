<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();
        if(isset($_POST['status'])) {

            if($_POST['status'] == "update") {
                echo '<script>console.log("masuk sini", '. json_encode(isset($_FILES['image'])) .')</script>';
                if($_POST['userpassword'] == $_POST['confirmpassword']) {
                    echo '<script>console.log("masuk dalam sini", '. json_encode($_POST) .')</script>';
                    $candidateID = $_POST['candidateID'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $userpassword = $_POST['userpassword'];
                    $sql = "UPDATE Candidates 
                    SET email = '$email', username = '$username', userpassword = $userpassword 
                    WHERE candidateID = $candidateID";
                    $result = $conn->query($sql);

                    if(isset($_FILES['image'])) {
                        $errors= array();
                        $file_name = $_FILES['image']['name'];
                        $file_size =$_FILES['image']['size'];
                        $file_tmp =$_FILES['image']['tmp_name'];
                        $file_type=$_FILES['image']['type'];
                        $file_format = explode('.', $_FILES['image']['name']);
                        $file_config = end($file_format);
                        $file_ext=strtolower($file_config);
                        $extensions = array("jpeg","jpg","png");

                        if(in_array($file_ext,$extensions)=== false){
                           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                        }
    
                        if($file_size > 2097152){
                           $errors[]='File size must be excately 2 MB';
                        }
    
                        if(empty($errors) == true) {
                            $name = $login_id . "-". time() . ".jpg";
                            move_uploaded_file($file_tmp,"../../assets/img/profilePicture/". $name);
                            $sql = "UPDATE Candidates 
                            SET profilePicture = '$name'
                            WHERE candidateID = $login_id";
                            $result = $conn->query($sql);
                        } else {
                           print_r($errors);
                        }
                    }
                } else {
                    echo '<script>console.log("Password not match", '. json_encode($_POST) .')</script>';
                }
            } else {
                echo '<script>console.log("Error?", '. json_encode($_POST) .')</script>';
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
                                <div class="col-lg-5 d-none d-lg-block .bg-profile-picture">
                                    <?php if($candidate['profilePicture'] != "") { ?>
                                    <img 
                                        src="../../assets/img/profilePicture/<?php echo $candidate['profilePicture']; ?>"
                                        style="background-position: center; background-size: cover;"
                                        width="500px" height="100%"
                                        >
                                    <?php } ?>
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Profile Details</h1>
                                        </div>
                                        <form class="user" enctype="multipart/form-data" method="POST">
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
                                            <div class="form-group roq">
                                                <input style="margin-left: 30%; margin-bottom: 3%;" type="file" name="image"/>
                                            </div>
                                            <input type="hidden" name="status" value="update">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Update Profile
                                            </button>
                                        </form>
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