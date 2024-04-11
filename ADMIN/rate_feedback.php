<?php
session_start();
include("dbConn.php");
if(isset($_SESSION['userName'])){ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Volunify - Dashboard Home</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="./">Volunify Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fa-brands fa-elementor"></i></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" >
                <div class="input-group" hidden>
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">  
                    <?php include('nav.php'); ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['userName'];  ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <h5 class="breadcrumb-item active mt-4">Rating & Feedback</h5>
                    </ol>
                    <div class="container">
                    <div class="card mb-4">
                            <div class="card-header">
                            <i class="fa-solid fa-star-half-stroke"></i>
                                Rating & Feedback
                            </div>
                        <div class="card-body">
                            <form action="save_rate_feedback.php" method="post">
                            <div class="row">                                        
                                <div class="col-md-12 mb-1">
                                    <label>Rate User</label>
                                    <select id="RatedUserID" name="RatedUserID" class="form-select" required>
                                    <?php
                                    $UID = $_SESSION['uID'];
                                    // Get images from the database
                                    $query = $db->query("SELECT user.USERNAME, user.USERID, role.R_NAME FROM user, role WHERE `USERID`!= $UID AND `USERTYPE` != 1 AND  user.USERTYPE = role.R_ID;");
                                    if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){								
                                    ?>
                                        <option value="<?php echo $row['USERID'];?>" ><?php echo $row['USERID'];?> - <?php echo $row['USERNAME'];?>(<?php echo $row['R_NAME'];?>) </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label>Rate By User</label>
                                    <input class="form-control" type="text" value="<?php echo $_SESSION['userName'];  ?>" readonly>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label>Rate Service</label>
                                    <select class="form-control" name="RatingValue">
                                        <option value="1star">1 - Poor</option>
                                        <option value="2stars">2 - Below Average</option>
                                        <option value="3stars">3 - Average </option>
                                        <option value="4stars">4 - Above Average </option>
                                        <option value="5stars">5 - Excellent </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label>Write your feedback.</label>
                                    <textarea class="form-control" name="feedback" > </textarea>
                                </div>
                                <div class="col-md-12 mb-1">
                                <button class="btn btn-success container" type="submit" name="saverate">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php if(isset($_SESSION['role'])){
                    $role=$_SESSION['role']; }
                    switch($role){ 
                    case "Admin" ?>
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Manage Rating
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                        <th>RATE ID </th>
                                            <th>RatedUserID</th>
                                            <th>RatedByUserID</th>
                                            <th>RatingValue</th>
                                            <th>Comments</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>RATE ID </th>
                                            <th>RatedUserID</th>
                                            <th>RatedByUserID</th>
                                            <th>RatingValue</th>
                                            <th>Comments</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php								
                                    // Get images from the database
                                    $query = $db->query("SELECT USER.USERNAME, rating.RatedByUserID, rating.RAT_ID, rating.RatingValue, rating.Timestamp, rating.Comments FROM rating, user WHERE rating.RatedUserID = user.USERID ORDER BY `RAT_ID` DESC");
                                    if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){								
                                    ?>	
                                        <tr>
                                            <td><?php echo $row['RAT_ID'];?></td>
                                            <td><?php echo $row['USERNAME'];?></td>
                                            <td><?php echo $row['RatedByUserID'];?></td>
                                            <td><?php echo $row['RatingValue'];?></td>
                                            <td><?php echo $row['Comments'];?></td>
                                            <td><?php echo $row['Timestamp'];?></td>
                                        </tr>
                                    <?php } }else{?>
                                        <p>No Record's Found</p>
                                    <?php	}  ?>    
                                    </tbody>
                                </table>
                            </div>
                    <?php ;break; } ?>
                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php }else { ?>
<script>
alert('Please Login');
	window.location="../login.html";
</script>
<?php } ?>