<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">
    <?php
        $conn = openCon();

        $name = "";
        $manifesto = "";
        $media_type;

        function uploadFile($login_id) {
            $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if ((($_FILES["file"]["type"] == "video/mp4")
            || ($_FILES["file"]["type"] == "image/jpeg"))
            && ($_FILES["file"]["size"] < 100000000)
            && in_array($extension, $allowedExts))
            {
                if ($_FILES["file"]["error"] > 0)
                {
                    echo '<script>console.log("Error", '. json_encode(isset( $_FILES["file"]["error"])) .')</script>';
                }
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],"../../assets/img/manifestoMedia/". $login_id . "." . $extension);
                    return $login_id . "." . $extension;
                }
            } else {
                echo '<script>console.log("File error")</script>';
            }
        }

        if(isset($_POST['manifesto'])) {
            $manifesto = $_POST['manifesto'];
            if(isset($_FILES["file"]) && $_FILES["file"]["name"] != "") {
                $name = uploadFile($login_id);
                $media_type = $_FILES['file']['type'];
                $sql = "UPDATE Candidates SET manifesto = '$manifesto', manifestoMedia = '$name', mediaType = '$media_type' WHERE candidateID = $login_id";
            } else {
                $sql = "UPDATE Candidates SET manifesto = '$manifesto' WHERE candidateID = $login_id";
            }
            $result = $conn->query($sql);
            if($result) {
                echo '<script type="text/javascript">location.href = "../../views/user/manifesto.php";</script>';
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Manifesto</h6>
                    </div>
                    <div class="card-body">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Manifesto</h1>
                            </div>
                            <form class="user" enctype="multipart/form-data" method="POST">

                                <div class="form-group">
                                    <textarea rows="5" type="text" class="form-control" id="exampleInputEmail"
                                    name="manifesto" placeholder=""><?php echo $candidate['manifesto']; ?></textarea>
                                    <input style="margin-top: 10px;" type="file" name="file" id="file" /> 
                                </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Add Manifesto
                                    </button>
                            </form>
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