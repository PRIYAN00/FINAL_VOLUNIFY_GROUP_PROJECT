<?php
session_start();
include("dbConn.php");
if(isset($_SESSION['userName'])){ 
if(isset($_SESSION['role'])){
    $role=$_SESSION['role']; }
    switch($role){
    case "Admin" ?>
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
                            <h5 class="breadcrumb-item active mt-4">Manage Event's</h5>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-calendar-plus"></i>
                                Add Event
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                <form action="saveevent.php" method="post">
                                    <div class="row">
                                    
                                        <div class="col-md-4 mb-1">
                                            <label>Event Title </label>
                                            <input class="form-control" type="text" name="EVENT_T" required>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Location </label>
                                            <input class="form-control" type="text" name="EVENT_L" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Date</label>
                                            <input class="form-control" type="date" name="EVENT_DATE" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Event Start Time</label>
                                            <input class="form-control" type="time" name="EVENT_S_TIME" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Event End Time</label>
                                            <input class="form-control" type="time" name="EVENT_E_TIME" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Organizer</label>
                                            <input class="form-control" type="text" value="<?php echo $_SESSION['userName'];  ?>"  readonly>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <label>Description</label>
                                            <input class="form-control" type="text" name="EVENT_DES" require>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <button class="btn btn-success" type="submit" name="saveevent">Add Event</button>
                                        </div>
                                    
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- Start User -->                  
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-calendar-days"></i>
                                Manage Event's
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>EventID  </th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>OrganizerID </th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>EventID  </th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Organizer</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php								
                                    // Get images from the database
                                    $query = $db->query("SELECT event.EVENT_ID, event.TITLE, event.DESCRIPTION, event.LOCATION, event.DATE, event.START_TIME, event.END_TIME, user.USERNAME FROM user, event WHERE event.ORG_ID = user.USERID ORDER BY event.EVENT_ID DESC; ");
                                    if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){								
                                    ?>
                                        <tr>
                                            <td><?php echo $row['EVENT_ID'];?></td>
                                            <td><?php echo $row['TITLE'];?></td>
                                            <td><?php echo $row['DESCRIPTION'];?></td>
                                            <td><?php echo $row['LOCATION'];?></td>
                                            <td><?php echo $row['DATE'];?></td>
                                            <td><?php echo $row['START_TIME'];?> - <?php echo $row['END_TIME'];?></td>
                                            <td><?php echo $row['USERNAME'];?></td>
                                            <td><a class="btn btn-danger">Delete</a></td>
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
<?php ;break;	case "Organization" ?>
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
                            <h5 class="breadcrumb-item active mt-4">Manage Event's</h5>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-calendar-plus"></i>
                                Add Event
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                <form action="saveevent.php" method="post">
                                    <div class="row">
                                    
                                        <div class="col-md-4 mb-1">
                                            <label>Event Title </label>
                                            <input class="form-control" type="text" name="EVENT_T" required>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Location </label>
                                            <input class="form-control" type="text" name="EVENT_L" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Date</label>
                                            <input class="form-control" type="date" name="EVENT_DATE" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Event Start Time</label>
                                            <input class="form-control" type="time" name="EVENT_S_TIME" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Event End Time</label>
                                            <input class="form-control" type="time" name="EVENT_E_TIME" require>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label>Organizer</label>
                                            <input class="form-control" type="text" value="<?php echo $_SESSION['userName'];  ?>"  readonly>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <label>Description</label>
                                            <input class="form-control" type="text" name="EVENT_DES" require>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <button class="btn btn-success" type="submit" name="saveevent">Add Event</button>
                                        </div>
                                    
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- Start User -->                  
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-calendar-days"></i>
                                Manage Event's
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>EventID  </th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>OrganizerID </th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>EventID  </th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Organizer</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php	
                                    $UID = $_SESSION['uID'];							
                                    // Get images from the database
                                    $query = $db->query("SELECT event.EVENT_ID, event.TITLE, event.DESCRIPTION, event.LOCATION, event.DATE, event.START_TIME, event.END_TIME, user.USERNAME FROM user, event WHERE event.ORG_ID = user.USERID AND event.ORG_ID = $UID ORDER BY event.EVENT_ID DESC; ");
                                    if($query->num_rows > 0){
                                    while($row = $query->fetch_assoc()){								
                                    ?>
                                        <tr>
                                            <td><?php echo $row['EVENT_ID'];?></td>
                                            <td><?php echo $row['TITLE'];?></td>
                                            <td><?php echo $row['DESCRIPTION'];?></td>
                                            <td><?php echo $row['LOCATION'];?></td>
                                            <td><?php echo $row['DATE'];?></td>
                                            <td><?php echo $row['START_TIME'];?> - <?php echo $row['END_TIME'];?></td>
                                            <td><?php echo $row['USERNAME'];?></td>
                                            <td><a class="btn btn-danger">Delete</a></td>
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