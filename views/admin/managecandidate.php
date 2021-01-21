<?php include '../../config/init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "../../views/layout/head.php"; ?>
<body id="page-top">

    <!-- TODO: ENGINE - Select all data from table candidates. Display balik kat table. Action for edit, delete, searching  -->
    <div id="wrapper">
        <?php include "../../views/layout/sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "../../views/layout/topbar.php"; ?>
                <div class="container-fluid">
                    
                    <!-- Magic Happens Here -->

                    <div class="container-fluid mt--6">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                <div class="card-header border-0">
                                        <div class="row">
                                            <!-- <div class="col-sm">
                                                <a href="../../views/product/product.php">
                                                    <button type="button" class="btn float-left"> 
                                                        View All Products
                                                    </button>
                                                </a>
                                                <a href="../../views/product/registerproduct.php">
                                                    <button class="btn float-left"> 
                                                        Add New Product
                                                    </button>
                                                </a>
                                            </div> -->
                                            <!-- Search form -->
                                            <form action="product.php" class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="GET">
                                                <div class="form-group mb-0">
                                                    <div class="input-group input-group-alternative input-group-merge">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                        </div>
                                                        <input class="form-control" name="search" placeholder="Search" type="text" autocomplete="off">
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort" data-sort="name">Product ID</th>
                                                    <th scope="col" class="sort" data-sort="name">Product Image</th>
                                                    <th scope="col" class="sort" data-sort="name">Product Name</th>
                                                    <th scope="col" class="sort" data-sort="name">Product Cost</th>
                                                    <th scope="col" class="sort" data-sort="name">Product Price</th>
                                                    <th scope="col" class="sort" data-sort="name">Product Type</th>
                                                    <th scope="col" class="sort" data-sort="name">Quantity</th>
                                                    <th scope="col" class="sort" data-sort="name">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php foreach($val as $row):?>
                                                <tr>
                                                    <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo $row['prodid']; ?></span>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo '<img style="width: 80px" src="data:image;base64, '. base64_encode($row['prodimage']) .'">'?></span>
                                                        </div>
                                                    </div>
                                                    </th>
                                                    <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo $row['prodname']; ?></span>
                                                        </div>
                                                    </div>
                                                    </th>
                                                    <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo '<script>console.log('. json_encode($row['prodcost']) .')</script>'; echo $row['prodcost']; ?></span>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo $row['prodprice']; ?></span>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm"><?php echo $row['prodtype']; ?></span>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm" <?php if($row['prodquantity'] < 30) { echo 'style="color:red"'; }?>><?php echo $row['prodquantity']; ?></span>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="registerproduct.php?edit=<?=$row["prodid"]?>">Edit Product</a>
                                                        <a class="dropdown-item" href="product.php?delete=<?=$row["prodid"]?>">
                                                            Delete Product
                                                        </a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Card footer -->
                                    <div class="card-footer py-4">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                <?php 
                                                    if(isset($_GET["search"]) == true) {

                                                        $sql2="SELECT count(*) FROM product WHERE 
                                                        (prodid like '%$searching%'
                                                        or prodname like '%$searching%'
                                                        or prodcost like '%$searching%'
                                                        or prodprice like'%$searching%'
                                                        or prodtype like '%$searching%'
                                                        or prodquantity like '%$searching%')";

                                                    } else {
                                                        $sql2 = "SELECT count(*) FROM product";
                                                    }
                                                    $result = $conn->query($sql2);
                                                    $pagination = $result->fetch_row();
                                                    echo "<script>console.log('" . json_encode($pagination) . "');</script>";
                                                    $count = ceil($pagination[0]/4);
                                                    for($pageno=1; $pageno<=$count; $pageno++) {
                                                ?>
                                                <li class="page-item <?php if($_GET["page"] == null) $_GET["page"] = 1; if($_GET["page"] == $pageno) echo "active";?>">
                                                    <a class="page-link" href="product.php?page=<?=$pageno;?>"><?=$pageno;?></a>
                                                </li>         
                                                <?php } CloseCon($conn); ?>
                                            </ul>
                                        </nav>
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
