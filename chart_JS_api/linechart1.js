

function getLinechart1(duration, typology, spaceType, sensorID, pollutants, post_url) {
  console.log(post_url)
  console.log("function called " + duration + typology + spaceType + sensorID + pollutants);
  $.ajax({
      url: post_url, // URL of the PHP file
      
      type: 'POST', // Use POST method
      data: {
          duration: duration,
          typology: typology,
          spaceType: spaceType,
          sensorID: sensorID,
          pollutants: pollutants
      }, // Data to send in the request
      success: function(response) {
          // Handle the successful response
          console.log(response);
          var result = JSON.parse(response);
          if(result.ApiResponse === "Success") {
              var indoordata = result.Data;
              updateLineChart(indoordata, pollutants);
          }
      },
      error: function(jqXHR, textStatus, errorThrown) {
          // Handle errors here
          console.error('Error:', textStatus, errorThrown);
      }
  });
}

function maybeDisposeRoot1(divId) {
  if (typeof am5 !== 'undefined' && am5.registry && Array.isArray(am5.registry.rootElements)) {
      am5.registry.rootElements.forEach(function(root) {
          if (root && root.dom && root.dom.id === divId) {
              root.dispose();
          }
      });
  } else {
      console.warn('am5 or am5.registry.rootElements is not defined.');
  }
}


function updateLineChart(chart_data, pollutants) {
    var label = "";
    var unit = "";
    if (pollutants === "pm25") {
        label = "PM 2.5:";
        unit = "(µg/m³)";
    } else if (pollutants === "pm10") {
        label = "PM 10:";
        unit = "(µg/m³)";
    } else if (pollutants === "aqi") {
        label = "AQI";
        unit = "";
    } else if (pollutants === "co2") {
        label = "CO₂:";
        unit = "(ppm)";
    } else if (pollutants === "voc") {
        label = "TVOC:";
        unit = "(µg/m³)";
    }

    maybeDisposeRoot1("linechart1");

    var root = am5.Root.new("linechart1");
    root.setThemes([am5themes_Animated.new(root)]);

    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true,
        paddingLeft: 0
    }));

    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        behavior: "none"
    }));
    cursor.lineY.set("visible", false);

    // Create X-Axis
    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
        maxDeviation: 0.2,
        baseInterval: {
            timeUnit: "minute",
            count: 15
        },
        renderer: am5xy.AxisRendererX.new(root, {
            minorGridEnabled: true
        })
    }));

    // Create Y-Axis for main values
    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererY.new(root, {
            pan: "zoom"
        })
    }));

    
   

     // Create Secondary Y-Axis for Temperature
    var yAxisTemp = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererY.new(root, {
            opposite: true,
              pan: "zoom"
        })
        
    }));

    // Add Custom Label to Y-Axis
    var yAxisLabel = am5.Label.new(root, {
        text: label + ' ' + unit,
        textAlign: 'center',
        y: am5.p50,
        rotation: -90,
        fontWeight: 'bold'
    });
    yAxis.children.moveValue(yAxisLabel, 0);

   

    // Add Custom Label to Temperature Y-Axis
    var tempLabel = am5.Label.new(root, {
        text: "Temperature (°C)",
        x: am5.p100,
        textAlign: 'center',
        y: am5.p50,
        rotation: -90,
        fontWeight: 'bold'
    });
    yAxisTemp.children.moveValue(tempLabel, 0);

    // Create Y-Axis for Humidity
    var yAxisHum = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererY.new(root, {
            opposite: true,
             pan: "zoom"
        })
       
    }));

    // Add Custom Label to Humidity Y-Axis
    var humLabel = am5.Label.new(root, {
        text: "Humidity (%)",
        x: am5.p100,
        textAlign: 'center',
        y: am5.p50,
        rotation: -90,
        fontWeight: 'bold'
    });
    yAxisHum.children.moveValue(humLabel, 0);

    
    
    // Set initial font sizes
    setResponsiveFontSize();

    // Function to set responsive font sizes
    function setResponsiveFontSize() {
        const fontSize = window.innerWidth >= 768 ? 15 : 10; // Adjust threshold as necessary

        if (xAxis && yAxis &&  yAxisTemp &&  yAxisHum ) {
            xAxis.get("renderer").labels.template.setAll({
                fontSize: fontSize
            });
            yAxis.get("renderer").labels.template.setAll({
                fontSize: fontSize
            });
            yAxisTemp.get("renderer").labels.template.setAll({
                fontSize: fontSize
            });
            yAxisHum.get("renderer").labels.template.setAll({
                fontSize: fontSize
            });
        }

        // Update tooltip font sizes
        
    }
    function formatPollutants(pollutants){
        if (pollutants == "voc")
            return "TVOC"
        else if(pollutants =="aqi")
            return "AQI"
        else if(pollutants =="pm25")
            return "PM\u2082.\u2085"
        else if(pollutants=="pm10")
          return 'PM\u2081\u2080'
         else if(pollutants == "co2")
            return "CO\u2082"
        else
          return pollutants

      }

      let pollutants1 = formatPollutants(pollutants)

    // Create Series for Pollutant
    var series = chart.series.push(am5xy.LineSeries.new(root, {
        name: pollutants1,
        color: am5.color("#2fb996"),
        fill: am5.color("#2fb996"),
        xAxis: xAxis,
        yAxis: yAxis,
        stroke: "#2fb996",
        valueYField: pollutants,
        valueXField: "datetime",
        tooltip: am5.Tooltip.new(root, {
            labelText: label + " {valueY}",
            label: am5.Label.new(root, {
                fill: am5.color("#ffffff"),
                fontSize: 15
            })
        }),
        legendLabelText: "{name}",
    }));
    series.set("grid", am5.color(0xff0000));
    // Create Series for Average Temperature
    var seriesTemp = chart.series.push(am5xy.LineSeries.new(root, {
        name: "Temperature",
        color: am5.color("#f16463"),
        fill: am5.color("#f16463"),
        xAxis: xAxis,
        yAxis: yAxisTemp,
        stroke: "#f16463",
        valueYField: "avg_temp",
        valueXField: "datetime",
        tooltip: am5.Tooltip.new(root, {
            labelText: "Temperature: {valueY}",
            label: am5.Label.new(root, {
                fill: am5.color("#ffffff"),
                fontSize: 10
            })
        }),
        legendLabelText: "{name}",
    }));

    // Create Series for Average Humidity
    var seriesHum = chart.series.push(am5xy.LineSeries.new(root, {
        name: "Humidity",
        color: am5.color("#0396c7"),
        fill: am5.color("#0396c7"),
        xAxis: xAxis,
        yAxis: yAxisHum,
        stroke: "#0396c7",
        valueYField: "avg_hum",
        valueXField: "datetime",
        tooltip: am5.Tooltip.new(root, {
            labelText: "Humidity: {valueY}",
            label: am5.Label.new(root, {
                fill: am5.color("#ffffff"),
                fontSize: 10
            })
        }),
        legendLabelText: "{name}",
    }));

    

    // Create Scrollbar
    chart.set("scrollbarX", am5.Scrollbar.new(root, {
        orientation: "horizontal"
    }));
    chart.set("scrollbarY", am5.Scrollbar.new(root, {
        orientation: "vertical"
    }));

    // Process Data
    series.data.processor = am5.DataProcessor.new(root, {
        numericFields: [pollutants, "avg_temp", "avg_hum"],
        dateFields: ["datetime"],
        dateFormat: "yyyy-MM-dd HH:mm:ss"
    });

    series.data.setAll(chart_data);
    seriesTemp.data.setAll(chart_data);
    seriesHum.data.setAll(chart_data);

    

    // Create Legend
    var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
        width: am5.percent(100),
        x: am5.percent(0),
        layout: root.horizontalLayout
    }));

    // Function to update legend layout
    function updateLegendLayout() {
        if (window.innerWidth < 600) {
            legend.set("layout", root.verticalLayout);
        } else {
            legend.set("layout", root.horizontalLayout);
        }
    }

    updateLegendLayout();
    window.addEventListener('resize', updateLegendLayout);

    // Ensure hover affects only the hovered series
    legend.itemContainers.template.events.on("pointerover", function(e) {
        var itemContainer = e.target;
        var series = itemContainer.dataItem.dataContext;

        chart.series.each(function(chartSeries) {
            if (chartSeries !== series) {
                chartSeries.strokes.template.setAll({
                    strokeOpacity: 0.15,
                    stroke: chartSeries.get("color")
                });
            } else {
                chartSeries.strokes.template.setAll({
                    strokeWidth: 3
                });
            }
        });
    });

    legend.itemContainers.template.events.on("pointerout", function(e) {
        chart.series.each(function(chartSeries) {
            chartSeries.strokes.template.setAll({
                strokeOpacity: 1,
                strokeWidth: 1,
                stroke: chartSeries.get("color")
            });
        });
    });

    
    seriesTemp.hide();
    seriesHum.hide();
    yAxisTemp.set("visible", false);
    yAxisHum.set("visible", false);

  // Create Legend
var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
    width: am5.percent(100),
    x: am5.percent(0),
    layout: root.horizontalLayout
}));

// Set initial legend data to only show the pollutant
legend.data.setAll([series]);


// Button event listeners
document.getElementById('showTemp').addEventListener('click', function () {
    if (seriesTemp.visible) {
        // Hide temperature series
        seriesTemp.hide();
        yAxisTemp.set("visible", false);
        document.getElementById('showTemp').classList.remove('active');
        
        // Update legend to only show pollutant
        legend.data.setAll([series]);

        // Check if humidity is also hidden
        if (!seriesHum.visible) {
            // If both are hidden, deactivate both buttons
            document.getElementById('showHumidity').classList.remove('active');
        }
    } else {
        // Show temperature series and hide humidity
        seriesTemp.show();
        seriesHum.hide();
        yAxisTemp.set("visible", true);
        yAxisHum.set("visible", false);
        document.getElementById('showTemp').classList.add('active');
        document.getElementById('showHumidity').classList.remove('active');

        // Update legend to show both pollutant and temperature
        legend.data.setAll([series, seriesTemp]);
    }
});

document.getElementById('showHumidity').addEventListener('click', function () {
    if (seriesHum.visible) {
        // Hide humidity series
        seriesHum.hide();
        yAxisHum.set("visible", false);
        document.getElementById('showHumidity').classList.remove('active');
        
        // Update legend to only show pollutant
        legend.data.setAll([series]);

        // Check if temperature is also hidden
        if (!seriesTemp.visible) {
            // If both are hidden, deactivate both buttons
            document.getElementById('showTemp').classList.remove('active');
        }
    } else {
        // Show humidity series and hide temperature
        seriesHum.show();
        seriesTemp.hide();
        yAxisHum.set("visible", true);
        yAxisTemp.set("visible", false);
        document.getElementById('showHumidity').classList.add('active');
        document.getElementById('showTemp').classList.remove('active');

        // Update legend to show both pollutant and humidity
        legend.data.setAll([series, seriesHum]);
    }
});

}
