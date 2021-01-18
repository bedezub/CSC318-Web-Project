<?php 
    $conn1 = OpenCon();
    session_start();

    $user_check = $_SESSION['login_user'];
    $user_type = $_SESSION['user_type'];
    
    if($user_type == 'voter' || $user_type == 'admin') {
        $sql = "SELECT * FROM Users WHERE studentID = $user_check";
    } else {
        $sql = "SELECT * FROM Candidates WHERE candidateID = $user_check";
    }
    $result = $conn1->query($sql);
    //echo '<script>console.log("masuk sini", '. json_encode($result) .')</script>';
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($user_type == 'voter' ) {
                $login_id = $row['studentID'];
                $login_name = $row['username'];
            } else {
                $login_id = $row['candidateID'];
                $login_name = $row['username'];
            }
        }
    } else {
        header("location: ../../views/login/login.php"); 
        die();
    }

    CloseCon($conn1);
?>