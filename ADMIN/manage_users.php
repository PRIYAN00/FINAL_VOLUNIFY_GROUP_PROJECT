<?php
session_start();
include("dbConn.php");
if(isset($_SESSION['userName'])){
    if(isset($_SESSION['role'])){
        $role=$_SESSION['role']; }
        switch($role){
        case "Admin":
        case "Organization" ?>
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
                            <h5 class="breadcrumb-item active mt-4">Manage User's</h5>
                        </ol>
                    <!-- Start User -->                  
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Manage User's
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>UserID </th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Type</th>
                                            <th>Interests</th>
                                            <th>Abilities</th>
                                            <th>Registration Date</th>
                                            <?php if(isset($_SESSION['role'])){
                                            $role=$_SESSION['role']; }
                                            switch($role){ 
                                            case "Admin" ?>
                                            <th>Delete</th>
                                            <?php ;break; } ?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>UserID </th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Type</th>
                                            <th>Interests</th>
                                            <th>Abilities</th>
                                            <th>Registration Date</th>
                                            <?php if(isset($_SESSION['role'])){
                                            $role=$_SESSION['role']; }
                                            switch($role){ 
                                            case "Admin" ?>
                                            <th>Delete</th>
                                            <?php ;break; } ?>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php								
                                    // Get images from the database
                                    $query = $db->query("SELECT user.USERID, user.USERNAME, user.FULLNAME, user.EMAIL, user.LOCATION, role.R_NAME, user.INTEREST, user.ABILITY, user.TALENTS, user.CREDENTIAL, user.REG_DATE FROM user,role WHERE user.USERTYPE = role.R_ID ORDER BY user.USERID DESC;");
                                    if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){								
                                    ?>	
                                        <tr>
                                            <td><?php echo $row['USERID'];?></td>
                                            <td><?php echo $row['USERNAME'];?></td>
                                            <td><?php echo $row['EMAIL'];?></td>
                                            <td><?php echo $row['FULLNAME'];?></td>
                                            <td><?php echo $row['LOCATION'];?></td>
                                            <td><?php echo $row['R_NAME'];?></td>
                                            <td><?php echo $row['INTEREST'];?></td>
                                            <td><?php echo $row['ABILITY'];?></td>
                                            <td><?php echo $row['REG_DATE'];?></td>
                                            <?php if(isset($_SESSION['role'])){
                                            $role=$_SESSION['role']; }
                                            switch($role){ 
                                            case "Admin" ?>
                                            <td><a class="btn btn-danger">Delete</a></td>
                                            <?php ;break; } ?>
                                        </tr>
                                    <?php } }else{?>
                                        <p>No Record's Found</p>
                                    <?php	}  ?>    
                                    </tbody>
                                </table>
                            </div>
                    <!-- End User -->    
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
<?php ;break;	case "Volunteer" ?>
<script>
alert('Access Denied');
	window.location="event.php";
</script>
<?php ;break; } ?> 
<?php } else { ?>
<script>
alert('Please Login');
	window.location="../login.html";
</script>
<?php } ?>