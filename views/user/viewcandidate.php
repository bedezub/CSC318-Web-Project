<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();
        $candidates = [];

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
                <div class="container-fluid">
                <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <?php 
                                    echo '<script>console.log('. json_encode($candidates) .')</script>';
                                    foreach ($candidates as $candidate) { 
                                ?>
                                <div class="col-lg-4">
                                    <div class="p-5">
                                        <div class="card shadow mb-4">
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
                                                <a rel="nofollow" href="../user/viewmanifesto.php?candidateID=<?php echo $candidate['candidateID'] ?>">View manifesto &rarr;</a>
                                            </div>
                                        </div>
                                        <!-- <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Profile Details</h1>
                                        </div> -->
                                    </div>
                                </div>
                                <?php } ?>
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