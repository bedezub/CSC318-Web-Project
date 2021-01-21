<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">

    <!-- TODO: ENGINE - Select all data from table candidates. Display balik kat table. Action for edit, delete, searching  -->

    <?php

            $conn = OpenCon();

            if(isset($_GET['delete'])) {
                $candidateID = $_GET['delete'];
                $sql = "DELETE FROM Candidates WHERE candidateID='$candidateID' ";
                $result = $conn->query($sql);

                if($result) {

                } else {

                }
            }

            $sql = "SELECT *
            FROM Candidates ";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // echo '<script>console.log("masuk sini", '. json_encode($row) .')</script>';
                    $candidates[] = $row;
                }
            } 
            CloseCon($conn);
    ?>

    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                    
                    <!-- Magic Happens Here -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Candidates</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CandidateID</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Faculty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($candidates as $candidate) {?>
                                            <td><?php echo $candidate['candidateID']; ?></td>
                                            <td><?php echo $candidate['email']; ?></td>
                                            <td><?php echo $candidate['username']; ?></td>
                                            <td><?php echo $candidate['faculty']; ?></td>
                                            <td><a href="managecandidate.php?delete=<?php echo $candidate['candidateID']; ?>">Delete</a> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
<script>
    console.log('trigger');
            $(document).ready( function () {
                $('#dataTable').DataTable();
            } );
</script>