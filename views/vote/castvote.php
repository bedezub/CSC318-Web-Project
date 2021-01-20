<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();
        $candidates = [];

        if(isset($_POST['candidateID'])) {
            $voteid = date("yy").rand(100,999);
            $candidateID = $_POST['candidateID'];
            $sql  = "INSERT INTO Vote (voteID, studentID, candidateID) VALUES ($voteid, $login_id, $candidateID)";
            $result = $conn->query($sql);

            if($result) {
                echo '<script type="text/javascript">location.href = "../../views/home/home.php";</script>';
            }
        }

        $sql  = "SELECT * FROM Candidates ";
            //WHERE faculty = (SELECT faculty FROM Users WHERE studentID = $login_id)";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($val = $result->fetch_assoc()) {
                array_push($candidates, $val);
            }
        }
    ?>

    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <form class="user" method="POST">
                <div class="container-fluid">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <?php foreach ($candidates as $candidate) { ?>
                                        <div class="col-lg-4" height="40%">
                                            <div class="p-5">
                                                <div class="card shadow mb-4" >
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $candidate['username'] ." - ". $candidate["candidateID"] ;?></h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                        <?php if($candidate['profilePicture'] != "") { ?>
                                                            <img 
                                                                src="../../assets/img/profilePicture/<?php echo $candidate['profilePicture']; ?>"
                                                                style="background-position: center; background-size: cover;"
                                                                width="200px" height="100%"
                                                                >
                                                            <?php } ?>
                                                        </div>
                                                        <p style="white-space: pre-wrap; margin-top: 20px;"><?php echo $candidate['manifesto']; //$manifesto; ?></p>
                                                    </div>
                                                        <div class="card-body text-center" style="padding-top: 0px;">
                                                            <input type="checkbox" value="<?php echo $candidate['candidateID']; ?>" name="candidateID">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>                            
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Submit vote
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php include '../../views/layout/footer.php'?>
        </div>
    </div>
    <?php include '../../views/layout/scrollTop.php'?>
    <?php include '../../views/layout/modal.php'?>
    <?php include '../../views/layout/javascript.php'?>
</body>
</html>