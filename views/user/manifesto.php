<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();
        $sql  = "SELECT * FROM Candidates WHERE CandidateID = $login_id";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $candidate = $result->fetch_assoc();
            $media_type = $candidate['mediaType'];
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Manifesto</h6>
                    </div>
                    <?php if($candidate['mediaType'] == "image/jpeg") {
                        echo '<script>console.log("masuk sini", '. json_encode($candidate['mediaType']) .')</script>';
                        ?>
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="../../assets/img/manifestoMedia/<?php echo $candidate['manifestoMedia']; ?>">
                    </div>
                    <?php } else { ?>
                        <div class="text-center">
                        <video controls>
                              <source src="../../assets/img/manifestoMedia/<?php echo $candidate['manifestoMedia'];?>" type="video/mp4">
                            </video> 
                        </div>
                    <?php } ?>
                    <div class="card-body">
                    <?php if($candidate['manifesto'] != "") { ?>
                            <p style="white-space: pre-wrap"><?php echo $candidate['manifesto']; //$manifesto; ?></p>
                            <a rel="nofollow" href="../user/editmanifesto.php?edit=true">Edit manifesto &rarr;</a>
                        <?php } else { ?>
                            <p>Please add your manifesto in order to increase the chance to win</p>
                            <a rel="nofollow" href="../user/editmanifesto.php?add=true">Add manifesto &rarr;</a>
                        <?php } ?>
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