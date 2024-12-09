<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IAQ Dashboard</title>
    <meta name="description" content="IAQ Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
    <link href="https://fonts.cdnfonts.com/css/autery" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['config']->server_host?>/assets/css/custom.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <style>
        /* Ensure the header is fixed at the top */
        header {
            /* position: fixed; */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333; /* Dark background for better contrast */
            color: #fff; /* White text */
            padding: 10px 0; /* Adjust padding as needed */
            z-index: 1000; /* Ensure it is above other content */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional: Add a shadow for depth */
        }

        /* Add some margin to the body to avoid content being hidden behind the fixed header */
        body {
            margin-top: 60px; /* Adjust based on the height of your header */
        }

        #weatherWidget .currentDesc {
            color: #ffffff!important;
        }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1 {
            height: 150px;
        }
        #flotPie1 td {
            padding: 3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5 {
            height: 105px;
        }
        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart {
            height: 160px;
        }
        .nav-item .active {
            color: black;
        }
        body {
    font-family: Arial, sans-serif;
}

.text-right {
    text-align: right;
    margin: 10px;
}

#mobile-menu-btn {
    cursor: pointer;
    font-weight: bold;
}

.menu {
    position: absolute;
    top: 50px;
    right: 10px;
    background-color: #2fb996;
    color: white;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    padding: 10px;
    z-index: 1000;
}

.menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu ul li {
    margin: 5px 0;
}

.menu ul li a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px;
}

/* .menu ul li a:hover {
    background-color: #555;
} */

.hidden {
    display: none;
}
@import url('https://fonts.cdnfonts.com/css/autery');

    </style>
</head>

<body>
    
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel" style="margin-left:0!important">
        
        <header id="header1" class="header bg-green" style="position : absolute;" >
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" style="height: 51.6px;" href="./dashboard"><img src="<?php echo $_SESSION['config']->server_host?>/images/CABH Logo Black.png" alt="Logo"></a>
                </div>
            </div>

            <!-- <a class="navbar-brand" style="font-family: 'Autery', sans-serif; " href="./dashboard">
                    <img src="<?php echo $_SESSION['config']->server_host?>/images/breathe-in.png" alt="Logo">
                    Breathe-in
                </a> -->

                <span class="navbar-brand" style="font-family: 'Autery', sans-serif; font-size: 30px; margin-top: -5px; margin-left: 10px;" href="./dashboard">
                    
                    breathe-in
                </span>
            
    
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                       <?php// echo setMenu();?>
                       <ul class="nav navbar-nav ml-auto" style="flex-direction: row;">
                        <!-- <li class="nav-item ">
                            <a href="/home" class="nav-link" id="nav_home">Home</a>
                        </li> -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link" id="nav_dashboard">Dashboard</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/breathein" class="nav-link" id="nav_breath">Breathe-in</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="/dialog" class="nav-link" id="nav_dialog">Dialogues</a>
                        </li> -->
                        <li class="nav-item">
                            <a href="/about-cabh" class="nav-link" id="nav_about">About <b>CABH</b></a>
                        </li>
                        <!-- <?php 
                            // if($_SESSION['config']->user == "public"){
                            //     ?>
                            //     <li class="nav-item">
                            //         <a href="/login" class="nav-link" id="nav_login">Login</a>
                            //     </li>
                            //     <?php
                            // }
                        
                        ?> -->
                       </ul>
                    </div>
                </div>
            </div>
        </header>

        <header id="header1-mobile" class="header bg-green mobile-header-menu" style="position : absolute;">
            <div class="text-left">
                <img src="<?php echo $_SESSION['config']->server_host?>/images/cabh-logo.png" style="width:40%">
            </div>
            <div class="text-right">
                <strong id="mobile-menu-btn">Menu</strong>
                
            </div>
            <div id="menu" class="menu hidden">
        <ul>
            <li><a href="https://iaq-dashboard.edsglobal.com/dashboard">Dashboard</a></li>
            <li><a href="https://iaq-dashboard.edsglobal.com/about-cabh">About <b>CABH</b></a></li>
            
        </ul>
    </div>
        </header>

    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('menu');

    menuButton.addEventListener('click', () => {
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });

    // Optional: Close menu if clicked outside
    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && event.target !== menuButton) {
            menu.classList.add('hidden');
        }
    });
});
</script>


    <!-- Additional content here -->
        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
