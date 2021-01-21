<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">

    <?php
            $conn = OpenCon();
            $sql = "SELECT Candidates.username, count(vote.candidateID) as voteNum 
            FROM Vote 
            JOIN Candidates ON Vote.candidateID = Candidates.candidateID 
            GROUP BY Vote.candidateID";

            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<script>console.log("masuk sini", '. json_encode($row) .')</script>';
                }
            } 
            CloseCon($conn);
    ?>

    <!-- TODO: Kita ada nama Calon, Result. Buat UI untuk display results -->

    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                    
                    <!-- Magic Happens Here -->
                    <!-- Bar chart -> assests/js/demo/bar-chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>
                            <hr>
                            Styling for the bar chart can be found in the
                            <code>/js/demo/chart-bar-demo.js</code> file.
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
