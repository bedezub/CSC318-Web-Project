<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">

<?php 
        $conn = openCon();

        
        $sql  = "SELECT count(*) as registerFSKM FROM Users WHERE faculty='fskm'";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $numRegFSKM = $result->fetch_assoc();
        }

        $sql  = "SELECT count(*) as registerFPA FROM Users WHERE faculty='fpa'";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $numRegFPA = $result->fetch_assoc();
        }

        $sql  = "SELECT count(*) as total FROM Vote";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $totalVoters = $result->fetch_assoc();
        }

        $sql = "SELECT count(*) as attendance, username FROM Users 
        WHERE isAttend=0";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $attendance = $result->fetch_assoc();
        }

        $sql  = "SELECT * FROM Users WHERE isAttend=1";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $voteds[] = $result->fetch_assoc();
        }

        $sql  = "SELECT * FROM Users WHERE isAttend=0";
        $result = $conn->query($sql);
    
        if($result->num_rows > 0) {
            $pendings[] = $result->fetch_assoc();
        }
    ?>

    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                    
                    <!-- Magic Happens Here -->
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="download.php?file=result" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Number of Registered FSKM Student</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numRegFSKM['registerFSKM']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Number of Registered FPA Student</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numRegFPA['registerFPA']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Voters</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalVoters['total']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Number of Pending Voters</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $attendance['attendance']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List of Voted Students</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="voted" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>CandidateID</th>
                                                    <th>Email</th>
                                                    <th>Full Name</th>
                                                    <th>Faculty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($voteds as $voted) {?>
                                                    <td><?php echo $voted['studentID']; ?></td>
                                                    <td><?php echo $voted['email']; ?></td>
                                                    <td><?php echo $voted['username']; ?></td>
                                                    <td><?php echo $voted['faculty']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">List of Pending Students</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="pending" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>CandidateID</th>
                                                    <th>Email</th>
                                                    <th>Full Name</th>
                                                    <th>Faculty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pendings as $pending) {?>
                                                    <td><?php echo $pending['studentID']; ?></td>
                                                    <td><?php echo $pending['email']; ?></td>
                                                    <td><?php echo $pending['username']; ?></td>
                                                    <td><?php echo $pending['faculty']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<script>
    console.log('trigger');
            $(document).ready( function () {
                $('#voted').DataTable();
                $('#pending').DataTable();
            } );
</script>