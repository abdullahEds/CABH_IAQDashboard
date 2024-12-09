<?php
    ("Content-Type: application/json; charset=UTF-8");
    include 'db.php';
    function getTypology(){
        
        $conn = db_connect();
        $query = "select distinct typology from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $typology = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['typology']!= ""){
                        $typology[] = $row['typology'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($typology), 'Data' => $typology ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getLocation(){
        
        $conn = db_connect();
        $query = "select distinct nearby_AQI_station from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $location = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['nearby_AQI_station']!= ""){
                        $location[] = $row['nearby_AQI_station'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($location), 'Data' => $location ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getSpaceType(){
        
        $conn = db_connect();
        $query = "select distinct spaceType from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $spaceType = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['spaceType']!= ""){
                        $spaceType[] = $row['spaceType'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($spaceType), 'Data' => $spaceType ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getSensorID(){
        
        $conn = db_connect();
        $query = "select distinct deviceID from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $sensorID = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['deviceID']!= ""){
                        $sensorID[] = $row['deviceID'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($sensorID), 'Data' => $sensorID ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }


    function getDialData(){
        $conn = db_connect();


        /* $condition = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            $orderBy = $data["duration"];
            $start_limit = $data["typology"];
            $end_limit = $data["location"];
            //$start_date = $data["start_date"];
            //$end_date = $data["end_date"];
            
            foreach($data as $key => $value){
                $condition[$key] = $value;
            }  
            unset($condition["orderBy"]);         
            unset($condition["start_row"]);         
            unset($condition["end_row"]);  
            unset($condition["start_date"]);  
            unset($condition["end_date"]);  
            unset($condition["device_IDs"]);
                   
        }  */

        $query = "select count(distinct b.deviceID) as totalsite, avg(pm25) as pm25, avg(pm10) as pm10, avg(aqi) as aqi, avg(co2) as co2, avg(voc) as voc, avg(temp) as temp, avg(humidity) as humidity from reading_db a join device_details b on a.deviceID = b.deviceID where b.active=1";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {

                // Loop through each row of the result set
                $row = $result->fetch_assoc();
                $total_site = $row['totalsite'];   
                $avg_pm25 = $row['pm25'];
                $avg_pm10 = $row['pm10'];
                $avg_aqi = $row['aqi'];
                $avg_co2 = $row['co2'];
                $avg_voc = $row['voc'];
                $avg_temp = $row['temp'];
                $avg_hum = $row['humidity'];
                $response = array("totalsite"=>$total_site, "avg_pm25"=> $avg_pm25, "avg_pm10"=> $avg_pm10, "avg_aqi"=> $avg_aqi, "avg_co2"=> $avg_co2, "avg_voc"=> $avg_voc, "avg_temp" => $avg_temp, "avg_humidity"=> $avg_hum);
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'Data' => $response ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    // function getPinData(){
    //     $conn = db_connect();
    //     date_default_timezone_set('Asia/Kolkata');
    //     $current_dt = new DateTime();
    //     $start_dt = clone $current_dt;
    //     $start_dt->modify('-1 hour');
    //     // Format datetimes as strings (optional)
    //     $current_dt_string = $current_dt->format('Y-m-d H:00:00');
    //     $start_dt_string = $start_dt->format('Y-m-d H:00:00');

    //     // this query is for taking data from minute interval table
    //     // $query = "select b.deviceID,b.latitude, b.longitude,  max(a.pm25) as pm25, max(a.pm10) as pm10, max(a.aqi) as aqi, max(a.co2) as co2, max(a.voc) as voc, max(a.temp) as temp, max(a.humidity) as humidity, ".
    //     // " max(c.pm25) as outdoor_pm25, max(c.pm10) as outdoor_pm10, max(c.aqi) as outdoor_aqi,  max(c.temp) as outdoor_temp, max(c.humidity) as outdoor_humidity ".
    //     // " from reading_db a join device_details b on a.deviceID = b.deviceID ".
    //     // " join cpcb_data c on b.outdoor_deviceID = c.deviceID ".
    //     // " where b.active=1 and b.primary_sensor=1 and (a.datetime between '".$start_dt_string ."' and '". $current_dt_string ."') group by deviceID , latitude, longitude";
       
    //     //query to get avg of 1 hour indoor data for median pollutant and 1 hour avg data of outdoor pollutant
    //     // $query = "select b.deviceID,b.latitude, b.longitude,  avg(a.median_pm25) as pm25, avg(a.median_pm10) as pm10, avg(a.median_aqi) as aqi, avg(a.median_co2) as co2, avg(a.median_voc) as voc, avg(a.median_temp) as temp, avg(a.median_hum) as humidity, avg(c.pm25) as outdoor_pm25, avg(c.pm10) as outdoor_pm10, avg(c.aqi) as outdoor_aqi,  avg(c.temp) as outdoor_temp, avg(c.humidity) as outdoor_humidity  ".
    //     // " from reading_15min a join device_details b on a.deviceID = b.deviceID ".
    //     // " join cpcb_data c on b.outdoor_deviceID = c.deviceID ".
    //     // " where b.active=1 and b.primary_sensor=1 and (a.datetime between '".$start_dt_string ."' and '". $current_dt_string ."') group by deviceID , latitude, longitude";
        

    //     $query = "SELECT b.deviceID, 
    //              b.latitude, 
    //              b.longitude,  
    //              AVG(CASE WHEN a.median_pm25 != 0 THEN a.median_pm25 END) AS pm25, 
    //              AVG(CASE WHEN a.median_pm10 != 0 THEN a.median_pm10 END) AS pm10, 
    //              AVG(CASE WHEN a.median_aqi != 0 THEN a.median_aqi END) AS aqi, 
    //              AVG(CASE WHEN a.median_co2 != 0 THEN a.median_co2 END) AS co2, 
    //              AVG(CASE WHEN a.median_voc != 0 THEN a.median_voc END) AS voc, 
    //              AVG(CASE WHEN a.median_temp != 0 THEN a.median_temp END) AS temp, 
    //              AVG(CASE WHEN a.median_hum != 0 THEN a.median_hum END) AS humidity, 
    //              AVG(CASE WHEN c.pm25 != 0 THEN c.pm25 END) AS outdoor_pm25, 
    //              AVG(CASE WHEN c.pm10 != 0 THEN c.pm10 END) AS outdoor_pm10, 
    //              AVG(CASE WHEN c.aqi != 0 THEN c.aqi END) AS outdoor_aqi,  
    //              AVG(CASE WHEN c.temp != 0 THEN c.temp END) AS outdoor_temp, 
    //              AVG(CASE WHEN c.humidity != 0 THEN c.humidity END) AS outdoor_humidity 
    //       FROM reading_15min a 
    //       JOIN device_details b ON a.deviceID = b.deviceID 
    //       JOIN cpcb_data c ON b.outdoor_deviceID = c.deviceID 
    //       WHERE b.active = 1 
    //       AND b.primary_sensor = 1 
    //       AND (a.datetime BETWEEN '".$start_dt_string."' AND '".$current_dt_string."') 
    //       GROUP BY b.deviceID, b.latitude, b.longitude";


    //     try{        
    //         $result = $conn->query($query);
    //         if ($result->num_rows > 0) {
    //             $response = array();
    //             // Loop through each row of the result set
    //             while($row = $result->fetch_assoc()){
    //                 $deviceID = $row['deviceID'];   
    //                 $latitude = $row['latitude'];
    //                 $longitude = $row['longitude'];
    //                 $avg_pm25 = round($row['pm25'],0);
    //                 $avg_pm10 = round($row['pm10'],0);
    //                 $avg_aqi = round($row['aqi'],0);
    //                 $avg_co2 = round($row['co2'],0);
    //                 $avg_voc = round($row['voc'],0);
    //                 $avg_temp = round($row['temp'],0);
    //                 $avg_hum = round($row['humidity'],0);
    //                 //outdoor data
    //                 $avg_out_pm25 = round($row['outdoor_pm25'],0);
    //                 $avg_out_pm10 = round($row['outdoor_pm10'],0);
    //                 $avg_out_aqi = round($row['outdoor_aqi'],0);
    //                 $avg_out_temp = round($row['outdoor_temp'],0);
    //                 $avg_out_hum = round($row['outdoor_humidity'],0);
    //                 $response[] = array("deviceID"=>$deviceID, "latitude"=>$latitude, "longitude"=>$longitude, "indoor_pm25"=> $avg_pm25, "indoor_pm10"=> $avg_pm10, "indoor_aqi"=> $avg_aqi, "indoor_co2"=> $avg_co2, "indoor_voc"=> $avg_voc, "indoor_temp" => $avg_temp, "indoor_humidity"=> $avg_hum,"outdoor_pm25"=>$avg_out_pm25, "outdoor_pm10"=>$avg_out_pm10, "outdoor_aqi"=>$avg_out_aqi, "outdoor_temp"=>$avg_out_temp, "outdoor_humidity"=>$avg_out_hum ,"start_date" => $start_dt_string, "end_date"=> $current_dt_string);
    //             }
    //             //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //             return  json_encode ( [ 'ApiResponse' => 'Success', 'Data' => $response, 'RowCount' => $result->num_rows ] );
            
    //         } else {
    //             return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found", 'Query'=> $query]);
    //         }

    //     }
    //     catch(Exception $e){
    //         return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
    //     }
    // }


    function getPinData() {
        $conn = db_connect();
        date_default_timezone_set('Asia/Kolkata');
        $current_dt = new DateTime();
        $start_dt = clone $current_dt;
        $start_dt->modify('-1 hour');
        
        $current_dt_string = $current_dt->format('Y-m-d H:00:00');
        $start_dt_string = $start_dt->format('Y-m-d H:00:00');
    
        // Ensure indexes exist
        createIndexes($conn);
    
        $query = "SELECT 
    b.deviceID, 
    b.latitude, 
    b.longitude,  
    AVG(a.median_pm25) AS pm25, 
    AVG(a.median_pm10) AS pm10, 
    AVG(a.median_aqi) AS aqi, 
    AVG(a.median_co2) AS co2, 
    AVG(a.median_voc) AS voc, 
    AVG(a.median_temp) AS temp, 
    AVG(a.median_hum) AS humidity, 
    AVG(c.pm25) AS outdoor_pm25, 
    AVG(c.pm10) AS outdoor_pm10, 
    AVG(c.aqi) AS outdoor_aqi,  
    AVG(c.temp) AS outdoor_temp, 
    AVG(c.humidity) AS outdoor_humidity 
FROM 
    reading_15min a 
JOIN 
    device_details b ON a.deviceID = b.deviceID 
JOIN 
    cpcb_data c ON b.outdoor_deviceID = c.deviceID 
WHERE 
    b.active = 1 
    AND b.primary_sensor = 1 
    AND a.datetime BETWEEN DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND NOW() 
    AND a.median_pm25 != 0 
    AND a.median_pm10 != 0 
    AND a.median_aqi != 0 
    AND a.median_co2 != 0 
    AND a.median_voc != 0 
    AND a.median_temp != 0 
    AND a.median_hum != 0 
    AND c.pm25 != 0 
    AND c.pm10 != 0 
    AND c.aqi != 0 
    AND c.temp != 0 
    AND c.humidity != 0
GROUP BY 
    b.deviceID, b.latitude, b.longitude";

    
        try {        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $response = [];
                while ($row = $result->fetch_assoc()) {
                    $response[] = [
                        "deviceID" => $row['deviceID'],
                        "latitude" => $row['latitude'],
                        "longitude" => $row['longitude'],
                        "indoor_pm25" => round($row['pm25'], 0),
                        "indoor_pm10" => round($row['pm10'], 0),
                        "indoor_aqi" => round($row['aqi'], 0),
                        "indoor_co2" => round($row['co2'], 0),
                        "indoor_voc" => round($row['voc'], 0),
                        "indoor_temp" => round($row['temp'], 0),
                        "indoor_humidity" => round($row['humidity'], 0),
                        "outdoor_pm25" => round($row['outdoor_pm25'], 0),
                        "outdoor_pm10" => round($row['outdoor_pm10'], 0),
                        "outdoor_aqi" => round($row['outdoor_aqi'], 0),
                        "outdoor_temp" => round($row['outdoor_temp'], 0),
                        "outdoor_humidity" => round($row['outdoor_humidity'], 0),
                        "start_date" => $start_dt_string,
                        "end_date" => $current_dt_string,
                    ];
                }
                return json_encode(['ApiResponse' => 'Success', 'Data' => $response, 'RowCount' => $result->num_rows]);
            } else {
                return json_encode(['ApiResponse' => 'Success', 'RowCount' => 0, 'Message' => "No records found"]);
            }
        } catch (Exception $e) {
            return json_encode(['ApiResponse' => 'Fail', 'Message' => $e->getMessage()]);
        }
    }
    
    // Helper Function to Create Indexes
    function createIndexes($conn) {
        $indexes = [
            // Index for reading_15min table
            "CREATE INDEX IF NOT EXISTS idx_reading_15min_datetime_deviceID ON reading_15min (datetime, deviceID)",
            // Indexes for device_details table
            "CREATE INDEX IF NOT EXISTS idx_device_details_deviceID ON device_details (deviceID)",
            "CREATE INDEX IF NOT EXISTS idx_device_details_active_primary_sensor ON device_details (active, primary_sensor)",
            // Index for cpcb_data table
            "CREATE INDEX IF NOT EXISTS idx_cpcb_data_deviceID ON cpcb_data (deviceID)",
        ];
    
        foreach ($indexes as $indexQuery) {
            try {
                $conn->query($indexQuery);
            } catch (Exception $e) {
                error_log("Index creation failed: " . $e->getMessage());
            }
        }
    }
    

    // function getPinData() {
    //     $conn = db_connect();
    //     date_default_timezone_set('Asia/Kolkata');
    //     $current_dt = new DateTime();
    //     $start_dt = clone $current_dt;
    //     $start_dt->modify('-1 hour');
        
    //     // Format datetimes as strings (optional)
    //     $current_dt_string = $current_dt->format('Y-m-d H:i:s');
    //     $start_dt_string = $start_dt->format('Y-m-d H:i:s');
    
    //     // Modified query to include inactive monitors
    //     $query = "SELECT b.deviceID, b.latitude, b.longitude,  
    //                      AVG(a.median_pm25) AS pm25, 
    //                      AVG(a.median_pm10) AS pm10, 
    //                      AVG(a.median_aqi) AS aqi, 
    //                      AVG(a.median_co2) AS co2, 
    //                      AVG(a.median_voc) AS voc, 
    //                      AVG(a.median_temp) AS temp,
    //                      AVG(a.median_hum) AS humidity, 
    //                      AVG(c.pm25) AS outdoor_pm25, 
    //                      AVG(c.pm10) AS outdoor_pm10, 
    //                      AVG(c.aqi) AS outdoor_aqi,  
    //                      AVG(c.temp) AS outdoor_temp, 
    //                      AVG(c.humidity) AS outdoor_humidity  
    //               FROM reading_15min a 
    //               JOIN device_details b ON a.deviceID = b.deviceID 
    //               JOIN cpcb_data c ON b.outdoor_deviceID = c.deviceID 
    //               WHERE  
    //               a.datetime BETWEEN '{$start_dt_string}' AND '{$current_dt_string}'
    //               GROUP BY b.deviceID, b.latitude, b.longitude";
    
    //     try {
    //         $result = $conn->query($query);
    //         if ($result->num_rows > 0) {
    //             $response = array();
    //             // Loop through each row of the result set
    //             while ($row = $result->fetch_assoc()) {
    //                 $deviceID = $row['deviceID'];   
    //                 $latitude = $row['latitude'];
    //                 $longitude = $row['longitude'];
    //                 $avg_pm25 = round($row['pm25'], 0);
    //                 $avg_pm10 = round($row['pm10'], 0);
    //                 $avg_aqi = round($row['aqi'], 0);
    //                 $avg_co2 = round($row['co2'], 0);
    //                 $avg_voc = round($row['voc'], 0);
    //                 $avg_temp = round($row['temp'], 0);
    //                 $avg_hum = round($row['humidity'], 0);
    //                 // Outdoor data
    //                 $avg_out_pm25 = round($row['outdoor_pm25'], 0);
    //                 $avg_out_pm10 = round($row['outdoor_pm10'], 0);
    //                 $avg_out_aqi = round($row['outdoor_aqi'], 0);
    //                 $avg_out_temp = round($row['outdoor_temp'], 0);
    //                 $avg_out_hum = round($row['outdoor_humidity'], 0);
    //                 $response[] = array(
    //                     "deviceID" => $deviceID, 
    //                     "latitude" => $latitude, 
    //                     "longitude" => $longitude, 
    //                     "indoor_pm25" => $avg_pm25, 
    //                     "indoor_pm10" => $avg_pm10, 
    //                     "indoor_aqi" => $avg_aqi, 
    //                     "indoor_co2" => $avg_co2, 
    //                     "indoor_voc" => $avg_voc, 
    //                     "indoor_temp" => $avg_temp, 
    //                     "indoor_humidity" => $avg_hum,
    //                     "outdoor_pm25" => $avg_out_pm25, 
    //                     "outdoor_pm10" => $avg_out_pm10, 
    //                     "outdoor_aqi" => $avg_out_aqi, 
    //                     "outdoor_temp" => $avg_out_temp, 
    //                     "outdoor_humidity" => $avg_out_hum,
    //                     "start_date" => $start_dt_string, 
    //                     "end_date" => $current_dt_string
    //                 );
    //             }
    //             return json_encode([
    //                 'ApiResponse' => 'Success', 
    //                 'Data' => $response, 
    //                 'RowCount' => $result->num_rows
    //             ]);
    //         } else {
    //             return json_encode([
    //                 'ApiResponse' => 'Success', 
    //                 'RowCount' => $result->num_rows, 
    //                 'Message' => "No records found", 
    //                 'Query' => $query
    //             ]);
    //         }
    //     } catch (Exception $e) {
    //         return json_encode([
    //             'ApiResponse' => 'Fail',  
    //             'Message' => $e->getMessage()
    //         ]);
    //     }
    // }
    


    // function getIndoorData(){
    //     $conn = db_connect();
    //     //set default parameters
    //     $duration = '24hour';
    //     $typology = 'All';
    //     $spaceType = 'All';
    //     $sensorID = 'All';
    //     $pollutant = "pm25";
    //     $spaceType_filter = "n";
    //     $sensorID_filter = "n";
    //     $typology_filter = 'n';
    //     //get input from api call
    //     if(file_get_contents('php://input')){
    //         $json = file_get_contents('php://input'); 
    //         $data = json_decode($json,true);
    //         $duration = $data["duration"];
    //         $typology = $data["typology"];
    //         $spaceType = $data["spaceType"];
    //         $sensorID = $data["sensorID"];
    //         $pollutant = $data["pollutant"];
                   
    //     }
    //     //convert duration to start and end date
    //     $start_dt = new DateTime();
    //     $end_dt = new DateTime();
    //     if($duration == 'week'){
    //         //set duration for week
    //         $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt  . " - " . $end_dt ;

    //     }else if($duration == 'month'){
    //         //set duration for month
    //         $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt  . " - " . $end_dt ;

    //     }else if($duration == 'ytd'){
    //         //set duration for ytd
    //         $start_dt = '2024-01-01 00:00:00';
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         //$start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt . " - " . $end_dt ;
    //     }else{
    //         //set duration for 24 hour
    //         $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');
    //         $dt = $start_dt  . " - " . $end_dt ;
    //     }
        
    //     //get typology 
    //     if(strpos($typology, 'All') === false){
    //         $typology_filter = "y";
    //     } 
    //     $typology  =  "'" . str_replace(",","','", $typology ) . "'";

    //     //get spacetype
    //     if(strpos($spaceType, 'All') === false){   // if 'All' not found
    //         $spaceType_filter = "y";
    //     } 
    //     $spaceType  =  "'" . str_replace(",","','", $spaceType ) . "'";

    //     //get sensor id
    //     if(strpos($sensorID, 'All') === false){   // if 'All' not found
    //         $sensorID_filter = "y";
    //     } 
    //     $sensorID  =  "'" . str_replace(",","','", $sensorID ) . "'";


    //     $column_nm = "max_". $pollutant;

    //     $select_query = "select DATE_FORMAT(datetime, '%Y-%m-%d %H:%i:00') as datetime, round(avg($column_nm),2) as '$pollutant' from device_details a join reading_15min b on a.deviceID = b.deviceID where (datetime between '$start_dt' and '$end_dt') ";
    //     if($typology_filter == 'y'){
    //         $select_query .=  "  and typology in ($typology) ";
    //     }
    //     if($spaceType_filter == 'y'){
    //         $select_query .=  " and spacetype in ($spaceType) ";
    //     }
    //     if($sensorID_filter == 'y'){
    //         $select_query .=  " and a.deviceID in ($sensorID) ";
    //     }
    //     $select_query .=  " group by datetime order by datetime ";
    //     //return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => '10', 'Query' => $select_query  ] );

    //     try{        
    //         $result = $conn->query($select_query);
            
    //         if ($result->num_rows > 0) {
                
    //             $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //             return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Query' => $select_query ,'Data' => $rows ] );
    //         } else {
    //             return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $select_query]);
    //         }

    //     }
    //     catch(Exception $e){
    //         return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
    //     }
    // }

    function getIndoorData() {
        $conn = db_connect();
        
        // Set default parameters
        $duration = '24hour';
        $typology = 'All';
        $spaceType = 'All';
        $sensorID = 'All';
        $pollutant = "pm25";
        $spaceType_filter = "n";
        $sensorID_filter = "n";
        $typology_filter = 'n';
    
        // Get input from API call
        if (file_get_contents('php://input')) {
            $json = file_get_contents('php://input'); 
            $data = json_decode($json, true);
            $duration = $data["duration"];
            $typology = $data["typology"];
            $spaceType = $data["spaceType"];
            $sensorID = $data["sensorID"];
            $pollutant = $data["pollutant"];
        }
        
        // Convert duration to start and end date
        $start_dt = new DateTime();
        $end_dt = new DateTime();
        if ($duration == 'week') {
            $start_dt->modify("-7 day");
        } elseif ($duration == 'month') {
            $start_dt->modify("-1 month");
        } elseif ($duration == 'ytd') {
            $start_dt = new DateTime('2024-01-01 00:00:00');
        } else {
            $start_dt->modify("-24 hour");
        }
        
        $end_dt = $end_dt->format('Y-m-d H:i:s');
        $start_dt = $start_dt->format('Y-m-d H:i:s');
        $dt = $start_dt . " - " . $end_dt;
        
        // Get typology
        if (strpos($typology, 'All') === false) {
            $typology_filter = "y";
        }
        $typology = "'" . str_replace(",", "','", $typology) . "'";
        
        // Get spacetype
        if (strpos($spaceType, 'All') === false) {
            $spaceType_filter = "y";
        }
        $spaceType = "'" . str_replace(",", "','", $spaceType) . "'";
        
        // Get sensor ID
        if (strpos($sensorID, 'All') === false) {
            $sensorID_filter = "y";
        }
        $sensorID = "'" . str_replace(",", "','", $sensorID) . "'";
        
        $column_nm = "max_" . $pollutant;
    
        // Update the query to include average temperature and average humidity
        $select_query = "
            SELECT 
                DATE_FORMAT(b.datetime, '%Y-%m-%d %H:%i:00') AS datetime,
                ROUND(AVG(b.$column_nm), 2) AS '$pollutant',
                ROUND(AVG(ABS(b.avg_temp)), 2) AS avg_temp,
                ROUND(AVG(ABS(b.avh_hum)), 2) AS avg_hum
            FROM 
                device_details a
                JOIN reading_15min b ON a.deviceID = b.deviceID
            WHERE 
                b.datetime BETWEEN '$start_dt' AND '$end_dt'
        ";
    
        if ($typology_filter == 'y') {
            $select_query .= " AND a.typology IN ($typology) ";
        }
        if ($spaceType_filter == 'y') {
            $select_query .= " AND a.spacetype IN ($spaceType) ";
        }
        if ($sensorID_filter == 'y') {
            $select_query .= " AND a.deviceID IN ($sensorID) ";
        }
        $select_query .= " GROUP BY datetime ORDER BY datetime ";
    
        // Execute the query and return results
        try {
            $result = $conn->query($select_query);
            
            if ($result->num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return json_encode([
                    'ApiResponse' => 'Success',
                    'RowCount' => $result->num_rows,
                    'Query' => $select_query,
                    'Data' => $rows
                ]);
            } else {
                return json_encode([
                    'ApiResponse' => 'Success',
                    'RowCount' => $result->num_rows,
                    'Message' => "No records found",
                    'Query' => $select_query
                ]);
            }
        } catch (Exception $e) {
            return json_encode([
                'ApiResponse' => 'Fail',
                'Message' => $e->getMessage()
            ]);
        }
    }
    

    function getBoxPlotIndoorData(){
        $conn = db_connect();

        $indoorQueryStatus = 'n';
        $outdoorQueryStatus = 'n';
        $indoorData = null;
        $outdoorData = null;

        //set default parameters
        $duration = '24hour';
        $typology = 'All';
        $spaceType = 'All';
        $sensorID = 'All';
        $pollutant = "pm25";
        $spaceType_filter = "n";
        $sensorID_filter = "n";
        $typology_filter = 'n';
        //get input from api call
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); 
            $data = json_decode($json,true);
            $duration = $data["duration"];
            $typology = $data["typology"];
            $spaceType = $data["spaceType"];
            $sensorID = $data["sensorID"];
            $pollutant = $data["pollutant"];
                   
        }
        //convert duration to start and end date
        $start_dt = new DateTime();
        $end_dt = new DateTime();
        if($duration == 'week'){
            //set duration for week
            $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'month'){
            //set duration for month
            $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'ytd'){
            //set duration for ytd
            $start_dt = '2024-01-01 00:00:00';
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            //$start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt . " - " . $end_dt ;
        }else{
            //set duration for 24 hour
            $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt  . " - " . $end_dt ;
        }
        
        //get typology 
        if(strpos($typology, 'All') === false){
            $typology_filter = "y";
        } 
        $typology  =  "'" . str_replace(",","','", $typology ) . "'";

        //get spacetype
        if(strpos($spaceType, 'All') === false){   // if 'All' not found
            $spaceType_filter = "y";
        } 
        $spaceType  =  "'" . str_replace(",","','", $spaceType ) . "'";

        //get sensor id
        if(strpos($sensorID, 'All') === false){   // if 'All' not found
            $sensorID_filter = "y";
        } 
        $sensorID  =  "'" . str_replace(",","','", $sensorID ) . "'";


        $column_nm = "median_". $pollutant;

        $select_query = "SELECT e.datetime as date_time1, min(abs(e.$column_nm)) as min_reading, max(abs(e.$column_nm)) as max_reading, avg(abs(e.$column_nm)) as avg_reading, substring_index(substring_index(group_concat(cast(abs(e.$column_nm) as decimal(10,2) ) order by abs(e.$column_nm) ASC separator ','
                        ),',',((0.25 * count(*)))         
                        ),',',-(1)
                ) AS `Q1`,
                substring_index(
                substring_index(
                    group_concat(cast(abs(e.$column_nm) as decimal(10,2) )
                                order by abs(e.$column_nm)
                ASC separator ','
                    ),',',((0.50 * count(*)))         
                            ),',',-(1)
                ) AS `median`,
                substring_index(
                substring_index(
                    group_concat(cast(abs(e.$column_nm) as decimal(10,2) )
                                order by abs(e.$column_nm)
                                ASC separator ','
                    ),',',((0.75 * count(*)) )         
                            ),',',-(1)
                ) AS `Q3`,

                sum(abs(e.$column_nm)) as cumulative_reading,
                round(avg(abs(e.avg_temp)),2) as avg_temp, round(avg(abs(e.avh_hum)),2) as avg_hum
                    FROM device_details a   LEFT OUTER JOIN reading_15min e 
                    ON (a.deviceID = e.deviceID) 
                    where (datetime between '$start_dt' and '$end_dt') ";
        
        if($typology_filter == 'y'){
            $select_query .=  "  and typology in ($typology) ";
        }
        if($spaceType_filter == 'y'){
            $select_query .=  " and spacetype in ($spaceType) ";
        }
        if($sensorID_filter == 'y'){
            $select_query .=  " and a.deviceID in ($sensorID) ";
        }
        $select_query .=  " group by datetime order by datetime ";
        //return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => '10', 'Query' => $select_query  ] );

        try{        
            $result = $conn->query($select_query);
            
            if ($result->num_rows > 0) {
                
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $indoorQueryStatus = 'y';
                $indoorData = $rows;
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Query' => $select_query ,'Data' => $rows ] );
            } else {
                $indoorQueryStatus = 'y';
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $select_query]);
            }

        }
        catch(Exception $e){
            $indoorQueryStatus = 'n';
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    // function getBoxPlotOutdoorData(){
    //     //outdoor data
    //     $conn = db_connect();

    //     //set default parameters
    //     $duration = '24hour';
    //     $typology = 'All';
    //     $pollutant = "pm25";
    //     $typology_filter = 'n';
    //     //get input from api call
    //     if(file_get_contents('php://input')){
    //         $json = file_get_contents('php://input'); 
    //         $data = json_decode($json,true);
    //         $duration = $data["duration"];
    //         $typology = $data["typology"];
    //         $pollutant = $data["pollutant"];
                   
    //     }
    //     //convert duration to start and end date
    //     $start_dt = new DateTime();
    //     $end_dt = new DateTime();
    //     if($duration == 'week'){
    //         //set duration for week
    //         $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt  . " - " . $end_dt ;

    //     }else if($duration == 'month'){
    //         //set duration for month
    //         $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt  . " - " . $end_dt ;

    //     }else if($duration == 'ytd'){
    //         //set duration for ytd
    //         $start_dt = '2024-01-01 00:00:00';
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         //$start_dt = $start_dt->format('Y-m-d H:i:s');

    //         $dt = $start_dt . " - " . $end_dt ;
    //     }else{
    //         //set duration for 24 hour
    //         $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
    //         $end_dt = $end_dt->format('Y-m-d H:i:s');
    //         $start_dt = $start_dt->format('Y-m-d H:i:s');
    //         $dt = $start_dt  . " - " . $end_dt ;
    //     }
    //     //get typology 
    //     if(strpos($typology, 'All') === false){
    //         $typology_filter = "y";
    //     } 
    //     $typology  =  "'" . str_replace(",","','", $typology ) . "'";

        
    //         $select_query = "SELECT e.datetime as date_time1, min(abs(e.$pollutant)) as min_reading, max(abs(e.$pollutant)) as max_reading, avg(abs(e.$pollutant)) as avg_reading,
    //                     min(abs(e.temp)) as min_temp, max(abs(e.temp)) as max_temp, min(abs(e.humidity)) as min_humidity, max(abs(e.humidity)) as max_humidity
    //                     From device_details a JOIN cpcb_monitors b ON a.outdoor_deviceID = b.deviceID
    //                        LEFT OUTER JOIN cpcb_data e 
    //                     ON (b.deviceID = e.deviceID) 
    //                     where (datetime between '$start_dt' and '$end_dt') ";
            
    //         if($typology_filter == 'y'){
    //             $select_query .=  "  and typology in ($typology) ";
    //         }
            
    //         $select_query .=  " group by datetime order by datetime ";
    //         //return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => '10', 'Query' => $select_query  ] );

    //         try{        
    //             $result = $conn->query($select_query);
                
    //             if ($result->num_rows > 0) {
                    
    //                 $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //                 return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Query' => $select_query ,'Data' => $rows ] );
    //             } else {
    //                 return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $select_query]);
    //             }

    //         }
    //         catch(Exception $e){
    //             return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
    //         }
        
    // }


    function getBoxPlotOutdoorData() {
        // outdoor data
        $conn = db_connect();
    
        // set default parameters
        $duration = '24hour';
        $typology = 'All';
        $pollutant = "pm25";
        $typology_filter = 'n';
        
        // get input from API call
        if (file_get_contents('php://input')) {
            $json = file_get_contents('php://input'); 
            $data = json_decode($json, true);
            $duration = $data["duration"];
            $typology = $data["typology"];
            $pollutant = $data["pollutant"];
        }
        
        // convert duration to start and end date
        $start_dt = new DateTime();
        $end_dt = new DateTime();
        
        if ($duration == 'week') {
            // set duration for week
            $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt . " - " . $end_dt;
        } else if ($duration == 'month') {
            // set duration for month
            $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt . " - " . $end_dt;
        } else if ($duration == 'ytd') {
            // set duration for ytd
            $start_dt = '2024-01-01 00:00:00';
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $dt = $start_dt . " - " . $end_dt;
        } else {
            // set duration for 24 hour
            $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt . " - " . $end_dt;
        }
        
        // get typology
        if (strpos($typology, 'All') === false) {
            $typology_filter = "y";
        }
        $typology = "'" . str_replace(",", "','", $typology) . "'";
        
        $select_query = "SELECT e.datetime as date_time1, 
                                min(abs(e.$pollutant)) as min_reading, 
                                max(abs(e.$pollutant)) as max_reading, 
                                avg(abs(e.$pollutant)) as avg_reading,
                                min(abs(e.temp)) as min_temp, 
                                max(abs(e.temp)) as max_temp, 
                                min(abs(e.humidity)) as min_humidity, 
                                max(abs(e.humidity)) as max_humidity
                         FROM device_details a 
                         JOIN cpcb_monitors b ON a.outdoor_deviceID = b.deviceID
                         LEFT OUTER JOIN cpcb_data e ON (b.deviceID = e.deviceID) 
                         WHERE (datetime BETWEEN '$start_dt' AND '$end_dt') 
                           AND abs(e.$pollutant) != 0
                           AND abs(e.temp) != 0
                           AND abs(e.humidity) != 0 ";
    
        if ($typology_filter == 'y') {
            $select_query .= "  AND typology IN ($typology) ";
        }
    
        $select_query .= "GROUP BY datetime 
                           ORDER BY datetime";
        
        try {        
            $result = $conn->query($select_query);
            
            if ($result->num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return json_encode([ 
                    'ApiResponse' => 'Success', 
                    'RowCount' => $result->num_rows, 
                    'Query' => $select_query, 
                    'Data' => $rows 
                ]);
            } else {
                return json_encode([ 
                    'ApiResponse' => 'Success', 
                    'RowCount' => $result->num_rows, 
                    'Message' => "No records found", 
                    'query' => $select_query
                ]);
            }
        } catch (Exception $e) {
            return json_encode([ 
                'ApiResponse' => 'Fail',  
                'Message' => $e->getMessage()
            ]);
        }
    }
    



  
?>