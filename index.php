<?php include("controller/config.php");
session_start();
$session_id = $_SESSION['id_user']; 

if( isset($session_id) ){

    // ambil id dari query string
    $session_id_user = $_SESSION['id_user'];
    $id = $_GET['id_user'];


    // buat query hapus
    $sql = "SELECT * FROM SIM_USER Where id_user=$session_id_user";
    $sql_rows = mysqli_query($db, "SELECT * FROM SIM_USER");
    $sql_user_pending = mysqli_query($db, "SELECT * FROM SIM_USER Where status='Pending'");
    $sql_user_aktif = mysqli_query($db, "SELECT * FROM SIM_USER Where status='Aktif'");
    $sql_total_berita = mysqli_query($db, "SELECT * FROM SIM_BERITA");
    $sql_total_event = mysqli_query($db, "SELECT * FROM SIM_TAMBAH_EVENT");

        $query = mysqli_query($db, $sql);
        $user = mysqli_fetch_assoc($query);
        $cek = mysqli_num_rows($sql_rows);
        $user_pending = mysqli_num_rows($sql_user_pending);
        $user_aktif = mysqli_num_rows($sql_user_aktif);
        $total_berita = mysqli_num_rows($sql_total_berita);
        $total_event = mysqli_num_rows($sql_total_event);

} else {
            header('Location: pages/examples/logged.html');
    die("akses dilarang...");
}
        // jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
        header('Location: ../pages/examples/nulldata.html');
    die("data tidak ditemukan...");
}
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISTEM INFORMASI MASJID</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php">SISTEM INFORMASI MASJID</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user['nama'];  ?>

                    </div>
                    <div class="email"><?php echo "Masjid ".$user['nama_masjid'];  ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="controller/api-signout.php"><i class="material-icons">input</i>Sign Out
                            </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Tambah Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/forms/tambah-data-user.php">Tambah Data User</a>
                            </li>
                           <li>
                                <a href="pages/forms/tambah-event.php">Tambah Event</a>
                            </li>
                            <li>
                                <a href="pages/forms/tambah-berita.php">Tambah Berita</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Semua Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/data-user.php">Data User Aktif</a>
                            </li>
                             <li>
                                <a href="pages/tables/data-berita.php">Data Berita</a>
                            </li>
                             <li>
                                <a href="pages/tables/data-event.php">Data Event</a>
                            </li>
                            <!--<li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Checkpoints</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2018 <a href="javascript:void(0);">SISTEM INFORMASI MASJID</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH USER</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $cek ?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
<!--                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
<!--                    <div class="info-box bg-cyan hover-expand-effect">-->
<!--                        <div class="icon">-->
<!--                            <i class="material-icons">help</i>-->
<!--                        </div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">USER PENDING</div>-->
<!--                            <div class="number count-to" data-from="0" data-to="--><?php //echo $user_pending ?><!--" data-speed="1000" data-fresh-interval="20"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH BERITA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_berita ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">playlist_add_check</i>
                            </div>
                            <div class="content">
                                <div class="text">JUMLAH EVENT</div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $total_event ?>" data-speed="15" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- Widgets New -->

<!--                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
<!--                    <div class="info-box bg-cyan hover-expand-effect">-->
<!--                        <div class="icon">-->
<!--                            <i class="material-icons">help</i>-->
<!--                        </div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">USER PENDING</div>-->
<!--                            <div class="number count-to" data-from="0" data-to="--><?php //echo $user_pending ?><!--" data-speed="1000" data-fresh-interval="20"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
<!--                    <div class="info-box bg-light-green hover-expand-effect">-->
<!--                        <div class="icon">-->
<!--                            <i class="material-icons">forum</i>-->
<!--                        </div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">USER AKTIF</div>-->
<!--                            <div class="number count-to" data-from="0" data-to="--><?php //echo $user_aktif ?><!--" data-speed="1000" data-fresh-interval="20"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >-->
<!--                    <div class="info-box bg-orange hover-expand-effect">-->
<!--                        <div class="icon">-->
<!--                            <i class="material-icons">person_add</i>-->
<!--                        </div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">JUMLAH BERITA</div>-->
<!--                            <div class="number count-to" data-from="0" data-to="--><?php //echo $total_berita ?><!--" data-speed="1000" data-fresh-interval="20"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!-- #END# Widgets -->
<!--             CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
<!--             #END# CPU Usage -->
<!--            <div class="row clearfix">-->
<!--                 Visitors -->
<!--                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                    <div class="card">-->
<!--                        <div class="body bg-pink">-->
<!--                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"-->
<!--                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"-->
<!--                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"-->
<!--                                 data-fill-Color="rgba(0, 188, 212, 0)">-->
<!--                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11-->
<!--                            </div>-->
<!--                            <ul class="dashboard-stat-list">-->
<!--                                <li>-->
<!--                                    TODAY-->
<!--                                    <span class="pull-right"><b>1 200</b> <small>USERS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    YESTERDAY-->
<!--                                    <span class="pull-right"><b>3 872</b> <small>USERS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    LAST WEEK-->
<!--                                    <span class="pull-right"><b>26 582</b> <small>USERS</small></span>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 #END# Visitors -->
<!--                 Latest Social Trends -->
<!--                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                    <div class="card">-->
<!--                        <div class="body bg-cyan">-->
<!--                            <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>-->
<!--                            <ul class="dashboard-stat-list">-->
<!--                                <li>-->
<!--                                    #socialtrends-->
<!--                                    <span class="pull-right">-->
<!--                                        <i class="material-icons">trending_up</i>-->
<!--                                    </span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    #materialdesign-->
<!--                                    <span class="pull-right">-->
<!--                                        <i class="material-icons">trending_up</i>-->
<!--                                    </span>-->
<!--                                </li>-->
<!--                                <li>#adminbsb</li>-->
<!--                                <li>#freeadmintemplate</li>-->
<!--                                <li>#bootstraptemplate</li>-->
<!--                                <li>-->
<!--                                    #freehtmltemplate-->
<!--                                    <span class="pull-right">-->
<!--                                        <i class="material-icons">trending_up</i>-->
<!--                                    </span>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 #END# Latest Social Trends -->
<!--                 Answered Tickets -->
<!--                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                    <div class="card">-->
<!--                        <div class="body bg-teal">-->
<!--                            <div class="font-bold m-b--35">ANSWERED TICKETS</div>-->
<!--                            <ul class="dashboard-stat-list">-->
<!--                                <li>-->
<!--                                    TODAY-->
<!--                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    YESTERDAY-->
<!--                                    <span class="pull-right"><b>15</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    LAST WEEK-->
<!--                                    <span class="pull-right"><b>90</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    LAST MONTH-->
<!--                                    <span class="pull-right"><b>342</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    LAST YEAR-->
<!--                                    <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    ALL-->
<!--                                    <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 #END# Answered Tickets -->
<!--            </div>-->

<!--            <div class="row clearfix">-->
<!--                 Task Info -->
<!--                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">-->
<!--                    <div class="card">-->
<!--                        <div class="header">-->
<!--                            <h2>TASK INFOS</h2>-->
<!--                            <ul class="header-dropdown m-r--5">-->
<!--                                <li class="dropdown">-->
<!--                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-->
<!--                                        <i class="material-icons">more_vert</i>-->
<!--                                    </a>-->
<!--                                    <ul class="dropdown-menu pull-right">-->
<!--                                        <li><a href="javascript:void(0);">Action</a></li>-->
<!--                                        <li><a href="javascript:void(0);">Another action</a></li>-->
<!--                                        <li><a href="javascript:void(0);">Something else here</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="body">-->
<!--                            <div class="table-responsive">-->
<!--                                <table class="table table-hover dashboard-task-infos">-->
<!--                                    <thead>-->
<!--                                        <tr>-->
<!--                                            <th>#</th>-->
<!--                                            <th>Task</th>-->
<!--                                            <th>Status</th>-->
<!--                                            <th>Manager</th>-->
<!--                                            <th>Progress</th>-->
<!--                                        </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                        <tr>-->
<!--                                            <td>1</td>-->
<!--                                            <td>Task A</td>-->
<!--                                            <td><span class="label bg-green">Doing</span></td>-->
<!--                                            <td>Ade Fajr Ariav</td>-->
<!--                                            <td>-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>2</td>-->
<!--                                            <td>Task B</td>-->
<!--                                            <td><span class="label bg-blue">To Do</span></td>-->
<!--                                            <td>Ade Fajr Ariav</td>-->
<!--                                            <td>-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>3</td>-->
<!--                                            <td>Task C</td>-->
<!--                                            <td><span class="label bg-light-blue">On Hold</span></td>-->
<!--                                            <td>Ade Fajr Ariav</td>-->
<!--                                            <td>-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>4</td>-->
<!--                                            <td>Task D</td>-->
<!--                                            <td><span class="label bg-orange">Wait Approvel</span></td>-->
<!--                                            <td>Ade Fajr Ariav</td>-->
<!--                                            <td>-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>5</td>-->
<!--                                            <td>Task E</td>-->
<!--                                            <td>-->
<!--                                                <span class="label bg-red">Suspended</span>-->
<!--                                            </td>-->
<!--                                            <td>Ade Fajr Ariav</td>-->
<!--                                            <td>-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 #END# Task Info -->
<!--                 Browser Usage -->
<!--                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">-->
<!--                    <div class="card">-->
<!--                        <div class="header">-->
<!--                            <h2>BROWSER USAGE</h2>-->
<!--                            <ul class="header-dropdown m-r--5">-->
<!--                                <li class="dropdown">-->
<!--                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-->
<!--                                        <i class="material-icons">more_vert</i>-->
<!--                                    </a>-->
<!--                                    <ul class="dropdown-menu pull-right">-->
<!--                                        <li><a href="javascript:void(0);">Action</a></li>-->
<!--                                        <li><a href="javascript:void(0);">Another action</a></li>-->
<!--                                        <li><a href="javascript:void(0);">Something else here</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="body">-->
<!--                            <div id="donut_chart" class="dashboard-donut-chart"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                 #END# Browser Usage -->
<!--            </div>-->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
