<!-- Header-->   
<?php include 'partials/header.php' ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- /#header -->
<script src="//cdn.amcharts.com/lib/5/themes/Responsive.js"></script>
<!-- Content -->
 <style>
    html {
        scroll-behavior: smooth;
    }
    .hide_element {
    display: none;
}

.map-legend {
    display: flex; /* Align items in a row */
    
     /* Space below the legend */
}

.map-legend span {
    display: flex; /* Make sure span behaves like a block element for size */
    width: 20px; /* Width of the square */
    height: 20px; /* Height of the square */
    margin-right: 10px; /* Space between squares and text */
    /* border: 1px solid #000; Optional: border to make the squares visible */
}

.indoorx {
    background-color: #2fb996; /* Example color for Indoor */
    display: inline-block;
}

.outdoorx {
    background-color: #f16463; /* Example color for Outdoor */
    display: inline-block;
}
/* Basic styling for the note element */
.offlinex {
    background-color: #d8d8d6; /* Example color for Offline */
    display: inline-block;
}


/* Bold class for text styling */
.bold {
    font-weight: bold;
}

.overlay {
            position: fixed; /* Fixed position relative to the viewport */
            top: 10px; /* Adjust as needed */
            left: 10px; /* Adjust as needed */
            z-index: 10; /* Ensure it appears above other elements */
        }

.Note {
            display: block;
            margin-top: 10px;
            
            box-sizing: border-box;
        }

        @media (min-width: 1473px) {
            .Note {
                margin-left: 870px;
                margin-right: 0;
            }
        }

        @media (max-width: 1473px) and (min-width: 768px) {
            .Note {
                margin-left: 670 px ;
                margin-right: 0px;
            }
        }

        @media (max-width: 767px) {
            .Note {
                margin-left: 0 px;
                margin-right:0 px;
                text-align: center;
            }
        }

        .header-container {
    display: flex;
    align-items: center; /* Align items vertically centered */
    justify-content: space-between; /* Distribute space between heading and buttons */
    flex-wrap: wrap; /* Allow wrapping if the container is too small */
}

.dashboard_title {
    margin: 0;
    /* Optional: Adjust text styling as needed */
}

.button-group {
    display: flex;
    gap: 10px; /* Optional: Adds space between buttons */
}

.markers {
    background: #2fb996; /* Marker background color */
    cursor: pointer;     /* Pointer cursor on hover */
    color: #FFF;         /* Text color */
    width: 75px;         /* Marker width */
    height: 40px;        /* Marker height */
    border-radius: 10%; /* Rounded corners */
    text-align: center;  /* Center align text */
    line-height: 40px;   /* Center text vertically */
    font-weight: bold;   /* Bold text */
}
.spinner-border {
        width: 3rem;
        height: 3rem;
        border: 0.25em solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top: 0.25em solid #007bff;
        animation: spinner-border 0.75s linear infinite;
    }

    @keyframes spinner-border {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    #boxchart1 {
    width: 120%; /* Default for small screens */
}

@media (min-width: 500px) { /* Medium screens and up */
    #boxchart1 {
        width: 100%;
        margin-left: 0; /* Reset margin if needed */
    }
}

@media (min-width: 992px) { /* Large screens */
    #boxchart1 {
        width: 100%;
    }
}
.message-box {
    background-color: #f0f0f0; /* Light grey background */
    border: 1px solid #ccc;    /* Light grey border */
    padding: 15px;             /* Some padding */
    height: 400px;
    border-radius: 5px;       /* Rounded corners */
    margin: 20px 0;           /* Margin for spacing */
    display: flex;            /* Use Flexbox */
    align-items: center;      /* Center vertically */
    justify-content: center;  /* Center horizontally */
    text-align: center;       /* Center text */
}


.hidden {
    display: none;
}


</style>

        
   


<div class="content" style = "margin-top : -100px; overflow-x: hidden;">
    <!-- Animated -->
    <div class="animated fadeIn">
    <?php

date_default_timezone_set('Asia/Kolkata');

// Create DateTime object for current time
$current_dt = new DateTime();
$start_dt = clone $current_dt;
$start_dt->modify('-1 hour');

// Function to add ordinal suffix to day (not needed in the final format)
function getDayWithSuffix($day) {
    $suffix = 'th';
    if ($day % 10 == 1 && $day != 11) {
        $suffix = 'st';
    } elseif ($day % 10 == 2 && $day != 12) {
        $suffix = 'nd';
    } elseif ($day % 10 == 3 && $day != 13) {
        $suffix = 'rd';
    }
    return $day . $suffix;
}

// Function to format time as "12 PM"
function formatTime($dateTime) {
    return $dateTime->format('g:i A');
}

// Format the current date and time
$current_day = $current_dt->format('d'); // Use 'd' for zero-padded day
$current_month = $current_dt->format('F');
$current_year = $current_dt->format('Y');
$current_time = formatTime($current_dt);
$current_dt_string = $current_month . ' ' . $current_day . ', ' . $current_year . ' at ' . $current_time;

$start_day = $start_dt->format('d'); // Use 'd' for zero-padded day
$start_month = $start_dt->format('F');
$start_year = $start_dt->format('Y');
$start_time = formatTime($start_dt);
$start_dt_string = $start_month . ' ' . $start_day . ', ' . $start_year . ' at ' . $start_time;

// Update the note message
$note_msg = "Updated on <b>$current_dt_string</b>.";  
?>

        
        <!-- map -->
        <div class="row" id="map_row">
            <div class="col-lg-12">
                <!-- Map card -->
                <div class="card">
                    <div class="card-body" >
                        
                        <div class="row">
                            <!-- place map here-->
                            <div class="col-lg-12">
                                <!-- <h4 class="dashboard_title text-center">Indoor Air Quality Monitors</h4> -->
                                <div id="map" style="position: relative; overflow: hidden; width: 100%; height: 460px;">
                               
                                
                                <div class="overlay" style="position: absolute; top: 10px; left: 10px; z-index: 1000;">
                                    <span class="indoorx" style="width: 18px; height: 18px; padding: 5px; border-radius: 3px; display: inline-block; "></span>
                                    Indoor
                                    <span class="outdoorx" style="width: 18px; height: 18px; padding: 5px; margin-left: 50px; border-radius: 3px; display: inline-block;"></span>
                                    Outdoor
                                    <span class="offlinex" style="width: 18px; height: 18px; padding: 5px; margin-left: 50px; border-radius: 3px; display: inline-block;"></span>
                                    Offline
                                    <!-- <div id="spinner" class="d-flex justify-content-center" style="display: none;">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div> -->
                            </div>
        
    </div>
    
</div>
                                
                                <!--map pin showing average value of selected pollutants (median) for last hour -->
                                
                                
                             


<!-- <div class="row" style="display: flex; align-items: center; gap: 20px;"> -->
    

<!-- <span class="note" style="display: inline-block; text-align: right;"><?php echo $note_msg; ?></span> -->

    
    
   

    </div>                            

                           
                            <div class="container">
                                <div class="row">
                                    <!-- Pollutants Section -->
                                    <div class="col-lg-6 pollutants-section">
                                     <div class="row text-left" style="display: flex; flex-direction: row; align-content: flex-start;">
                                            
                                            <button type="button" title="Air Quality Index" class="btn active" id="btnaqi_map" name="btnaqi_map">AQI</button>
                                            <button type="button" title="Particulate Matter 2.5 micro meter" class="btn" id="btnpm25_map" name="btnpm25_map">PM<sub>2.5</sub></button>
                                            <button type="button" title="Particulate Matter 10 micro meter" class="btn" id="btnpm10_map" name="btnpm10_map">PM<sub>10</sub></button>
                                            <button type="button" title="Carbon Dioxide" class="btn" id="btnco2_map" name="btnco2_map">CO<sub>2</sub></button>
                                            <button type="button" title="Total Volatile Organic Compounds" class="btn" id="btntvoc_map" name="btntvoc_map">TVOCs</button>
                                            <!-- <h4>Pollutant</h4> -->
                                        </div>
                                    </div>

                                    <!-- Monitor Details Section -->
                                    <div class="col-lg-6 monitor-details-section">
                                        <div class="row text-left" style=" margin-bottom:10px;">
                                            
                                            <!-- <div class="card"> -->
                                                <div  style="padding: 0px; ">
                                                <button type="button" disabled style="align: left; margin: 0px;">
                                                    <span id="monitor_count2">0</span>
                                                </button>
                                                    <span ><?php echo $note_msg; ?></span>
                                                    <!-- <input type="hidden" class="map_active_deviceID" name="map_active_deviceID" value="none">
                                                    <input type="hidden" id="map_total_device_count" name="map_total_device_count" value="none"> -->
                                                    <!-- <button style="align: left; margin: 0px;" type="button" class="btn active hide_element" id="btn_active_sensor" name="btn_active_sensor" style="width:auto;">Go</button> -->
                                                </div>
                                                <!-- <span class="note" style="display: inline-block; text-align: right;"><?php echo $note_msg; ?></span> -->
                                            <!-- </div> -->
                                            
                                            <!-- <span class="note" style="display: inline-block; text-align: right;"><?php echo $note_msg; ?></span> -->
                                            
                                            <!-- <h4 style="margin-top:-15px ; margin-bottom:10px;">Selected Monitors</h4> -->
                                            <!-- <button type="button" class="btn active hide_element" id="btn_active_sensor" name="btn_active_sensor" style="width:auto;">Active Device Data</button> -->
                                        </div>
                                    </div>
                                </div>

    <!-- IAQ Trends Section -->
    <!-- <div class="row">
        <div class="col-lg-12 iaq-trends-section">
            <div class="row text-left" style="margin-top:10px; margin-bottom:10px;">
                <h4>IAQ Trends</h4>
                <button type="button" class="btn_typology" id="btnResidential_map" name="btnResidential_map" onClick="document.getElementById('residential_row').scrollIntoView();">Residential</button>
                <button type="button" class="btn_typology" id="btnOffice_map" name="btnOffice_map" onclick="scrollToOffice()">Office</button>
                <button type="button" class="btn_typology" id="btnSchool_map" name="btnSchool_map" disabled>School</button>
            </div>
        </div>
    </div> -->
                        </div>

                        </div>
                    </div>
                </div>
                <!-- /# Map card -->
            </div>                  
        </div>
        <!-- /#map -->

        <div class="row " id="single_sensor_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                        <h4 id="iaq-trend-title" class="dashboard_title text-center">Indoor Air Quality trends for the selected monitor</office> </h4>
                                        
                                              
                                                <!-- <span class="note" style="display: inline-block; text-align: right;"><?php echo $note_msg; ?></span> -->
                                          
                                        <div class=" row text-left">
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                                <input type="button" class="btn btn_duration active" id="btnduration1d_S_sensor" name="btnduration1d_S_sensor" value="1d">
                                                <input type="button" class="btn btn_duration" id="btnduration7d_S_sensor" name="btnduration7d_S_sensor" value="7d"   >
                                                <input type="button" class="btn btn_duration" id="btnduration30d_S_sensor" name="btnduration30d_S_sensor" value="30d"  >
                                                <input type="button" class="btn btn_duration" id="btndurationAll_S_sensor" name="btndurationAll_S_sensor" value="All"  >
                                              
                                              
                                            </div>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                            <button type="button" disabled style="align: left; margin: 0px;">
                                                    <span class="monitor_count">0</span>
                                                    <input type="hidden" class="map_active_deviceID" name="map_active_deviceID" value="none">
                                                    <input type="hidden" class="map_total_device_count" name="map_total_device_count" value="none">
                                                    <!-- <button style="align: left; margin: 0px;" type="button" class="btn active hide_element" id="btn_active_sensor" name="btn_active_sensor" style="width:auto;">Go</button> -->
                                            </button>   
                                            </div>
                                        
                                        </div>
                                            <input type="hidden" id="hid_duration_S_sensor" name="hid_duration_S_sensor" value="24hour">
                                            <input type="hidden" id="hid_pollutants_S_sensor" name="hid_pollutants_S_sensor" value="aqi">
                                            <input type="hidden" id="#hid_linechart_condition" name="#hid_linechart_condition" value="none">
                                            <div class="col-lg-12 hidden" id="linechart1" name="linechart1" style="margin-left: -30px;" ></div>
                                            <div id="chartMessage" class="message-box">
                                                <p>Please click on the markers on the map to view the indoor air quality trends for that selected monitor.</p>
                                            </div>
                                           
                                            
                                            <!-- <span class="note"><b>Note: </b>Chart showing line plot for indoor sensor of <span id="active_sensor">'1202240025'</span> device</span> -->
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->

                            </div>
                          
                            <div class="col-lg-6">
                                <!-- Pollutants-->
                                <div id="pollutantButtonsContainer" class="row text-left" style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Pollutant</h4> -->
                                    <button type="button" title="Air Quality Index" class="btn active" id="btnaqi_sensor" name="btnaqi_sensor">AQI</button>
                                    <button type="button" title="Particulate Matter 2.5 micro meter" class="btn" id="btnpm25_sensor" name="btnpm25_sensor">PM<sub>2.5</sub></button>
                                    <button type="button" title="Particulate Matter 10 micro meter" class="btn" id="btnpm10_sensor" name="btnpm10_sensor">PM<sub>10</sub></button>
                                    <button type="button" title="Carbon Dioxide" class="btn" id="btnco2_sensor" name="btnco2_sensor">CO<sub>2</sub></button>
                                    <button type="button" title="Total Volatile Organic Compounds" class="btn" id="btntvoc_sensor" name="btntvoc_sensor">TVOCs</button>
                                </div>
                           
                            </div>
                            <div class="col-lg-6">
                                <!-- Indoor context-->
                                <div class="row text-left " style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Indoor Conditions</h4> -->
                                    <button type="button" class="btn" style="font-size: 15px;" id="showTemp">Temperature</button>
                                 
                                    <button type="button" class="btn" id="showHumidity">Humidity</button>
                                    <!-- <span class="note"><b>*Note: </b>With Temperature & RH chart will show only indoor data</span> -->

                                </div>
                            </div>   
                            <script>
    // Get all buttons in the pollutantButtonsContainer
    const pollutantButtons = document.querySelectorAll('#pollutantButtonsContainer .btn');
    
    // Get the specific buttons that need to lose their active state
    const indoorButtons = document.querySelectorAll('#showTemp, #showHumidity');

    // Add click event listener to each pollutant button
    pollutantButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from indoor buttons
            indoorButtons.forEach(btn => btn.classList.remove('active'));
        });
    });
</script>

                            <!-- <div class="col-lg-6">
                                    <button type="button" class="btn" style="font-size: 15px;" id="showTemp">Temperature</button>
                                    <button type="button" class="btn" id="showHumidity">Humidity</button>
                                                                
                            
                        </div> -->
                        

                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        <!-- </div> -->

        <!-- chart2 - box plot chart (Residential typology) -->
        <div class="row" id="residential_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <!-- <h4 class="dashboard_title text-center">Indoor Air Quality Trend - Residential</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                                <input type="button" class="btn_duration active" id="btnduration1d_R_boxplot" name="btnduration1d_R_boxplot" value="1d">
                                                <input type="button" class="btn_duration" id="btnduration7d_R_boxplot" name="btnduration7d_R_boxplot" value="7d"   >
                                                <input type="button" class="btn_duration" id="btnduration30d_R_boxplot" name="btnduration30d_R_boxplot" value="30d"  >
                                                <input type="button" class="btn_duration" id="btndurationAll_R_boxplot" name="btndurationAll_R_boxplot" value="All"  >
                                            </div> -->
                                            <!-- <div class="header-container"> -->
                                            <!-- <h4 class="dashboard_title text-center">Indoor Air Quality Trend - Residential</h4> -->
                                            <h4 class="dashboard_title text-center">Indoor Air Quality trends in residential buildings</h4>
                                            <div class="row">
    <!-- Span element taking 6 grid columns on the left -->
                                          
                                            
                                            <!-- Div element taking 6 grid columns on the right -->
                                            <div class="col-lg-6 col-md-6" style="display: flex; flex-direction: row; align-content: flex-start;">
                                                <input type="button" class="btn_duration active" style="margin-right:5px;"  id="btnduration1d_R_boxplot" name="btnduration1d_R_boxplot" value="1d">
                                                <input type="button" class="btn_duration" style="margin-right:5px;" id="btnduration7d_R_boxplot" name="btnduration7d_R_boxplot" value="7d">
                                                <input type="button" class="btn_duration" style="margin-right:5px;" id="btnduration30d_R_boxplot" name="btnduration30d_R_boxplot" value="30d">
                                                <input type="button" class="btn_duration" style="margin-right:5px;" id="btndurationAll_R_boxplot" name="btndurationAll_R_boxplot" value="All">
                                            </div>
                                            </div>
                                            <!-- </div> -->

                                            <input type="hidden" id="hid_duration_R_boxplot" name="hid_duration_R_boxplot" value="24hour">
                                            <input type="hidden" id="hid_pollutants_R_boxplot" name="hid_pollutants_R_boxplot" value="aqi">
                                            <input type="hidden" id="hid_indoorConditon_R_boxplot" name="hid_indoorConditon_R_boxplot" value="none">
                                            <div class="col-lg-12" id="boxchart1" name="boxchart1" style="margin-left: -60px; position: relative; overflow: hidden;  height:380px "></div>
                                            <?php
                                   $current_day = $current_dt->format('d'); // Use 'd' for zero-padded day
                                   $current_month = $current_dt->format('F');
                                   $current_year = $current_dt->format('Y');
                                   $current_time = formatTime($current_dt);
                                   $current_dt_string = $current_month . ' ' . $current_day . ', ' . $current_year . ' at ' . $current_time;
                                   
                                   $start_day = $start_dt->format('d'); // Use 'd' for zero-padded day
                                   $start_month = $start_dt->format('F');
                                   $start_year = $start_dt->format('Y');
                                   $start_time = formatTime($start_dt);
                                   $start_dt_string = $start_month . ' ' . $start_day . ', ' . $start_year . ' at ' . $start_time;
                                   
                                   // Update the note message
                                //    $note_msg = "last updated on <b>$current_dt_string</b>. Refer <a href='#section2'>notes</a> for additional information."; 

                                ?>
                                <!-- <span class="note"> <?php echo $note_msg; ?> </span> -->
                                            <!-- <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Residential typology</span> -->
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            <div class="col-lg-6">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Pollutant</h4> -->
                                    <button type="button" title="Air Quality Index" class="btn active" id="btnaqi_R_box" name="btnaqi_R_box" >AQI</button>
                                    <button type="button" title="Particulate Matter 2.5 micro meter" class="btn" id="btnpm25_R_box" name="btnpm25_R_box" >PM<sub>2.5</sub></button>
                                    <button type="button" title="Particulate Matter 10 micro meter" class="btn" id="btnpm10_R_box" name="btnpm10_R_box" >PM<sub>10</sub> </button>
                                    <button type="button" title="Carbon Dioxide" class="btn" id="btnco2_R_box" name="btnco2_R_box">CO<sub>2</sub></button>
                                    <button type="button" title="Total Volatile Organic Compounds" class="btn" id="btntvoc_R_box" name="btntvoc_R_box"  >TVOCs</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Indoor context-->
                                <div class="row text-left " style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Indoor Conditions</h4> -->
                                    <button type="button" class="btn" id="btnWTemp_R_box" name="btnWTemp_R_box" style="font-size: 15px;" >Temperature</button>
                                    <button type="button" class="btn" id="btnWRH_R_box" name="btnWRH_R_box" >Humidity</button><br>
                                    <!-- <span class="note"><b>*Note: </b>With Temperature & RH chart will show only indoor data</span> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - box plot chart (Residential typology)-->

        <!-- chart2 - box plot chart (Office typology) -->
        <!-- <div class="row" id="office_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Indoor Air Quality trends in office buildings</h4>
                                            <div class="col-lg-6 col-md-6" style="margin-left: -15px;display: flex; flex-direction: row; align-content: flex-start;">
                                            <input type="button" class="btn btn_duration active" style="margin-right: 5px !important; " id="btnduration1d_O_boxplot" name="btnduration1d_O_boxplot" value="1d">
<input type="button" class="btn btn_duration" style="margin-right: 5px;" id="btnduration7d_O_boxplot" name="btnduration7d_O_boxplot" value="7d">
<input type="button" class="btn btn_duration" style="margin-right: 5px;" id="btnduration30d_O_boxplot" name="btnduration30d_O_boxplot" value="30d">
<input type="button" class="btn btn_duration" style="margin-right: 5px;" id="btndurationAll_O_boxplot" name="btndurationAll_O_boxplot" value="All">
                                            </div>
                                            <input type="hidden" id="hid_duration_O_boxplot" name="hid_duration_O_boxplot" value="24hour">
                                            <input type="hidden" id="hid_pollutants_O_boxplot" name="hid_pollutants_O_boxplot" value="aqi">
                                            <input type="hidden" id="hid_indoorConditon_O_boxplot" name="hid_indoorConditon_O_boxplot" value="none">
                                            <div class="col-lg-12" id="boxchart1_office" name="boxchart1_office" style="margin-left: -60px; position: relative; overflow: hidden;  height:380px "></div>
                                           
                                            <!-- <div class="col-lg-12" id="boxchart1" name="boxchart1" style="margin-left: -60px; position: relative; overflow: hidden; width: 120%; height:380px "></div> -->
                                            <?php
                                   $current_day = $current_dt->format('d'); // Use 'd' for zero-padded day
                                   $current_month = $current_dt->format('F');
                                   $current_year = $current_dt->format('Y');
                                   $current_time = formatTime($current_dt);
                                   $current_dt_string = $current_month . ' ' . $current_day . ', ' . $current_year . ' at ' . $current_time;
                                   
                                   $start_day = $start_dt->format('d'); // Use 'd' for zero-padded day
                                   $start_month = $start_dt->format('F');
                                   $start_year = $start_dt->format('Y');
                                   $start_time = formatTime($start_dt);
                                   $start_dt_string = $start_month . ' ' . $start_day . ', ' . $start_year . ' at ' . $start_time;
                                   
                                   // Update the note message
                                //    $note_msg = "last updated on <b>$current_dt_string</b>. Refer <a href='#section2'>notes</a> for additional information."; 

                                ?>
                                <!-- <span class="note"><b></b> <?php echo $note_msg; ?> </span> -->
                                            <!-- <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Office typology</span> -->
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Pollutant</h4> -->
                                    <button type="button" title="Air Quality Index" class="btn active" id="btnaqi_O_box" name="btnaqi_O_box" >AQI</button>
                                    <button type="button" title="Particulate Matter 2.5 micro meter" class="btn" id="btnpm25_O_box" name="btnpm25_O_box" >PM<sub>2.5</sub> </button>
                                    <button type="button" title="Particulate Matter 10 micro meter" class="btn" id="btnpm10_O_box" name="btnpm10_O_box" >PM<sub>10</sub> </button>
                                    <button type="button" title="Carbon Dioxide" class="btn" id="btnco2_O_box" name="btnco2_O_box">CO<sub>2</sub></button>
                                    <button type="button" title="Total Volatile Organic Compounds" class="btn" id="btntvoc_O_box" name="btntvoc_O_box"  >TVOCs</button>
                                </div>
                                </div>   
                            <div class="col-lg-6">
                                <!-- Indoor context-->
                                <div class="row text-left " style="margin-left: 20px; margin-bottom:10px; display:block text-align: left"> 
                                    <!-- <h4>Indoor Conditions</h4> -->
                                    <button type="button" class="btn" id="btnWTemp_O_box" name="btnWTemp_O_box" style="font-size: 15px;" >Temperature</button>
                                    <button type="button" class="btn" id="btnWRH_O_box" name="btnWRH_O_box" >Humidity</button><br>
                                    <!-- <span class="note"><b>*Note: </b>With Temperature & RH chart will show only indoor data</span> -->

                                </div>
                            </div>
                                             
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - box plot chart (Office typology)-->
         

        <!-- chart1 - line chart for single sensor-->
        <div class="row hide_element" id="single_sensor_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- box charIndoor Air Quality Trend - Officet --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Plot for Single Sensor</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                                <input type="button" class="btn btn_duration active" id="btnduration1d_S_sensor" name="btnduration1d_S_sensor" value="1d">
                                                <input type="button" class="btn btn_duration" id="btnduration7d_S_sensor" name="btnduration7d_S_sensor" value="7d"   >
                                                <input type="button" class="btn btn_duration" id="btnduration30d_S_sensor" name="btnduration30d_S_sensor" value="30d"  >
                                                <input type="button" class="btn btn_duration" id="btndurationAll_S_sensor" name="btndurationAll_S_sensor" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration_S_sensor" name="hid_duration_S_sensor" value="24hour">
                                            <input type="hidden" id="hid_pollutants_S_sensor" name="hid_pollutants_S_sensor" value="aqi">
                                            <div id="linechart1" name="linechart1" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <span class="note"><b>Note: </b>Chart showing line plot for indoor sensor of <span id="active_sensor">'1202240025'</span> device</span>
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->

                            </div>
                            <div class="col-lg-2">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px; display:block text-align: left"> 
                                    <h4> Pollutant</h4>
                                    <button type="button" title="Air Quality Index" class="btn active" id="btnaqi_sensor" name="btnaqi_sensor" >AQI</button>
                                    <button type="button" title="Particulate Matter 2.5 micro meter" class="btn" id="btnpm25_sensor" name="btnpm25_sensor" >PM<sub>2.5</sub> </button>
                                    <button type="button" title="Particulate Matter 10 micro meter" class="btn" id="btnpm10_sensor" name="btnpm10_sensor" >PM<sub>10</sub> </button>
                                    <button type="button" title="Carbon Dioxide" class="btn" id="btnco2_sensor" name="btnco2_sensor">CO<sub>2</sub> </button>
                                    <button type="button" title="Total Volatile Organic Compounds" class="btn" id="btntvoc_sensor" name="btntvoc_sensor"  >TVOCs</button>
                                </div>
                            <div class = "row text-left">
                                <button type="button" class="btn active" id="btnback2map" name="btnback2map"  >To map</button>
                            </div>
                            </div>                           
                            
                        </div>
                        

                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>


        

        <div class="row" id="section2">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" style="font-size = small;">
                        <!-- filter -->
                        <div class="row">
                             <div class="col-lg-12">
                                
                                <h6 style="font-size: small;"><b>Notes:</b> </h6>
                                <ol type = "1" style="font-size: small;">
                                <li style=><b>Outdoor Data:</b>  Outdoor data is being
                                    fetched from air quality monitoring station nearest to the indoor air monitoring
                                    location. Outdoor data for CO<sub>2</sub> and VOC is unavailable. 
                                </li>
                                <li>
                                <b>Indoor Data:</b> Indoor air quality data uses
                                median of 15-minute data monitored at minute interval.
                                </li>
                                <li>
                                <b>Indoor Conditions:</b> Indoor temperature and
                                relative humidity data uses median of 15-minute data monitored at minute interval.
                                The data is averaged across selected monitors.

                                </li>
                                
                                <li>
                                Data is updated every 15 minutes. Data can be
                                visualised at a minimum resolution of 15 minutes.
                                </li>
                                </ol>
                                
                                
                                <!-- /# box chart -->

                            </div>
                           
                                             
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>                  
        </div>
        <!-- /#chart1 - line chart -->

        

    </div>
    <!-- .animated -->
</div>
        
<!-- /.content -->
<div class="clearfix"></div>
<!-- Footer -->
<?php include 'partials/footer.php' ?>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>

    <script src="assets/js/lib/gmap/gmaps.js"></script>
    <script src="assets/js/init/gmap-init.js"></script> -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- load pins on map script -->
    <!-- the map is showing pins with avg median value for indoor pollutant and avg of outdoor pollutant for last hour data -->

    <script>
mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2LW5pa3VuaiIsImEiOiJjbHMwYTNmdnowMDFxMmpyNTBteHoybTRwIn0.OEzenC6wBOTbqZXCUNoE7A';
        var map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/light-v11',
        //style: 'mapbox://styles/mapbox/satellite-v9',
        center: [0,0], // starting position [lng, lat] [77.2, 28.58]
        scrollZoom: false, // Disable scroll zoom
        dragPan: false, // Disable drag pan
        zoom: 1 // starting zoom //10

        });

        let interactionsEnabled = false;

        map.on('load', function() {
    map.flyTo({
        center: [77.2, 28.53], // Target position [lng, lat]
        zoom: 10.6, // Target zoom
        speed: 0.6, // Animation speed
        curve: 3, // Easing curve
        easing: function(t) {
            return t;
        }
    });

    // Toggle interactions on map click
    map.on('click', function() {
        if (interactionsEnabled) {
            map.scrollZoom.disable();
            map.dragPan.disable();
        } else {
            map.scrollZoom.enable();
            map.dragPan.enable();
        }
        interactionsEnabled = !interactionsEnabled; // Toggle the flag
    });
});


        //  document.addEventListener('DOMContentLoaded', (event) => {
        //     async function fetchDeviceDetails() {
        //         try {
        //             const response = await fetch('https://iaq-dashboard.edsglobal.com/api/device_details/get');
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             const data = await response.json();
        //             console.log('API Response:', data); // Log the response to inspect its structure

        //             // Access the Data array from the response
        //             const devices = data.Data || []; // Replace 'Data' with the correct property name if different

        //             // Filter devices where active status is "0"
        //             const inactiveDevices = devices.filter(device => device.active === "0");
        //             displayDeviceDetails(inactiveDevices);
        //         } catch (error) {
        //             console.error('There was a problem with the fetch operation:', error);
        //         }
        //     }

        //     function displayDeviceDetails(deviceDetails) {
        //         const deviceList = document.getElementById('device-list');
        //         if (!deviceList) {
        //             console.error('Element with ID "device-list" not found.');
        //             return;
        //         }

        //         deviceList.innerHTML = ''; // Clear existing content

        //         if (deviceDetails.length === 0) {
        //             deviceList.innerHTML = '<li>No inactive devices found.</li>';
        //             return;
        //         }

        //         deviceDetails.forEach(device => {
        //             const listItem = document.createElement('li');
        //             listItem.innerHTML = `
        //                 <strong>Device ID:</strong> ${device.deviceID}<br>
        //                 <strong>Deployment ID:</strong> ${device.deployementID}<br>
        //                 <strong>Typology:</strong> ${device.typology}<br>
        //                 <strong>Address:</strong> ${device.address}<br>
        //                 <strong>Latitude:</strong> ${device.latitude}<br>
        //                 <strong>Longitude:</strong> ${device.longitude}<br>
        //                 <strong>Contact Person:</strong> ${device.contact_person}<br>
        //                 <strong>Contact Number:</strong> ${device.contact_number}<br>
        //                 <strong>Email ID:</strong> ${device.emailID}<br>
        //                 <strong>Installation Date:</strong> ${device.installation_date}<br>
        //                 <strong>Uninstallation Date:</strong> ${device.uninstallation_date ? device.uninstallation_date : 'N/A'}
        //             `;
        //             deviceList.appendChild(listItem);
        //         });
        //     }

        //     // Fetch and filter the device details when the DOM is fully loaded
        //     fetchDeviceDetails();
        // });

         const deviceData = [
    // First snippet
    {
            "deviceID": "1201240075",
            "deployementID": "OFGSI-005",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-02-21 00:00:00",
            "uninstallation_date": null,
            "address": "Hines Office, 12th Floor, One Horizon Centre, Sec-43, Gurugram",
            "latitude": "28.456",
            "longitude": "77.0956",
            "nearby_AQI_station": "Sector-51, Gurugram-HSPCB (3.5 kms)",
            "outdoor_deviceID": "CPCB1703205345",
            "contact_person": "Mr. Dharmendra Singh (Assistant Manager-IT)",
            "contact_number": "9716820034",
            "emailID": "Ashwin.Bhakay@hines.com , Dharmendra.Singh@hines.c",
            "total_no_of_floors": "25",
            "installation_floor_no": "12",
            "total_build_up_area_sq_m": "0",
            "occupancy": "25",
            "created_on": "2024-08-20 04:41:16",
            "updated_on": "2024-08-20 04:41:16"
        },
        {
            "deviceID": "1201240078",
            "deployementID": "OFGSI-006",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-02-21 00:00:00",
            "uninstallation_date": null,
            "address": "Hines Office, 12th Floor, One Horizon Centre, Sec-43, Gurugram",
            "latitude": "28.45",
            "longitude": "77.095",
            "nearby_AQI_station": "Sector-51, Gurugram-HSPCB (3.5 kms)",
            "outdoor_deviceID": "CPCB1703205345",
            "contact_person": "Mr. Dharmendra Singh (Assistant Manager-IT)",
            "contact_number": "9716820034",
            "emailID": "Ashwin.Bhakay@hines.com , Dharmendra.Singh@hines.c",
            "total_no_of_floors": "25",
            "installation_floor_no": "12",
            "total_build_up_area_sq_m": "0",
            "occupancy": "15",
            "created_on": "2024-05-13 10:38:26",
            "updated_on": "2024-05-13 10:38:26"
        },
        {
            "deviceID": "1202240026",
            "deployementID": "OFRK-11",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-18 00:00:00",
            "uninstallation_date": null,
            "address": "D-1/25 Vasant Vihar , New Delhi-110057(EDS Delhi)",
            "latitude": "28.5625",
            "longitude": "77.1497",
            "nearby_AQI_station": "RK Puram Delhi-DPCC (2.5 Kms)",
            "outdoor_deviceID": "THIRD_DPCC_SCR_RKPURAM",
            "contact_person": "Mr. Abhishek Soni",
            "contact_number": "9310646239",
            "emailID": "Soni.abhishek@edsglobal.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "-1",
            "total_build_up_area_sq_m": "464",
            "occupancy": "28",
            "created_on": "2024-09-12 04:54:12",
            "updated_on": "2024-09-12 04:54:12"
        },
        {
            "deviceID": "1202240025",
            "deployementID": "OFRK-12",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-18 00:00:00",
            "uninstallation_date": null,
            "address": "D-1/25 Vasant Vihar , New Delhi-110057(EDS Delhi)",
            "latitude": "28.562",
            "longitude": "77.149",
            "nearby_AQI_station": "RK Puram Delhi-DPCC (2.5 Kms)",
            "outdoor_deviceID": "THIRD_DPCC_SCR_RKPURAM",
            "contact_person": "Mr. Abhishek Soni",
            "contact_number": "9310646239",
            "emailID": "Soni.abhishek@edsglobal.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "-1",
            "total_build_up_area_sq_m": "464",
            "occupancy": "28",
            "created_on": "2024-05-13 10:35:00",
            "updated_on": "2024-05-13 10:35:00"
        },
        {
            "deviceID": "1203240081",
            "deployementID": "OFRK-26",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-09-20 00:00:00",
            "uninstallation_date": null,
            "address": "26A Poorvi Marg, Vasant Vihar , New Delhi-110057\r\n(EDS, E-Block, Delhi)",
            "latitude": "28.5614",
            "longitude": "77.1584",
            "nearby_AQI_station": "RK Puram Delhi-DPCC (2 Kms)",
            "outdoor_deviceID": "THIRD_DPCC_SCR_RKPURAM",
            "contact_person": "Abhishek Soni",
            "contact_number": "9310646239",
            "emailID": "Soni.abhishek@edsglobal.com",
            "total_no_of_floors": "3",
            "installation_floor_no": "0",
            "total_build_up_area_sq_m": "0",
            "occupancy": "12",
            "created_on": "2024-09-30 08:51:25",
            "updated_on": "2024-09-30 08:51:25"
        },
        {
            "deviceID": "1202240011",
            "deployementID": "RECR-15",
            "typology": "Apartment",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-04-05 00:14:07",
            "uninstallation_date": null,
            "address": "D-188, Abul Fazal Enclave-I, Jamia Nagar, New Delhi-110025",
            "latitude": "28.5557",
            "longitude": "77.2948",
            "nearby_AQI_station": "CRRI Mathura Road, Delhi-IMD(2Km)",
            "outdoor_deviceID": "DELCPCB010",
            "contact_person": "Mariyam",
            "contact_number": "9718224396",
            "emailID": "mariyam.zakiah2020@gmail.com",
            "total_no_of_floors": "3",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "40",
            "occupancy": "3",
            "created_on": "2024-09-12 05:35:20",
            "updated_on": "2024-09-12 05:35:20"
        },
        {
            "deviceID": "1202240027",
            "deployementID": "RECR-16",
            "typology": "Apartment",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-04-05 14:07:00",
            "uninstallation_date": null,
            "address": "D-188, Abul Fazal Enclave-I, Jamia Nagar, New Delhi-110025",
            "latitude": "28.5555",
            "longitude": "77.2942",
            "nearby_AQI_station": "CRRI Mathura Road, Delhi-IMD(2Km)",
            "outdoor_deviceID": "DELCPCB010",
            "contact_person": "Mariyam",
            "contact_number": "9718224396",
            "emailID": "mariyam.zakiah2020@gmail.com",
            "total_no_of_floors": "3",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "60",
            "occupancy": "3",
            "created_on": "2024-06-24 10:18:42",
            "updated_on": "2024-06-24 10:18:42"
        },
        {
            "deviceID": "1203240076",
            "deployementID": "RECR-23",
            "typology": "Midrise Apartment (G+5)",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-05-05 00:00:00",
            "uninstallation_date": null,
            "address": "D 184 ABUL FAZAL ENCLAVE, JAMIA NAGAR, OKHLA, NEW DELHI 25",
            "latitude": "28.559",
            "longitude": "77.293",
            "nearby_AQI_station": "CRRI Mathura Road, Delhi-IMD (2Km)",
            "outdoor_deviceID": "DELCPCB010",
            "contact_person": "Hisham Ahmed",
            "contact_number": "9873065488",
            "emailID": "hisham@edsglobal.com",
            "total_no_of_floors": "5",
            "installation_floor_no": "5",
            "total_build_up_area_sq_m": "135",
            "occupancy": "4",
            "created_on": "2024-08-20 06:09:34",
            "updated_on": "2024-08-20 06:09:34"
        },
        {
            "deviceID": "1203240078",
            "deployementID": "RECR-24",
            "typology": "Midrise Apartment (G+5)",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-05-05 00:00:00",
            "uninstallation_date": null,
            "address": "D 184 ABUL FAZAL ENCLAVE, JAMIA NAGAR, OKHLA, NEW DELHI 25",
            "latitude": "28.55",
            "longitude": "77.29",
            "nearby_AQI_station": "CRRI Mathura Road, Delhi-IMD (2Km)",
            "outdoor_deviceID": "DELCPCB010",
            "contact_person": "Hisham Ahmed",
            "contact_number": "9873065488",
            "emailID": "hisham@edsglobal.com",
            "total_no_of_floors": "5",
            "installation_floor_no": "5",
            "total_build_up_area_sq_m": "135",
            "occupancy": "4",
            "created_on": "2024-08-20 06:09:24",
            "updated_on": "2024-08-20 06:09:24"
        },
        {
            "deviceID": "1203240075",
            "deployementID": "RECR-31",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "kitchen",
            "installation_date": "2024-09-10 00:00:00",
            "uninstallation_date": null,
            "address": "A 48/B, Third Floor, Abul Fazal Enclave Part II, New Delhi",
            "latitude": "28.5503",
            "longitude": "77.2997",
            "nearby_AQI_station": "CRRI Mathura Road, Delhi-IMD (2Km)",
            "outdoor_deviceID": "DELCPCB010",
            "contact_person": "Shahzeb",
            "contact_number": "8287035226",
            "emailID": "shahzeb@edsglobal.com",
            "total_no_of_floors": "5",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "112",
            "occupancy": "3",
            "created_on": "2024-09-30 09:14:11",
            "updated_on": "2024-09-30 09:14:11"
        },
        {
            "deviceID": "1201240077",
            "deployementID": "RED8-003",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "kitchen",
            "installation_date": "2024-02-29 00:00:00",
            "uninstallation_date": null,
            "address": "448, Sector-9, Pocket-1 DDA Flats Dwarka , New Delhi-110075",
            "latitude": "28.583",
            "longitude": "77.063",
            "nearby_AQI_station": "Dwarka sector-8, Delhi-DPCC (2 Kms)",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Lakshmi Ganesh Kamath",
            "contact_number": "9811022520",
            "emailID": "Lakshmi.g.kamath@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "90",
            "occupancy": "3",
            "created_on": "2024-07-18 11:04:18",
            "updated_on": "2024-07-18 11:04:18"
        },
        {
            "deviceID": "1201240072",
            "deployementID": "RED8-004",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-02-29 00:00:00",
            "uninstallation_date": null,
            "address": "448, Sector-9, Pocket-1 DDA Flats Dwarka , New Delhi-110075",
            "latitude": "28.5835",
            "longitude": "77.0635",
            "nearby_AQI_station": "Dwarka sector-8, Delhi-DPCC (2 Kms)",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Lakshmi Ganesh Kamath",
            "contact_number": "9811022520",
            "emailID": "Lakshmi.g.kamath@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "90",
            "occupancy": "3",
            "created_on": "2024-08-20 05:37:35",
            "updated_on": "2024-08-20 05:37:35"
        },
        {
            "deviceID": "1203240079",
            "deployementID": "REPG - 29",
            "typology": "Residential, Multi-family",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living room",
            "installation_date": "2024-07-06 00:00:00",
            "uninstallation_date": null,
            "address": "C-403, Prince Apartments, Plot 54, I.P. Extension, Patparganj, Delhi - 110092",
            "latitude": "28.63",
            "longitude": "77.2983",
            "nearby_AQI_station": "Patparganj Delhi-DPCC (1.5 Kms)",
            "outdoor_deviceID": "DELDPCC006",
            "contact_person": "Piyush Varma",
            "contact_number": "9718906332",
            "emailID": "varpiyush@gmail.com",
            "total_no_of_floors": "7",
            "installation_floor_no": "4",
            "total_build_up_area_sq_m": "120",
            "occupancy": "1",
            "created_on": "2024-09-18 05:49:52",
            "updated_on": "2024-09-18 05:49:52"
        },
        {
            "deviceID": "1201240079",
            "deployementID": "REPG-001",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-02-19 00:00:00",
            "uninstallation_date": null,
            "address": "B-3/527, Ekta Gardens Apts, Patparganj, Delhi - 110092",
            "latitude": "28.6248",
            "longitude": "77.2914",
            "nearby_AQI_station": "Patparganj Delhi-DPCC (0.12 Kms)",
            "outdoor_deviceID": "DELDPCC006",
            "contact_person": "Mr. Piyush Verma",
            "contact_number": "9718906332",
            "emailID": "Piyush@edsglobal.com",
            "total_no_of_floors": "7",
            "installation_floor_no": "5",
            "total_build_up_area_sq_m": "90",
            "occupancy": "3",
            "created_on": "2024-09-12 05:44:18",
            "updated_on": "2024-09-12 05:44:18"
        },
        {
            "deviceID": "1201240085",
            "deployementID": "REPG-002",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-02-19 00:00:00",
            "uninstallation_date": null,
            "address": "B-3/527, Ekta Gardens Apts, Patparganj, Delhi - 110092",
            "latitude": "28.62",
            "longitude": "77.291",
            "nearby_AQI_station": "Patparganj Delhi-DPCC (0.12 Kms)",
            "outdoor_deviceID": "DELDPCC006",
            "contact_person": "Mr. Piyush Verma",
            "contact_number": "9718906332",
            "emailID": "Piyush@edsglobal.com",
            "total_no_of_floors": "7",
            "installation_floor_no": "5",
            "total_build_up_area_sq_m": "90",
            "occupancy": "5",
            "created_on": "2024-07-18 11:04:21",
            "updated_on": "2024-07-18 11:04:21"
        },
        {
            "deviceID": "1203240083",
            "deployementID": "RERK-032",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living room",
            "installation_date": "2024-09-14 00:00:00",
            "uninstallation_date": null,
            "address": "Flat No. 25, Tower E2, Sector E1, Vasant Kunj, New Delhi",
            "latitude": "28.5369",
            "longitude": "77.1316",
            "nearby_AQI_station": "RK Puram Delhi-DPCC (5.5 Kms)",
            "outdoor_deviceID": "THIRD_DPCC_SCR_RKPURAM",
            "contact_person": "Sheetal Jain",
            "contact_number": "9958692759",
            "emailID": "sheetal@edsglobal.com",
            "total_no_of_floors": "7",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "60",
            "occupancy": "2",
            "created_on": "2024-09-30 09:18:28",
            "updated_on": "2024-09-30 09:18:28"
        },
        {
            "deviceID": "1203240073",
            "deployementID": "RERK-27",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-07-16 00:00:00",
            "uninstallation_date": null,
            "address": "Flat no. 495, Block 14, Kaveri Apartments, D6, Vasant Kunj, Delhi - 110070",
            "latitude": "28.526",
            "longitude": "77.1518",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi - DPCC",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Nidhi",
            "contact_number": "9819898045",
            "emailID": "nidhi@edsglobal.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "3",
            "total_build_up_area_sq_m": "0",
            "occupancy": "1",
            "created_on": "2024-09-30 08:56:46",
            "updated_on": "2024-09-30 08:56:46"
        },
        {
            "deviceID": "1203240074",
            "deployementID": "RERO-28",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living room",
            "installation_date": "2024-09-15 00:00:00",
            "uninstallation_date": null,
            "address": "569 sector A pocket C Vasant Kunj, Delhi - 110070",
            "latitude": "28.7143",
            "longitude": "77.1081",
            "nearby_AQI_station": "Rohini - DPCC (2.5 Kms)",
            "outdoor_deviceID": "DELDPCC011",
            "contact_person": "Ashish Jain",
            "contact_number": "9891683061",
            "emailID": "varpiyush@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "1",
            "total_build_up_area_sq_m": "100",
            "occupancy": "6",
            "created_on": "2024-09-30 09:24:12",
            "updated_on": "2024-09-30 09:24:12"
        },
        {
            "deviceID": "1201240076",
            "deployementID": "RESA-009",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-03-06 00:00:00",
            "uninstallation_date": null,
            "address": "H No.-296 Near Durga Ashram, Chhatarpur, Delhi-110074",
            "latitude": "28.4965",
            "longitude": "77.1815",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi-DPCC (4 Kms)",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Mr. Surender Bhati",
            "contact_number": "9555864378",
            "emailID": "Surrenderbhati30@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "680",
            "occupancy": "16",
            "created_on": "2024-09-12 05:46:30",
            "updated_on": "2024-09-12 05:46:30"
        },
        {
            "deviceID": "1212230160",
            "deployementID": "RESA-010",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-03-06 00:00:00",
            "uninstallation_date": null,
            "address": "H No.-296 Near Durga Ashram, Chhatarpur, Delhi-110074",
            "latitude": "28.496",
            "longitude": "77.181",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi-DPCC (4 Kms)",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Mr. Surender Bhati",
            "contact_number": "9555864378",
            "emailID": "Surrenderbhati30@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "680",
            "occupancy": "16",
            "created_on": "2024-06-24 11:35:53",
            "updated_on": "2024-06-24 11:35:53"
        },
        {
            "deviceID": "1202240009",
            "deployementID": "RESA-13",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-03-19 00:00:00",
            "uninstallation_date": null,
            "address": "D-13A 2nd Floor Left side, Paryavaran Complex, Delhi 1100030",
            "latitude": "28.5145",
            "longitude": "77.1965",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi DPCC (2.2 Kms)",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Mr. Robin Jain",
            "contact_number": "7062137067",
            "emailID": "Robin@edsglobal.com, Robinmits.jain@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "75",
            "occupancy": "3",
            "created_on": "2024-09-12 05:48:43",
            "updated_on": "2024-09-12 05:48:43"
        },
        {
            "deviceID": "1202240008",
            "deployementID": "RESA-14",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-19 00:00:00",
            "uninstallation_date": null,
            "address": "D-13A 2nd Floor Left side, Paryavaran Complex, Delhi 1100030",
            "latitude": "28.514",
            "longitude": "77.196",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi DPCC (2.2 Kms)",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Mr. Robin Jain",
            "contact_number": "7062137067",
            "emailID": "Robin@edsglobal.com, Robinmits.jain@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "75",
            "occupancy": "3",
            "created_on": "2024-08-20 04:44:46",
            "updated_on": "2024-08-20 04:44:46"
        },
        {
            "deviceID": "1201240073",
            "deployementID": "RESA-30",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-09-15 00:00:00",
            "uninstallation_date": null,
            "address": "569 sector A pocket C Vasant Kunj, Delhi - 110070",
            "latitude": "28.5116",
            "longitude": "77.1678",
            "nearby_AQI_station": "Sri Aurobindo Marg, Delhi - DPCC (3 Kms)",
            "outdoor_deviceID": "DELDPCC018",
            "contact_person": "Tanmay Tathagat",
            "contact_number": "9711442008",
            "emailID": "tanmay@edsglobal.com",
            "total_no_of_floors": "5",
            "installation_floor_no": "1",
            "total_build_up_area_sq_m": "0",
            "occupancy": "0",
            "created_on": "2024-09-30 09:08:19",
            "updated_on": "2024-09-30 09:08:19"
        },
        {
            "deviceID": "1203240080",
            "deployementID": "RESF-007",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-06-09 00:00:00",
            "uninstallation_date": null,
            "address": "F-5, 318-N, Chirag Delhi, Delhi-110017",
            "latitude": "28.5367",
            "longitude": "77.2277",
            "nearby_AQI_station": "SiriFort, Delhi-CPCB (2 Kms)",
            "outdoor_deviceID": "DELCPCB005",
            "contact_person": "Mr. Abhishek Jain",
            "contact_number": "9990333248",
            "emailID": "abhishek@edsglobal.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "850",
            "occupancy": "3",
            "created_on": "2024-09-25 07:21:43",
            "updated_on": "2024-09-25 07:21:43"
        },
        {
            "deviceID": "1201240074",
            "deployementID": "RESF-008",
            "typology": "Residential",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Living Room",
            "installation_date": "2024-03-18 00:00:00",
            "uninstallation_date": null,
            "address": "F-5, 318-N, Chirag Delhi, Delhi-110017",
            "latitude": "28.536",
            "longitude": "77.225",
            "nearby_AQI_station": "SiriFort, Delhi-CPCB (2 Kms)",
            "outdoor_deviceID": "DELCPCB005",
            "contact_person": "Mr. Abhishek Jain",
            "contact_number": "9990333248",
            "emailID": "abhishek@edsglobal.com",
            "total_no_of_floors": "5",
            "installation_floor_no": "1",
            "total_build_up_area_sq_m": "850",
            "occupancy": "3",
            "created_on": "2024-07-18 11:04:32",
            "updated_on": "2024-07-18 11:04:32"
        },
        {
            "deviceID": "1203240077",
            "deployementID": "REWZ - 21",
            "typology": "Apartment",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom",
            "installation_date": "2024-05-05 00:00:00",
            "uninstallation_date": null,
            "address": "B-2/51-A, Keshav Puram",
            "latitude": "28.684",
            "longitude": "77.1605",
            "nearby_AQI_station": "Delhi-35",
            "outdoor_deviceID": "DELDPCC014",
            "contact_person": "Gurneet Singh",
            "contact_number": "9899240140",
            "emailID": "gurneet.singh@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "0",
            "total_build_up_area_sq_m": "110",
            "occupancy": "4",
            "created_on": "2024-09-30 04:55:51",
            "updated_on": "2024-09-30 04:55:51"
        },
        {
            "deviceID": "1203240082",
            "deployementID": "REWZ - 22",
            "typology": "Apartment",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": "Bedroom - Prabhansh Room",
            "installation_date": "2024-05-05 00:00:00",
            "uninstallation_date": null,
            "address": "B-2/51-A, Keshav Puram",
            "latitude": "28.6839",
            "longitude": "77.1604",
            "nearby_AQI_station": "Delhi-35",
            "outdoor_deviceID": "DELDPCC014",
            "contact_person": "Gurneet Singh",
            "contact_number": "9899240140",
            "emailID": "gurneet.singh@gmail.com",
            "total_no_of_floors": "4",
            "installation_floor_no": "0",
            "total_build_up_area_sq_m": "110",
            "occupancy": "4",
            "created_on": "2024-09-30 04:56:00",
            "updated_on": "2024-09-30 04:56:00"
        },
        {
            "deviceID": "1202240029",
            "deployementID": "SCD8-017",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-27 00:14:07",
            "uninstallation_date": null,
            "address": "St. Mary's School, Dwarka Sec-19",
            "latitude": "28.5749",
            "longitude": "77.049",
            "nearby_AQI_station": "Dwarka Sec-8",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Mrs. Reena Khurana",
            "contact_number": "9811349418",
            "emailID": "reenakhuhrana415@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "25900",
            "occupancy": "40",
            "created_on": "2024-09-16 05:21:05",
            "updated_on": "2024-09-16 05:21:05"
        },
        {
            "deviceID": "1202240028",
            "deployementID": "SCD8-020",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-29 00:14:07",
            "uninstallation_date": null,
            "address": "St. Mary's School, Dwarka Sec-19",
            "latitude": "28.5748",
            "longitude": "77.0489",
            "nearby_AQI_station": "Dwarka Sec-8",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Mrs. Reena Khurana",
            "contact_number": "9811349418",
            "emailID": "reenakhuhrana415@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "25900",
            "occupancy": "45",
            "created_on": "2024-09-16 05:21:14",
            "updated_on": "2024-09-16 05:21:14"
        },
        {
            "deviceID": "1202240010",
            "deployementID": "SCD8-18",
            "typology": "Office",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-27 00:14:07",
            "uninstallation_date": null,
            "address": "St. Mary's School, Dwarka Sec-19",
            "latitude": "28.5749",
            "longitude": "77.049",
            "nearby_AQI_station": "Dwarka Sec-8",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Mrs. Reena Khurana",
            "contact_number": "9811349418",
            "emailID": "reenakhuhrana415@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "-1",
            "total_build_up_area_sq_m": "25900",
            "occupancy": "50",
            "created_on": "2024-09-16 05:21:19",
            "updated_on": "2024-09-16 05:21:19"
        },
        {
            "deviceID": "1202240012",
            "deployementID": "SCD8-19",
            "typology": "School",
            "active": "1",
            "primary_sensor": "1",
            "spaceType": null,
            "installation_date": "2024-03-29 00:14:07",
            "uninstallation_date": null,
            "address": "St. Mary's School, Dwarka Sec-19",
            "latitude": "28.5748",
            "longitude": "77.0489",
            "nearby_AQI_station": "Dwarka Sec-8",
            "outdoor_deviceID": "DELDPCC016",
            "contact_person": "Mrs. Reena Khurana",
            "contact_number": "9811349418",
            "emailID": "reenakhuhrana415@gmail.com",
            "total_no_of_floors": "2",
            "installation_floor_no": "2",
            "total_build_up_area_sq_m": "25900",
            "occupancy": "20",
            "created_on": "2024-07-18 11:04:41",
            "updated_on": "2024-07-18 11:04:41"
        }
];

// deviceData.forEach(device => {
//     new mapboxgl.Marker()
//         .setLngLat([parseFloat(device.longitude), parseFloat(device.latitude)])
//         .setPopup(new mapboxgl.Popup({ offset: 25 }) // Add popups
//             .setHTML(`<h3>${device.deviceID}</h3><p>${device.address}</p><p>Contact: ${device.contact_person}</p>`)
//         )
//         .addTo(map);
// });
deviceData.forEach(device => {
    // Create a custom HTML element for the grey box
    const markerElement = document.createElement('div');
    markerElement.style.backgroundColor = '#d8d8d6';
    markerElement.style.width = '40px'; // Adjust width as needed
    markerElement.style.height = '30px'; // Adjust height as needed
    markerElement.style.borderRadius = '4px'; // Optional: make it rounded
    markerElement.style.cursor = 'pointer'; // Optional: show pointer cursor on hover
    markerElement.style.display = 'flex';
    markerElement.style.alignItems = 'center';
    markerElement.style.justifyContent = 'center';
    markerElement.style.color = 'white';
    markerElement.style.fontSize = '12px'; // Optional: adjust font size
    markerElement.style.textAlign = 'center';
    markerElement.style.lineHeight = '40px'; // Optional: center text vertically

    // Add text or other content inside the marker element if needed
    // markerElement.innerText = 'A'; // Example text

    // Create and add the marker to the map
    new mapboxgl.Marker(markerElement)
        .setLngLat([parseFloat(device.longitude), parseFloat(device.latitude)])
        .setPopup(new mapboxgl.Popup({ offset: 25 }) // Add popups
            //.setHTML(`<h3>${device.deviceID}</h3><p>${device.address}</p><p>Contact: ${device.contact_person}</p>`)
            .setHTML('offline')
        )
        .addTo(map);
});

const myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");

const raw = JSON.stringify({
    // Add any request body parameters if needed
});

const requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: raw,
    redirect: "follow"
};

var dep_data = [];


// Fetch data from API
fetch("https://iaq-dashboard.edsglobal.com/api/dashboard/getPinData", requestOptions)
    .then(response => response.json())
    .then(data => {
        console.log(data.Data);
        var total_pin = data.RowCount;
        $('.monitor_count').text("No monitor selected")


        $('#monitor_count2').text(total_pin + " monitors online");
        $('.map_total_device_count').val(total_pin);
        
        if (!Array.isArray(data.Data)) {
            throw new Error('Data is not an array');
        }
        
        dep_data = data.Data;

        // Initial markers creation
        updateMarkers("aqi"); // Default map view
        
        // Event delegation for marker clicks
        $(document).on('click', '.marker', function() {
            var deviceID = $(this).data('deviceId');
            // "<span class='bold'> Device ID: </span>" + deviceID +
            var span_text = 
                " <p style='color: black; margin-top: 5px; margin-bottom: 5px;'> AQI: " +
                $(this).data('indoorAqi') + " | PM2.5: " + $(this).data('indoorPm25') + 
                " | PM10: " + $(this).data('indoorPm10') + " | CO2: " + 
                $(this).data('indoorCo2') + " | TVOCs: " + $(this).data('indoorVoc') + "</p>";

            $('.monitor_count').html(span_text);
            $('.map_active_deviceID').val(deviceID);
            // $('#btn_active_sensor').removeClass('hide_element');
            // $('#single_sensor_row').removeClass('hide_element');
        });
    })
    .catch(error => {
        console.error('Error fetching data from API:', error);
    });

    




// Function to handle button clicks for different pollutants
function handleMapButtonClick(buttonId, pollutant) {
    $(buttonId).click(function() {
        // Add 'active' class to the clicked button
        $(this).addClass('active');
        
        // Remove 'active' class from other buttons in the pollutants-section
        $('.pollutants-section .btn').not(this).removeClass('active');
        
        // Call function to update markers
        updateMarkers(pollutant);
    });
}

// Bind click events to map buttons
handleMapButtonClick('#btnpm25_map', 'pm25');
handleMapButtonClick('#btnpm10_map', 'pm10');
handleMapButtonClick('#btnaqi_map', 'aqi');
handleMapButtonClick('#btnco2_map', 'co2');
handleMapButtonClick('#btntvoc_map', 'voc');

// Function to update markers based on selected pollutant
function updateMarkers(pollutant) {
    // Remove existing markers from the map
    var markers = document.getElementsByClassName('marker');
    while (markers[0]) {
        markers[0].parentNode.removeChild(markers[0]);
    }

    // Create markers based on selected pollutant
    // dep_data.forEach(function(markerData) {
    //     var el = document.createElement('div');
    //     el.className = 'marker'; // Use a class for event delegation
    //     el.dataset.deviceId = markerData.deviceID;
    //     el.dataset.indoorAqi = markerData.indoor_aqi;
    //     el.dataset.indoorPm25 = markerData.indoor_pm25;
    //     el.dataset.indoorPm10 = markerData.indoor_pm10;
    //     el.dataset.indoorCo2 = markerData.indoor_co2;
    //     el.dataset.indoorVoc = markerData.indoor_voc;
        
    //     var content = "";
    //     switch (pollutant) {
    //         case "pm25":
    //             content = `<div class='indoor'>${markerData.indoor_pm25}</div>
    //                        <div class='outdoor'>${markerData.outdoor_pm25}</div>`;
    //             break;
    //         case "pm10":
    //             content = `<div class='indoor'>${markerData.indoor_pm10}</div>
    //                        <div class='outdoor'>${markerData.outdoor_pm10}</div>`;
    //             break;
    //         case "aqi":
    //             content = `<div class='indoor'>${markerData.indoor_aqi}</div>
    //                        <div class='outdoor'>${markerData.outdoor_aqi}</div>`;
    //             break;
    //         case "co2":
    //             content = `${markerData.indoor_co2}`;
    //             el.style.width = "40px";
    //             el.style.padding = "10px 0 0 0";
    //             break;
    //         case "voc":
    //             content = `${markerData.indoor_voc}`;
    //             el.style.width = "40px";
    //             el.style.padding = "10px 0 0 0";
    //             break;
    //     }
    //     el.innerHTML = content;

    //     new mapboxgl.Marker(el)
    //         .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
    //         .addTo(map);
    // });
    dep_data.forEach(function(markerData) {
    var el = document.createElement('div');
    el.className = 'marker'; // Use a class for event delegation
    el.dataset.deviceId = markerData.deviceID;
    el.dataset.indoorAqi = markerData.indoor_aqi;
    el.dataset.indoorPm25 = markerData.indoor_pm25;
    el.dataset.indoorPm10 = markerData.indoor_pm10;
    el.dataset.indoorCo2 = markerData.indoor_co2;
    el.dataset.indoorVoc = markerData.indoor_voc;
    
    var content = "";
    switch (pollutant) {
        case "pm25":
            content = `<div class='indoor'>${markerData.indoor_pm25}</div>
                       <div class='outdoor'>${markerData.outdoor_pm25}</div>`;
            break;
        case "pm10":
            content = `<div class='indoor'>${markerData.indoor_pm10}</div>
                       <div class='outdoor'>${markerData.outdoor_pm10}</div>`;
            break;
        case "aqi":
            content = `<div class='indoor'>${markerData.indoor_aqi}</div>
                       <div class='outdoor'>${markerData.outdoor_aqi}</div>`;
            break;
        case "co2":
            content = `${markerData.indoor_co2}`;
            el.style.width = "40px";
            el.style.padding = "10px 0 0 0";
            break;
        case "voc":
            content = `${markerData.indoor_voc}`;
            el.style.width = "40px";
            el.style.padding = "10px 0 0 0";
            break;
    }
    el.innerHTML = content;

    // Add click event listener to each marker
    el.addEventListener('click', function() {
        // Remove 'selected' class from all markers
        document.querySelectorAll('.marker').forEach(marker => {
            marker.classList.remove('selected');
        });

        // Add 'selected' class to the clicked marker
        el.classList.add('selected');
    });

    new mapboxgl.Marker(el)
        .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
        .addTo(map);
});

}
</script>


    <!-- /# load pins on map script -->
    <script>
        function scrollToOffice() {
            var element = document.getElementById('office_row');
            var headerOffset = 145;
            var elementPosition = element.getBoundingClientRect().top;
            var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        
            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });   
        }
    </script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- for linechart  -->
    
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="<?php echo $_SESSION['config']->server_host?>/chart_JS_api/linechart1.js"></script>
    <script src="<?php echo $_SESSION['config']->server_host?>/chart_JS_api/boxplot_2.js"></script>

    <!-- <script>
        // script for updating line chart
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/linechart.php';
            var duration = $('#hid_duration_S_sensor').val();
            var typology = ['All']; //$('#typology').val();
            var spaceType = ['All']; //$('#spaceType').val();
            var sensorID = ['1202240009'];//$('#sensorID').val();
            var pollutants = $('#hid_pollutants_S_sensor').val();
            getLinechart1(duration, typology,  spaceType, sensorID, pollutants, post_url);

            // $('#btn_active_sensor').click(function() {
            //     document.getElementById('single_sensor_row').scrollIntoView();
            //     var pollutants = $('#hid_pollutants_S_sensor').val();
            //     var duration =  $('#hid_duration_S_sensor').val();
            //     var typology = ['All'];
            //     var spaceType = ['All']; 
            //     var sensorID =[$('#map_active_deviceID').val()];// ['1202240025'];
            //     $('#active_sensor').text(sensorID); 
            //     getLinechart1(duration, typology, spaceType, sensorID, pollutants,post_url);
            // });
            getLinechart1(duration, typology, spaceType, sensorID, pollutants,post_url);

            $('#btnduration1d_S_sensor').click(function() {
                $(this).addClass('active');
                $('#btnduration7d_S_sensor').removeClass('active')
                $('#btnduration30d_S_sensor').removeClass('active')
                $('#btndurationAll_S_sensor').removeClass('active')
                var pollutants = $('#hid_pollutants_S_sensor').val();
                var duration =  '24hour';
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID =[$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#hid_duration_S_sensor').val('24hour');
                $('#active_sensor').text(sensorID); 
                getLinechart1(duration, typology, spaceType, sensorID, pollutants,post_url);
            });
            $('#btnduration7d_S_sensor').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_S_sensor').removeClass('active')
                $('#btnduration30d_S_sensor').removeClass('active')
                $('#btndurationAll_S_sensor').removeClass('active')
                var pollutants = $('#hid_pollutants_S_sensor').val();
                var duration =  'week';
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_duration_S_sensor').val('week');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnduration30d_S_sensor').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_S_sensor').removeClass('active')
                $('#btnduration7d_S_sensor').removeClass('active')
                $('#btndurationAll_S_sensor').removeClass('active')
                var pollutants = $('#hid_pollutants_S_sensor').val();
                var duration =  'month';
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_duration_S_sensor').val('month');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btndurationAll_S_sensor').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_S_sensor').removeClass('active')
                $('#btnduration7d_S_sensor').removeClass('active')
                $('#btnduration30d_S_sensor').removeClass('active')
                var pollutants = $('#hid_pollutants_S_sensor').val();
                var duration =  'ytd';
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_duration_S_sensor').val('ytd');
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            //line chart for single sensor pollutant 
            $('#btnaqi_sensor').click(function() {
                $(this).addClass('active');
                $('#btnpm25_sensor').removeClass('active')
                $('#btnpm10_sensor').removeClass('active')
                $('#btnco2_sensor').removeClass('active')
                $('#btntvoc_sensor').removeClass('active')
                var duration =  $('#hid_duration_S_sensor').val();;
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID =[$('#map_active_deviceID').val()];//  ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_pollutants_S_sensor').val('aqi');
                pollutants = "aqi";
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnpm25_sensor').click(function() {
                $(this).addClass('active');
                $('#btnaqi_sensor').removeClass('active')
                $('#btnpm10_sensor').removeClass('active')
                $('#btnco2_sensor').removeClass('active')
                $('#btntvoc_sensor').removeClass('active')
                var duration =  $('#hid_duration_S_sensor').val();;
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_pollutants_S_sensor').val('pm25');
                pollutants = "pm25";
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnpm10_sensor').click(function() {
                $(this).addClass('active');
                $('#btnpm25_sensor').removeClass('active')
                $('#btnaqi_sensor').removeClass('active')
                $('#btnco2_sensor').removeClass('active')
                $('#btntvoc_sensor').removeClass('active')
                var duration =  $('#hid_duration_S_sensor').val();;
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_pollutants_S_sensor').val('pm10');
                pollutants = "pm10";
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btnco2_sensor').click(function() {
                $(this).addClass('active');
                $('#btnpm25_sensor').removeClass('active')
                $('#btnpm10_sensor').removeClass('active')
                $('#btnaqi_sensor').removeClass('active')
                $('#btntvoc_sensor').removeClass('active')
                var duration =  $('#hid_duration_S_sensor').val();;
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_pollutants_S_sensor').val('co2');
                pollutants = "co2";
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });
            $('#btntvoc_sensor').click(function() {
                $(this).addClass('active');
                $('#btnpm25_sensor').removeClass('active')
                $('#btnpm10_sensor').removeClass('active')
                $('#btnco2_sensor').removeClass('active')
                $('#btnaqi_sensor').removeClass('active')
                var duration =  $('#hid_duration_S_sensor').val();;
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID = [$('#map_active_deviceID').val()];// ['1202240025']; 
                $('#active_sensor').text(sensorID); 
                $('#hid_pollutants_S_sensor').val('voc');
                pollutants = "voc";
                getLinechart1(duration, typology,  spaceType, sensorID,pollutants, post_url);
            });

            $('#btnback2map').click(function() {
                device_count = $('#map_total_device_count').val();
                $('#monitor_count').text(device_count + " monitors");
                $('#map_active_deviceID').val("none");
                $('#btn_active_sensor').addClass('hide_element');
                $('#single_sensor_row').addClass('hide_element');
                document.getElementById('map_row').scrollIntoView();
            });
        });


    </script> -->

    <script>
    $(document).ready(function() {
        var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/linechart.php';
        var duration, typology = ['All'], spaceType = ['All'], sensorID, pollutants;

        // Initial setup for the line chart
        function initializeLineChart() {
            duration = $('#hid_duration_S_sensor').val();
            sensorID = ['']; // Default sensor ID
            pollutants = $('#hid_pollutants_S_sensor').val();
            getLinechart1(duration, typology, spaceType, sensorID, pollutants, post_url);
        }

        initializeLineChart();

        // Function to update the line chart based on selected device
        function updateLineChartForDevice(deviceID) {
            duration = $('#hid_duration_S_sensor').val();
            typology = ['All'];
            spaceType = ['All'];
            sensorID = [deviceID];
            $('#active_sensor').text(sensorID);
            pollutants = $('#hid_pollutants_S_sensor').val();
            getLinechart1(duration, typology, spaceType, sensorID, pollutants, post_url);
        }

        // Event delegation for marker clicks
        $(document).on('click', '.marker', function() {
            var deviceID = $(this).data('deviceId');
            $('.monitor_count').html("<p style='color: black; margin-top: 5px; margin-bottom: 5px;'> AQI: " +
                $(this).data('indoorAqi') + " | PM2.5: " + $(this).data('indoorPm25') +
                " | PM10: " + $(this).data('indoorPm10') + " | CO2: " +
                $(this).data('indoorCo2') + " | TVOCs: " + $(this).data('indoorVoc') + "</p>");
            $('.map_active_deviceID').val(deviceID);

            // Update the line chart for the selected device
            $('#linechart1').removeClass('hidden');
            $('#chartMessage').addClass('hidden');
            updateLineChartForDevice(deviceID);
        });

        // Button click handlers for duration buttons
        $('#btnduration1d_S_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_duration_S_sensor').val('24hour');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnduration7d_S_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_duration_S_sensor').val('week');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnduration30d_S_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_duration_S_sensor').val('month');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btndurationAll_S_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_duration_S_sensor').val('ytd');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        // Button click handlers for pollutant buttons
        $('#btnaqi_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_pollutants_S_sensor').val('aqi');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnpm25_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_pollutants_S_sensor').val('pm25');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnpm10_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_pollutants_S_sensor').val('pm10');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnco2_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_pollutants_S_sensor').val('co2');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btntvoc_sensor').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            $('#hid_pollutants_S_sensor').val('voc');
            updateLineChartForDevice($('.map_active_deviceID').val());
        });

        $('#btnback2map').click(function() {
            var device_count = $('#map_total_device_count').val();
            $('#monitor_count').text(device_count + " monitors");
            $('#map_active_deviceID').val("none");
            $('#btn_active_sensor').addClass('hide_element');
            $('#single_sensor_row').addClass('hide_element');
            document.getElementById('map_row').scrollIntoView();
        });
    });
</script>

<script>
        // script for updating box chart Residentail
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/boxplot.php';
            var duration = $('#hid_duration_R_boxplot').val();
            var typology = ['Residential']; //$('#typology_boxplot').val();
            var spaceType = ['All']; //$('#spaceType_boxplot').val();
            var sensorID = ['All']; //$('#sensorID_boxplot').val();
            var pollutants = 'aqi';
            var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
            getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            $('#btnduration1d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = '24hour'; 
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('24hour');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btnduration7d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'week';  
                var typology =['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('week');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btnduration30d_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btndurationAll_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'month'; 
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('month');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btndurationAll_R_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_R_boxplot').removeClass('active')
                $('#btnduration7d_R_boxplot').removeClass('active')
                $('#btnduration30d_R_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_R_boxplot').val();
                var duration = 'ytd';  
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_R_boxplot').val('ytd');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            //Residential pollutants button click
            $('#btnaqi_R_box').click(function() {
                $(this).addClass('active');
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'aqi';
                $('#hid_pollutants_R_boxplot').val('aqi');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btnpm25_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm25';
                $('#hid_pollutants_R_boxplot').val('pm25');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btnpm10_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm10';
                $('#hid_pollutants_R_boxplot').val('pm10');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btnco2_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btntvoc_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                pollutants = 'co2';
                var sensorID = ['All']; 
                $('#hid_pollutants_R_boxplot').val('co2');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            $('#btntvoc_R_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_R_box').removeClass('active')
                $('#btnpm25_R_box').removeClass('active')
                $('#btnpm10_R_box').removeClass('active')
                $('#btnco2_R_box').removeClass('active')
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'voc';
                $('#hid_pollutants_R_boxplot').val('voc');
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology, spaceType, sensorID, pollutants, indoorCondition, post_url, 'boxchart1');
            });
            //Residential Indoor condition button event
            $('#btnWTemp_R_box').click(function() {
                //$(this).addClass('active');
                //$('#btnWRH_R_box').removeClass('active')
                $('#hid_indoorConditon_R_boxplot').val('none');
                $(this).toggleClass("active");
                if ($(this).hasClass("active")){
                    $('#hid_indoorConditon_R_boxplot').val('temp');
                    $('#btnWRH_R_box').removeClass('active')
                }
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = $('#hid_pollutants_R_boxplot').val();
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants, indoorCondition, post_url, 'boxchart1');

            });
            $('#btnWRH_R_box').click(function() {
                //$(this).addClass('active');
                //$('#btnWTemp_R_box').removeClass('active')
                $('#hid_indoorConditon_R_boxplot').val('none');
                $(this).toggleClass("active");
                if ($(this).hasClass("active")){
                    $('#hid_indoorConditon_R_boxplot').val('RH');
                    $('#btnWTemp_R_box').removeClass('active')
                }
                var duration = $('#hid_duration_R_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = $('#hid_pollutants_R_boxplot').val();
                var indoorCondition = $('#hid_indoorConditon_R_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID,pollutants,indoorCondition, post_url, 'boxchart1');
            });
        });
    </script>


<script>
        // script for updating box chart Office
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/boxplot.php';
            var duration = $('#hid_duration_O_boxplot').val();
            var typology = ['Office']; //$('#typology_boxplot').val();
            var spaceType = ['All']; //$('#spaceType_boxplot').val();
            var sensorID = ['All']; //$('#sensorID_boxplot').val();
            var pollutants = 'aqi';
            var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
            getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            $('#btnduration1d_O_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration7d_O_boxplot').removeClass('active')
                $('#btnduration30d_O_boxplot').removeClass('active')
                $('#btndurationAll_O_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_O_boxplot').val();
                var duration = '24hour'; 
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_O_boxplot').val('24hour');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btnduration7d_O_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_O_boxplot').removeClass('active')
                $('#btnduration30d_O_boxplot').removeClass('active')
                $('#btndurationAll_O_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_O_boxplot').val();
                var duration = 'week';  
                var typology =['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_O_boxplot').val('week');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btnduration30d_O_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_O_boxplot').removeClass('active')
                $('#btnduration7d_O_boxplot').removeClass('active')
                $('#btndurationAll_O_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_O_boxplot').val();
                var duration = 'month'; 
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_O_boxplot').val('month');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btndurationAll_O_boxplot').click(function() {
                $(this).addClass('active');
                $('#btnduration1d_O_boxplot').removeClass('active')
                $('#btnduration7d_O_boxplot').removeClass('active')
                $('#btnduration30d_O_boxplot').removeClass('active')
                var pollutants = $('#hid_pollutants_O_boxplot').val();
                var duration = 'ytd';  
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                $('#hid_duration_O_boxplot').val('ytd');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');

            });
            //Office pollutants button click
            $('#btnaqi_O_box').click(function() {
                $(this).addClass('active');
                $('#btnpm25_O_box').removeClass('active')
                $('#btnpm10_O_box').removeClass('active')
                $('#btnco2_O_box').removeClass('active')
                $('#btntvoc_O_box').removeClass('active')
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'aqi';
                $('#hid_pollutants_O_boxplot').val('aqi');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btnpm25_O_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_O_box').removeClass('active')
                $('#btnpm10_O_box').removeClass('active')
                $('#btnco2_O_box').removeClass('active')
                $('#btntvoc_O_box').removeClass('active')
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm25';
                $('#hid_pollutants_O_boxplot').val('pm25');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btnpm10_O_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_O_box').removeClass('active')
                $('#btnpm25_O_box').removeClass('active')
                $('#btnco2_O_box').removeClass('active')
                $('#btntvoc_O_box').removeClass('active')
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'pm10';
                $('#hid_pollutants_O_boxplot').val('pm10');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btnco2_O_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_O_box').removeClass('active')
                $('#btnpm25_O_box').removeClass('active')
                $('#btnpm10_O_box').removeClass('active')
                $('#btntvoc_O_box').removeClass('active')
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Office'];
                var spaceType = ['All']; 
                pollutants = 'co2';
                var sensorID = ['All']; 
                $('#hid_pollutants_O_boxplot').val('co2');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');
            });
            $('#btntvoc_O_box').click(function() {
                $(this).addClass('active');
                $('#btnaqi_O_box').removeClass('active')
                $('#btnpm25_O_box').removeClass('active')
                $('#btnpm10_O_box').removeClass('active')
                $('#btnco2_O_box').removeClass('active')
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Office'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = 'voc';
                $('#hid_pollutants_O_boxplot').val('voc');
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();      
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');

            });

            //Residential Indoor condition button event
            $('#btnWTemp_O_box').click(function() {
                //$(this).addClass('active');
                //$('#btnWRH_R_box').removeClass('active')
                $('#hid_indoorConditon_O_boxplot').val('none');
                $(this).toggleClass("active");
                if ($(this).hasClass("active")){
                    $('#hid_indoorConditon_O_boxplot').val('temp');
                    $('#btnWRH_O_box').removeClass('active')
                }
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = $('#hid_pollutants_O_boxplot').val();
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');

            });
            $('#btnWRH_O_box').click(function() {
                //$(this).addClass('active');
                //$('#btnWTemp_R_box').removeClass('active')
                $('#hid_indoorConditon_O_boxplot').val('none');
                $(this).toggleClass("active");
                if ($(this).hasClass("active")){
                    $('#hid_indoorConditon_O_boxplot').val('RH');
                    $('#btnWTemp_O_box').removeClass('active')
                }
                var duration = $('#hid_duration_O_boxplot').val();
                var typology = ['Residential'];
                var spaceType = ['All']; 
                var sensorID = ['All']; 
                pollutants = $('#hid_pollutants_O_boxplot').val();
                var indoorCondition = $('#hid_indoorConditon_O_boxplot').val();
                getBoxplot(duration, typology,  spaceType, sensorID, pollutants,indoorCondition, post_url, 'boxchart1_office');

            });
        });
    </script>
