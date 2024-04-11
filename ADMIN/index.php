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
                        <h1 class="my-4">Welcome to Volunify Dashboard</h1>

                        <!--- Admin Dashboard --->
                        <section>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active mt-4"> Admin Dashboard</li>
                        </ol>                        
                        <div class="card  mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Event Details
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Condition</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Total No of Events Registered</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM event; ";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        <tr>
                                            <td>Total No of Upcoming Event's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM event WHERE `DATE` > CURRENT_DATE; ";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                        <div class="card  mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User Details
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Condition</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Total No of User's Registered</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM user WHERE USERTYPE != 1";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        <tr>
                                            <td>Total No of  Volunteer's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM user WHERE USERTYPE = 2";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        <tr>
                                            <td>Total No of Organization's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM user WHERE USERTYPE = 3 ";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  
                        <div class="card  mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Opportunity Details
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Condition</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Total No of Opportunity's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM vol_opp;";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        <tr>
                                            <td>Total No of Open Opportunity's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM vol_opp WHERE `STATUS` = 'Open'";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        <tr>
                                            <td>Total No of Cloed Opportunity's</td>
                                            <?php 
                                            $sql = "SELECT COUNT(*) AS row_count FROM vol_opp WHERE `STATUS` = 'Closed'";
                                            $result = $db->query($sql);
                                            if ($result) {
                                                $row = $result->fetch_assoc();
                                            ?>
                                            <td><?php echo $row["row_count"]; ?></td>
                                            <?php } else { 
                                                echo "Error: " . $conn->error;
                                            } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                           
                        </section>
                        <!--- Admin Dashboard --->
                        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
                        <?php echo $_SESSION['userName']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="my-4">Welcome to Volunify Dashboard</h1>
                        <!--- Volunteer Dashboard --->
                        <section>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active mt-4"> Volunteer Dashboard</li>
                        </ol>
                        <div class="row">
                        <div class="col-xl-3 col-md-4">
                                <div class="card bg-warning text-black fw-bolder text-uppercase mb-4">
                                <?php 
                                $VOLID = $_SESSION['uID'];
                                $sql = "SELECT COUNT(*) AS row_count FROM vol_reg WHERE VOL_ID = $VOLID";
                                $result = $db->query($sql);
                                if ($result) {
                                    $row = $result->fetch_assoc();
                                ?>
                                    <div class="card-body">Total no of Volunteer Opportunity Registered by <?php echo $_SESSION['userName']; ?> : <?php echo $row["row_count"]; ?></div>
                                    <?php } else { 
                                    echo "Error: " . $conn->error;
                                } ?>
                                </div>
                            </div>                          
                              
                        </div>
                        <div class="card  mb-4" >
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Opportunity Registered Details
                                <button id="generate-pdf" class="btn btn-primary float-end"> <i class="fa-solid fa-file-pdf"></i> Generate PDF</button>
                            </div>
                            <style>
                                #content {
                                    padding: 30px;
                                }
                            </style>
                            <div class="card-body" id="content">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>User Name</th>
                                            <th>TIME COMMITMENT</th>
                                            <th>Registered Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $VOLID = $_SESSION['uID'];
                                        $query = $db->query("SELECT vol_opp.TITLE, vol_opp.TYPE, vol_opp.TIME_COMMITMENT,vol_reg.REG_DATE, user.USERNAME FROM user, vol_reg, vol_opp WHERE vol_reg.OPP_ID = vol_opp.OPP_ID AND user.USERID = vol_reg.VOL_ID AND vol_reg.VOL_ID = $VOLID");
                                        if($query->num_rows > 0){
                                            while($row = $query->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $row["TITLE"]; ?></td>                                            
                                            <td><?php echo $row["TYPE"]; ?></td>                                           
                                            <td><?php echo $row["USERNAME"]; ?></td>                                           
                                            <td><?php echo $row["TIME_COMMITMENT"]; ?></td>                                           
                                            <td><?php echo $row["REG_DATE"]; ?></td>                                           
                                        </tr>                                        
                                        <?php } }else{?>
                                        <p>No Record's Found</p>
                                        <?php	}  ?>   
                                        </tbody>
                                        <script>
                                            document.getElementById('generate-pdf').addEventListener('click', () => {
                                                // Get content of the div
                                                const content = document.getElementById('content');

                                                // Convert div content to PDF
                                                html2pdf()
                                                    .from(content)
                                                    .save('<?php echo date("Ymdh:i:s A") ; ?> .pdf');
                                            });
                                        </script>
                                    </table>
                                </div>
                            </div>
                        </div> 
                            
                        </section>
                        <!--- Volunteer Dashboard --->
                        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
                    <h1 class="my-4">Welcome to Volunify Dashboard</h1>
                         <!--- Organization  Dashboard --->
                         <section>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active mt-4"> Organization Dashboard</li>
                        </ol>
                        <div class="row">  
                        <div class="col-xl-3 col-md-4">
                                <div class="card bg-warning text-black fw-bolder text-uppercase mb-4">
                                <?php 
                                $ORGID = $_SESSION['uID'];
                                $sql = "SELECT COUNT(*) AS row_count FROM event WHERE ORG_ID = $ORGID";
                                $result = $db->query($sql);
                                if ($result) {
                                    $row = $result->fetch_assoc();
                                ?>
                                    <div class="card-body">Total no. of. events : <?php echo $row["row_count"]; ?></div>
                                    <?php } else { 
                                    echo "Error: " . $conn->error;
                                } ?>
                                </div>
                            </div>                          
                            <div class="col-xl-3 col-md-4">
                                <div class="card bg-warning text-black fw-bolder text-uppercase mb-4">
                                <?php 
                                $ORGID = $_SESSION['uID'];
                                $sql = "SELECT COUNT(*) AS row_count FROM event WHERE `DATE` < CURRENT_DATE AND ORG_ID = $ORGID";
                                $result = $db->query($sql);
                                if ($result) {
                                    $row = $result->fetch_assoc();
                                ?>
                                    <div class="card-body">Total no. of. completed events : <?php echo $row["row_count"]; ?></div>
                                    <?php } else { 
                                    echo "Error: " . $conn->error;
                                } ?>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="card bg-warning text-black fw-bolder text-uppercase mb-4">
                                <?php 
                                $ORGID = $_SESSION['uID'];
                                $sql = "SELECT COUNT(*) AS row_count FROM event WHERE `DATE` > CURRENT_DATE AND ORG_ID = $ORGID";
                                $result = $db->query($sql);
                                if ($result) {
                                    $row = $result->fetch_assoc();
                                ?>
                                    <div class="card-body"> No. of upcoming events : <?php echo $row["row_count"]; ?></div>
                                <?php } else { 
                                    echo "Error: " . $conn->error;
                                } ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="card  mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Organization Details
                                <button id="generate-pdf2" class="btn btn-primary float-end"> <i class="fa-solid fa-file-pdf"></i> Generate PDF</button>
                            </div>
                            <style>
                                #content2 {
                                    padding: 30px;
                                }
                            </style>
                            <div class="card-body" id="content2">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>TIME COMMITMENT</th>
                                            <th>Registered User ID</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $query = $db->query("SELECT vo.TITLE, vo.TIME_COMMITMENT, GROUP_CONCAT(vr.VOL_ID) AS Requested_Volunteers FROM vol_opp vo JOIN vol_reg vr ON vo.OPP_ID = vr.OPP_ID GROUP BY vo.OPP_ID; ");
                                        if($query->num_rows > 0){
                                            while($row = $query->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $row["TITLE"]; ?></td>                                            
                                            <td><?php echo $row["TIME_COMMITMENT"]; ?></td>                                           
                                            <td><?php echo $row["Requested_Volunteers"]; ?></td>                                         
                                        </tr>
                                        <?php } }else{?>
                                        <p>No Record's Found</p>
                                        <?php	}  ?>
                                        </tbody>
                                        <script>
                                            document.getElementById('generate-pdf2').addEventListener('click', () => {
                                                // Get content of the div
                                                const content2 = document.getElementById('content2');

                                                // Convert div content to PDF
                                                html2pdf()
                                                    .from(content2)
                                                    .save('<?php echo date("Ymdh:i:s A") ; ?> .pdf');
                                            });
                                        </script>
                                    </table>
                                </div>
                            </div>
                        </div> 
                        </section>
                        <!--- Organization  Dashboard --->
                       
                        
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
<?php ;break; } ?> 
<?php }else { ?>
<script>
alert('Please Login');
	window.location="../login.html";
</script>
<?php } ?>