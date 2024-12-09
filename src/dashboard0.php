<!-- Header-->   
<?php include 'partials/header.php' ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- /#header -->

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
    justify-content: flex-end;
    align-items: center; /* Center align items vertically */
    margin-bottom: 10px;
    margin-left: -35px; /* Space below the legend */
}

.map-legend span {
    display: inline-block; /* Make sure span behaves like a block element for size */
    width: 20px; /* Width of the square */
    height: 20px; /* Height of the square */
    margin-right: 10px; /* Space between squares and text */
    /* border: 1px solid #000; Optional: border to make the squares visible */
}

.indoor {
    background-color: #2fb996; /* Example color for Indoor */
}

.outdoor {
    background-color: #f16463; /* Example color for Outdoor */
    
}

.note {
    display: block; /* Ensure the note is on a new line */
    margin-top: 10px; /* Space above the note */
}
.bold {
    font-weight: bold;
}
#loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 50px;
    height: 50px;
    border: 5px solid rgba(0, 0, 0, 0.1);
    border-top: 5px solid #000;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: none; /* Initially hidden */
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>

<div class="content" style = "margin-top : -72px; overflow-x: hidden;">
    <!-- Animated -->
    <div class="animated fadeIn">
        
        <!-- map -->
        <div class="row" id="map_row">
            <div class="col-lg-12">
                <!-- Map card -->
                <div class="card">
                    <div class="card-body" >
                        
                        <div class="row">
                            <!-- place map here-->
                            <div class="col-lg-10">
                                <h4 class="dashboard_title text-center">Indoor Air Quality Monitors</h4>
                                <div id="map" style="position: relative; overflow:hidden; width:100%; height:460px "></div>
                                <div id="loader" class="loader"></div>
                                <!--map pin showing average value of selected pollutants (median) for last hour -->
                                
                                <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $current_dt = new DateTime();
                                    $start_dt = clone $current_dt;
                                    $start_dt->modify('-1 hour');
                                    // Format datetimes as strings (optional)
                                    $current_dt_string = $current_dt->format('Y-m-d H:00:00');
                                    $start_dt_string = $start_dt->format('Y-m-d H:00:00');
                                    // $note_msg = "Data last updated on <b>$current_dt_string</b>. <a href = "#section2" >Refer general notes for additional information."</a>
                                    $note_msg = "Data last updated on <b>$current_dt_string</b>. Refer <a href='#section2'>general notes</a> for additional information.";

                                ?>
                               <div class="row " style="float:left;" > 
                                    <div class="map-legend" >
                                        <span class="indoor" style="width:18px; height:18px; padding:5px;float:none; border-radius: 3px;"> </span>  Indoor
                                        <span class="outdoor" style="width:18px; height:18px; padding:5px; margin-left: 50px; border-radius: 3px;">  </span> Outdoor
                                    </div>
                                    <div>
                                <span class="note"><b>Note: </b> <?php echo $note_msg; ?> </span>
                                </div>
                                </div>
                                <!-- <div>
                                <span class="note"><b>Note: </b> <?php echo $note_msg; ?> </span>
                                </div> -->
                            </div>
                            <div class="col-lg-2">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px; ">  <!-- display:block -->
                                    <h4>Select Pollutant</h4>
                                    <button type="button" class="btn active" id="btnaqi_map" name="btnaqi_map" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_map" name="btnpm25_map" >PM<sub>2.5</sub> </button>
                                    <button type="button" class="btn" id="btnpm10_map" name="btnpm10_map" >PM<sub>10</sub></button>
                                    <button type="button" class="btn" id="btnco2_map" name="btnco2_map">CO<sub>2</sub></button>
                                    <button type="button" class="btn" id="btntvoc_map" name="btntvoc_map"  >TVOCs</button>
                                </div>

                                <!-- Typology-->
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px;"> 
                                    <h4>Select Typology</h4>
                                    <button type="button" class="btn_typology" id="btnResidential_map" name="btnResidential_map" onClick="document.getElementById('residential_row').scrollIntoView();" >Residential</button>
                                    <button type="button" class="btn_typology" id="btnOffice_map" name="btnOffice_map" onclick="scrollToOffice()">Office</button>
                                    <button type="button" class="btn_typology" id="btnSchool_map" name="btnSchool_map" disabled>School</button>
                                </div>
                                <!-- Pin Info-->
                                 
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px; "> 
                                <h4>Monitor Details:</h4>
                                    <div class="card">
                                        <div class="card-body map-card" style="padding: 0px; margin-top: 5px; margin-bottom: 10px;">
                                            <span id="monitor_count">0</span> 
                                            
                                            <input type="hidden" id="map_active_deviceID" name="map_active_deviceID" value="none">  
                                            <input type="hidden" id="map_total_device_count" name="map_total_device_count" value="none">  
                                            <button style = "align: left; margin: 0px;" type="button" class="btn active hide_element" id="btn_active_sensor" name="btn_active_sensor" style="width:auto;"  >Go</button>
                                    
                                        </div>

                                    </div>
                                    <button type="button" class="btn active hide_element" id="btn_active_sensor" name="btn_active_sensor" style="width:auto; "  >Active Device Data</button>

                                </div>

                                <!-- map legend-->
                                 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# Map card -->
            </div>                  
        </div>
        <!-- /#map -->

        <!-- chart2 - box plot chart (Residential typology) -->
        <div class="row" id="residential_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Indoor Air Quality Trend - Residential</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                                <input type="button" class="btn_duration active" id="btnduration1d_R_boxplot" name="btnduration1d_R_boxplot" value="1d">
                                                <input type="button" class="btn_duration" id="btnduration7d_R_boxplot" name="btnduration7d_R_boxplot" value="7d"   >
                                                <input type="button" class="btn_duration" id="btnduration30d_R_boxplot" name="btnduration30d_R_boxplot" value="30d"  >
                                                <input type="button" class="btn_duration" id="btndurationAll_R_boxplot" name="btndurationAll_R_boxplot" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration_R_boxplot" name="hid_duration_R_boxplot" value="24hour">
                                            <input type="hidden" id="hid_pollutants_R_boxplot" name="hid_pollutants_R_boxplot" value="aqi">
                                            <input type="hidden" id="hid_indoorConditon_R_boxplot" name="hid_indoorConditon_R_boxplot" value="none">
                                            <div id="boxchart1" name="boxchart1" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $current_dt = new DateTime();
                                    $start_dt = clone $current_dt;
                                    $start_dt->modify('-1 hour');
                                    // Format datetimes as strings (optional)
                                    $current_dt_string = $current_dt->format('Y-m-d H:00:00');
                                    $start_dt_string = $start_dt->format('Y-m-d H:00:00');
                                    // $note_msg = "Data last updated on <b>$current_dt_string</b>. <a href = "#section2" >Refer general notes for additional information."</a>
                                    $note_msg = "Data last updated on <b>$current_dt_string</b>. Refer <a href='#section2'>general notes</a> for additional information.";

                                ?>
                                <span class="note"><b>Note: </b> <?php echo $note_msg; ?> </span>
                                            <!-- <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Residential typology</span> -->
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            <div class="col-lg-2">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px; display:block text-align: left"> 
                                    <h4>Select Pollutant</h4>
                                    <button type="button" class="btn active" id="btnaqi_R_box" name="btnaqi_R_box" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_R_box" name="btnpm25_R_box" >PM<sub>2.5</sub></button>
                                    <button type="button" class="btn" id="btnpm10_R_box" name="btnpm10_R_box" >PM<sub>10</sub> </button>
                                    <button type="button" class="btn" id="btnco2_R_box" name="btnco2_R_box">CO<sub>2</sub></button>
                                    <button type="button" class="btn" id="btntvoc_R_box" name="btntvoc_R_box"  >TVOCs</button>
                                </div>

                                <!-- Indoor context-->
                                <div class="row text-left " style="margin-top:15px; margin-bottom:10px; display:block text-align: left"> 
                                    <h4>Toggle Indoor Conditions</h4>
                                    <button type="button" class="btn" id="btnWTemp_R_box" name="btnWTemp_R_box" >Temp</button>
                                    <button type="button" class="btn" id="btnWRH_R_box" name="btnWRH_R_box" >RH</button><br>
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
        <div class="row" id="office_row">
            <div class="col-lg-12">
                <!-- line chart card -->
                <div class="card">
                    <div class="card-body" >
                        <!-- filter -->
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- box chart --> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" >
                                            <h4 class="dashboard_title text-center">Indoor Air Quality Trend - Office</h4>
                                            <div class="col-lg-6 col-md-6" style="align-content: end; text-align: left;">
                                                <input type="button" class="btn btn_duration active" id="btnduration1d_O_boxplot" name="btnduration1d_O_boxplot" value="1d">
                                                <input type="button" class="btn btn_duration" id="btnduration7d_O_boxplot" name="btnduration7d_O_boxplot" value="7d"   >
                                                <input type="button" class="btn btn_duration" id="btnduration30d_O_boxplot" name="btnduration30d_O_boxplot" value="30d"  >
                                                <input type="button" class="btn btn_duration" id="btndurationAll_O_boxplot" name="btndurationAll_O_boxplot" value="All"  >
                                            </div>
                                            <input type="hidden" id="hid_duration_O_boxplot" name="hid_duration_O_boxplot" value="24hour">
                                            <input type="hidden" id="hid_pollutants_O_boxplot" name="hid_pollutants_O_boxplot" value="aqi">
                                            <input type="hidden" id="hid_indoorConditon_O_boxplot" name="hid_indoorConditon_O_boxplot" value="none">
                                            
                                            <div id="boxchart1_office" name="boxchart1_office" style="position: relative; overflow:hidden; width: 100%; height:380px "></div>
                                            <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $current_dt = new DateTime();
                                    $start_dt = clone $current_dt;
                                    $start_dt->modify('-1 hour');
                                    // Format datetimes as strings (optional)
                                    $current_dt_string = $current_dt->format('Y-m-d H:00:00');
                                    $start_dt_string = $start_dt->format('Y-m-d H:00:00');
                                    // $note_msg = "Data last updated on <b>$current_dt_string</b>. <a href = "#section2" >Refer general notes for additional information."</a>
                                    $note_msg = "Data last updated on <b>$current_dt_string</b>. Refer <a href='#section2'>general notes</a> for additional information.";

                                ?>
                                <span class="note"><b>Note: </b> <?php echo $note_msg; ?> </span>
                                            <!-- <span class="note"><b>Note: </b>Chart showing box plot data for indoor sensor of Office typology</span> -->
                            
                                        </div>
                                    </div>
                                </div>
                                <!-- /# box chart -->
                            </div>
                            <div class="col-lg-2">
                                <!-- Pollutants-->
                                <div class="row text-left " style="margin-top:10px; margin-bottom:10px; display:block text-align: left"> 
                                    <h4>Select Pollutant</h4>
                                    <button type="button" class="btn active" id="btnaqi_O_box" name="btnaqi_O_box" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_O_box" name="btnpm25_O_box" >PM<sub>2.5</sub> </button>
                                    <button type="button" class="btn" id="btnpm10_O_box" name="btnpm10_O_box" >PM<sub>10</sub> </button>
                                    <button type="button" class="btn" id="btnco2_O_box" name="btnco2_O_box">CO<sub>2</sub></button>
                                    <button type="button" class="btn" id="btntvoc_O_box" name="btntvoc_O_box"  >TVOCs</button>
                                </div>

                                <!-- Indoor context-->
                                <div class="row text-left " style="margin-top:15px; margin-bottom:10px; display:block text-align: left"> 
                                    <h4>Toggle Indoor Conditions</h4>
                                    <button type="button" class="btn" id="btnWTemp_O_box" name="btnWTemp_O_box" >Temp</button>
                                    <button type="button" class="btn" id="btnWRH_O_box" name="btnWRH_O_box" >RH</button><br>
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
                                <!-- box chart --> 
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
                                    <h4>Select Pollutant</h4>
                                    <button type="button" class="btn active" id="btnaqi_sensor" name="btnaqi_sensor" >AQI</button>
                                    <button type="button" class="btn" id="btnpm25_sensor" name="btnpm25_sensor" >PM<sub>2.5</sub> </button>
                                    <button type="button" class="btn" id="btnpm10_sensor" name="btnpm10_sensor" >PM<sub>10</sub> </button>
                                    <button type="button" class="btn" id="btnco2_sensor" name="btnco2_sensor">CO<sub>2</sub> </button>
                                    <button type="button" class="btn" id="btntvoc_sensor" name="btntvoc_sensor"  >TVOCs</button>
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
                                
                                <h6 style="font-size: small;"><b>General Notes:</b> </h6>
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
        function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

// Hide the loader
function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}
mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2LW5pa3VuaiIsImEiOiJjbHMwYTNmdnowMDFxMmpyNTBteHoybTRwIn0.OEzenC6wBOTbqZXCUNoE7A';
        var map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/light-v11',
        //style: 'mapbox://styles/mapbox/satellite-v9',
        center: [0,0], // starting position [lng, lat] [77.2, 28.58]
        scrollZoom: true, // Disable scroll zoom
        dragPan: true, // Disable drag pan
        zoom: 1 // starting zoom //10

        });
        map.on('load', function() {
    showLoader();

    //Fly to desired position
    map.flyTo({
        center: [77.2, 28.53], // Center the map
        zoom: 10.6, // Zoom level
        speed: 0.6, // Animation speed
        curve: 3, // Animation curve
        easing: function(t) {
            return t;
        }
    });

    // Fetch data from API
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

    fetch("https://iaq-dashboard.edsglobal.com/api/dashboard/getPinData", requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log(data.Data);
            var total_pin = data.RowCount;
            $('#monitor_count').text(total_pin + " active monitors");
            $('#map_total_device_count').val(total_pin);

            if (!Array.isArray(data.Data)) {
                throw new Error('Data is not an array');
            }

            dep_data = data.Data;

            // Update markers on the map
            updateMarkers("aqi"); // Default map view

            // Hide loader after data loads
            hideLoader();
        })
        .catch(error => {
            console.error('Error fetching data from API:', error);
            hideLoader(); // Hide loader even on error
        });

        function handleMapButtonClick(buttonId, pollutant) {
    $(buttonId).click(function() {
        $(this).addClass('active');
        $('.btn').not(this).removeClass('active'); // Assumes all buttons have the 'map-button' class
        updateMarkers(pollutant); // Call function to update markers
        map.flyTo({
            center: [77.2, 28.53], // Center the map
            zoom: 10.6, // Zoom level
            speed: 0.6, // Animation speed
            curve: 3, // Animation curve
            easing: function(t) {
                return t;
            }
        });
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
    // Clear existing markers
    var markers = document.getElementsByClassName('marker');
    while (markers[0]) {
        markers[0].parentNode.removeChild(markers[0]);
    }

    // Create markers based on selected pollutant
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

        new mapboxgl.Marker(el)
            .setLngLat([parseFloat(markerData.longitude), parseFloat(markerData.latitude)])
            .addTo(map);
    });
}
});
// Function to handle button clicks for different pollutants

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

    <script>
        // script for updating line chart
        
        $(document).ready(function() {
            var post_url = '<?php echo $_SESSION['config']->server_host?>/chartData/linechart.php';
            var duration = $('#hid_duration_S_sensor').val();
            var typology = ['All']; //$('#typology').val();
            var spaceType = ['All']; //$('#spaceType').val();
            var sensorID = ['1202240025'];//$('#sensorID').val();
            var pollutants = $('#hid_pollutants_S_sensor').val();
            getLinechart1(duration, typology,  spaceType, sensorID, pollutants, post_url);

            $('#btn_active_sensor').click(function() {
                document.getElementById('single_sensor_row').scrollIntoView();
                var pollutants = $('#hid_pollutants_S_sensor').val();
                var duration =  $('#hid_duration_S_sensor').val();
                var typology = ['All'];
                var spaceType = ['All']; 
                var sensorID =[$('#map_active_deviceID').val()];// ['1202240025'];
                $('#active_sensor').text(sensorID); 
                getLinechart1(duration, typology, spaceType, sensorID, pollutants,post_url);
            });

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