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
                            <h5 class="breadcrumb-item active my-4">Upcoming Event's</h5>
                        </ol>
                        <!-- Start Event Calender -->
                        <section class="container">
                        <?php								
                        // Get images from the database
                        $query = $db->query("SELECT event.EVENT_ID, event.TITLE, event.DESCRIPTION, event.LOCATION, event.DATE, event.START_TIME, event.END_TIME, user.USERNAME FROM user, event WHERE event.ORG_ID = user.USERID AND event.DATE > CURRENT_DATE ORDER BY event.DATE DESC; ");
                        if($query->num_rows > 0){
                        while($row = $query->fetch_assoc()){								
                        ?>
                            <div class="row row-striped">
                                <div class="col-md-2 text-center">                                   
                                    <h1><span class="badge bg-dark"><?php echo date("j", strtotime($row['DATE']));?></span></h1>
                                    <h1><span class="badge text-uppercase text-black"><?php echo date("F", strtotime($row['DATE']));?></span></h1>
                                </div>
                                <div class="col-md-10">
                                    <h3 class="text-uppercase"><strong><?php echo $row['TITLE'];?></strong></h3>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa-regular fa-calendar"></i> <?php echo date("l", strtotime($row['DATE']));?> </li>
                                        <li class="list-inline-item"><i class="fa-regular fa-clock"></i> <?php echo $row['START_TIME'];?> - <?php echo $row['END_TIME'];?></li>
                                        <li class="list-inline-item"><i class="fa-solid fa-location-dot"></i> <?php echo $row['LOCATION'];?></li>
                                    </ul>
                                    <p><?php echo $row['DESCRIPTION'];?></p>
                                </div>
                            </div>   
                        <?php } }else{?>
                            <p>No Record's Found</p>
                        <?php	}  ?>                           
                        </section>
                        <!-- Start Event Calender -->
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