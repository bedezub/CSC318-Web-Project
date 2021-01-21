<?php include '../../config/init.php'; ?>

<?php
 
 $conn = OpenCon();
 $sql = "SELECT Candidates.username, count(vote.candidateID) as voteNum 
 FROM Vote 
 JOIN Candidates ON Vote.candidateID = Candidates.candidateID 
 GROUP BY Vote.candidateID";
 $result = $conn->query($sql);
 if($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
         $voteResults[] = $row; 
     }
 } 
CloseCon($conn);

$dataPoints = [];
foreach($voteResults as $voteResult) {
    array_push($dataPoints, array("label"=> $voteResult['username'], "y"=> (int)$voteResult['voteNum']));
}

echo '<script>console.log("masuk sini", '. json_encode($dataPoints) .')</script>';

// $dataPoints = array(
//     array("label"=> "Education", "y"=> 284935),
//     array("label"=> "Entertainment", "y"=> 256548),
//     array("label"=> "Lifestyle", "y"=> 245214),
//     array("label"=> "Business", "y"=> 233464),
//     array("label"=> "Music & Audio", "y"=> 200285),
//     array("label"=> "Personalization", "y"=> 194422),
//     array("label"=> "Tools", "y"=> 180337),
//     array("label"=> "Books & Reference", "y"=> 172340),
//     array("label"=> "Travel & Local", "y"=> 118187),
//     array("label"=> "Puzzle", "y"=> 107530)
// );

// echo '<script>console.log("masuk sini", '. json_encode($dataPoints) .')</script>';
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UiTM Voting System</title>

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link href="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script>
    window.onload = function () {
 
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "Vote Results"
        },
        axisY: {
            title: "Number of Votes"
        },
        data: [{
            type: "column",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
 
    }
    </script>
</head>

<body id="page-top">

    <!-- TODO: Kita ada nama Calon, Result. Buat UI untuk display results -->
    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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