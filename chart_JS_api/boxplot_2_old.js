function getOutdoorData(duration, typology, pollutants){
  console.log("Outdoor data called for " + duration + ", " + typology + ", " + pollutants );
  server_host = '';
  $.getJSON( "config.json", function( data ) {
    server_host = data["server_host"];
  });

  $.ajax({
    url: server_host + '/chartData/outdoor.php', // URL of the PHP file
    type: 'POST', // Use POST method
    //contentType: 'application/json',
    data: { 
        duration: duration,
        typology: typology,
        pollutants: pollutants
        }, // Data to send in the request
    success: function(response) {
        // Handle the successful response
        //alert(response);
        console.log(response);
        var result = JSON.parse(response);
        if(result.ApiResponse=="Success"){
            outdoordata = result.Data;
            return outdoordata;
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors here
        console.error('Error:', textStatus, errorThrown);
        return null;
    }
  });

}



function getBoxplot(duration, typology, spaceType, sensorID, pollutants,indoorCondition, post_url, chart_id){
    console.log("function called " + duration + typology + spaceType +  sensorID + pollutants);

    //alert(outdoordata);

    $.ajax({
        url: post_url, // URL of the PHP file
        type: 'POST', // Use POST method
        //contentType: 'application/json',
        data: { 
            duration: duration,
            typology: typology,
            spaceType: spaceType,
            sensorID: sensorID,
            pollutants: pollutants
            }, // Data to send in the request
        success: function(response) {
            // Handle the successful response
            //alert(response);
            console.log(response);
            var result = JSON.parse(response);
            if(result.ApiResponse=="Success"){
                indoordata = result.Data;
                //get outdoor data
                if ((pollutants == "pm25" || pollutants == "pm10" || pollutants == "aqi") && indoorCondition == "none"){
                  outdoordata = getOutdoorData(duration,typology,pollutants);
                  updateBoxChart(indoordata, outdoordata, pollutants, chart_id);
                }
                else {
                  outdoordata = "na";
                  updateBoxChartWIC(indoordata, pollutants,indoorCondition, chart_id);
                } 
                
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.error('Error:', textStatus, errorThrown);
        }
    });
}

function maybeDisposeRoot(divId) {
   //alert("inside dispose " + divId);
    am5.array.each(am5.registry.rootElements, function (root) {
      //alert(root.dom.id + divId);
      if (root.dom.id == divId) {
        //console.log(root.dom.id);
        root.dispose();
        //return false;
      }
    });
  };

function updateBoxChart(chart_data,outdoordata, pollutants, chart_id){
    //alert("update chart called" + chart_id);
    label="";
    unit = "";
    if (pollutants == "pm25"){
        label = "PM 2.5:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
      }
      if (pollutants == "pm10"){
        label = "PM 10:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
    
      }
      if (pollutants == "aqi"){
        label = "AQI:";
        unit = ""
      }
      if (pollutants == "co2"){
        label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
        unit = "(ppm)";
      }
      if (pollutants == "voc"){
        label = "TVOC:";
        unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
    
      }
      //alert("inside update" + chart_id);
      maybeDisposeRoot(chart_id);
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new(chart_id);
        
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
        
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(
          am5xy.XYChart.new(root, {
            focusable: true,
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX"
          })
        );
        
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(
          am5xy.DateAxis.new(root, {
            baseInterval: { timeUnit: "minute", count: 15 },
            renderer: am5xy.AxisRendererX.new(root, {
              pan: "zoom",
              minorGridEnabled: true,
              minGridDistance: 70
            }),
            tooltip: am5.Tooltip.new(root, {})
          })
        );
        
        var yAxis = chart.yAxes.push(
          am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {
              pan: "zoom"
            })
          })
        );
        
        yAxis.children.moveValue(am5.Label.new(root, {
            text: label.substring(0, label.length - 1) + ' ' + unit,
            textAlign: 'center',
            y: am5.p50,
              rotation: -90,
            fontWeight: 'bold'
          }),0);
        var color = root.interfaceColors.get("background");
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(
          am5xy.CandlestickSeries.new(root, {
            // fill: am5.color("#023170"),
            // stroke: am5.color("#023170"),
            name: "Indoor",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "Q1",
            openValueYField: "Q3",
            lowValueYField: "min_reading",
            highValueYField: "max_reading",
            valueXField: "date_time1",
            tooltip: am5.Tooltip.new(root, {
              pointerOrientation: "horizontal",
              labelText: "Min: {lowValueY} \nQ1: {valueY} \nMedian: {median} \nQ3: {openValueY} \nMax: {highValueY}"
            })
          })
        );
        //https://www.amcharts.com/docs/v5/charts/xy-chart/series/candlestick-series/
        //set color of chart
        series.columns.template.states.create("riseFromOpen", {
            fill: am5.color("#2fb996"),
            stroke: am5.color("#2fb996")
          });
          
          series.columns.template.states.create("dropFromOpen", {
            fill: am5.color("#2fb996"),
            stroke: am5.color("#2fb996")
          });
        
        // mediana series
        var medianaSeries = chart.series.push(
          am5xy.StepLineSeries.new(root, {
            stroke: root.interfaceColors.get("background"),
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "median",
            valueXField: "date_time1",
            noRisers: true
          })
        );


        //##################
// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series0 = chart.series.push(
  am5xy.LineSeries.new(root, {
    name: "Outdoor",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "min_reading",
    valueXField: "date_time1",
    hiddenInLegend : true,
    tooltip: am5.Tooltip.new(root, {
      labelText: "{valueY}",
      pointerOrientation: "horizontal"
    })
  })
);

var series1 = chart.series.push(
  am5xy.LineSeries.new(root, {
    name: "Outdoor",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "max_reading",
    openValueYField: "min_reading",
    valueXField: "date_time1",
    stroke: series0.get("stroke"),
    fill: series0.get("stroke"),
    tooltip: am5.Tooltip.new(root, {
      labelText: "{valueY}-{openValueY}",
      pointerOrientation: "horizontal"
    })
  })
);

series1.fills.template.setAll({
  fillOpacity: 0.3,
  visible: true
});

series0.strokes.template.set("strokeWidth", 2);
series1.strokes.template.set("strokeWidth", 2);

//logic to show /hide series 0 and 1 at the same time on legend click
series1.on("visible", function(visible, series1){
  if (visible) {
      series0.show();
  }
  else{
    series0.hide();
  }
});
        //#####################
        
        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
          xAxis: xAxis
        }));
        cursor.lineY.set("visible", false);


        // Function to convert string numbers to actual numbers
        function convertToNumbers(data) {
        return data.map(item => {
          return {
            date_time1: new Date(item.date_time1),
            min_reading: parseFloat(item.min_reading),
            max_reading: parseFloat(item.max_reading),
            Q1: parseFloat(item.Q1),
            median: parseFloat(item.median),
            Q3: parseFloat(item.Q3)
          };
        });
      }
  
      // Process the raw data
      let processedData = convertToNumbers(chart_data);
        var data = processedData
        
        
        
        series.data.processor = am5.DataProcessor.new(root, {
          dateFields: ["date_time1"],
          dateFormat: "yyyy-MM-dd hh:mm"
        });
        
        series.data.setAll(data);
        medianaSeries.data.setAll(data);

        
        //#####################
        series0.data.setAll(data);
        series1.data.setAll(data);
        //#####################

        
         // Add legend
          // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
          var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
            width: am5.percent(100),
            /* paddingLeft: 20, */
            height: 30,
            x: am5.percent(40),
            fillField: "color"
          }));
          
          legend.data.push(series);
          legend.data.push(series1);

          
        
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000, 100);
        medianaSeries.appear(1000, 100);
        //#####################

        series0.appear(1000, 100);
        series1.appear(1000, 100);
        //#####################


        chart.appear(1000, 100);
        
        }); // end am5.ready()


}

//function to load chart with indoor condition
function updateBoxChartWIC(chart_data, pollutants,IC_column, chart_id){
  //alert("update chart called" + chart_id);
  indoor_column = "";
  IC_label = "";
  if(IC_column== "temp"){
    indoor_column = "avg_temp";
    IC_label = "Temperature (C)";
  }
  if(IC_column == "RH"){
    indoor_column = "avg_hum";
    IC_label = "Humidity (%)";

  }
  

  label="";
  unit = "";
  if (pollutants == "pm25"){
      label = "PM 2.5:";
      unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
    }
    if (pollutants == "pm10"){
      label = "PM 10:";
      unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
  
    }
    if (pollutants == "aqi"){
      label = "AQI:";
      unit = ""
    }
    if (pollutants == "co2"){
      label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
      unit = "(ppm)";
    }
    if (pollutants == "voc"){
      label = "TVOC:";
      unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
  
    }
    //alert("inside update" + chart_id);
    maybeDisposeRoot(chart_id);
  am5.ready(function() {

      // Create root element
      // https://www.amcharts.com/docs/v5/getting-started/#Root_element
      var root = am5.Root.new(chart_id);
      
      // Set themes
      // https://www.amcharts.com/docs/v5/concepts/themes/
      root.setThemes([
        am5themes_Animated.new(root)
      ]);
      
      // Create chart
      // https://www.amcharts.com/docs/v5/charts/xy-chart/
      var chart = root.container.children.push(
        am5xy.XYChart.new(root, {
          focusable: true,
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX"
        })
      );
      
      // Create axes
      // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
      var xAxis = chart.xAxes.push(
        am5xy.DateAxis.new(root, {
          baseInterval: { timeUnit: "minute", count: 15 },
          renderer: am5xy.AxisRendererX.new(root, {
            pan: "zoom",
            minorGridEnabled: true,
            minGridDistance: 70
          }),
          tooltip: am5.Tooltip.new(root, {})
        })
      );
      
      var yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {
            pan: "zoom"
          })
        })
      );
      
      yAxis.children.moveValue(am5.Label.new(root, {
          text: label.substring(0, label.length - 1) + ' ' + unit,
          textAlign: 'center',
          y: am5.p50,
            rotation: -90,
          fontWeight: 'bold'
        }),0);
      var color = root.interfaceColors.get("background");
      
      // Add series
      // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
      var series = chart.series.push(
        am5xy.CandlestickSeries.new(root, {
          // fill: am5.color("#023170"),
          // stroke: am5.color("#023170"),
          name: "Indoor",
          color: am5.color("#2fb996"),
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "Q1",
          openValueYField: "Q3",
          lowValueYField: "min_reading",
          highValueYField: "max_reading",
          valueXField: "date_time1",
          tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "horizontal",
            labelText: "Min: {lowValueY} \nQ1: {valueY} \nMedian: {median} \nQ3: {openValueY} \nMax: {highValueY}"
          })
        })
      );
      //https://www.amcharts.com/docs/v5/charts/xy-chart/series/candlestick-series/
      //set color of chart
      series.columns.template.states.create("riseFromOpen", {
          fill: am5.color("#2fb996"),
          stroke: am5.color("#2fb996")
        });
        
        series.columns.template.states.create("dropFromOpen", {
          fill: am5.color("#2fb996"),
          stroke: am5.color("#2fb996")
        });
      
      // mediana series
      var medianaSeries = chart.series.push(
        am5xy.StepLineSeries.new(root, {
          stroke: root.interfaceColors.get("background"),
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "median",
          valueXField: "date_time1",
          noRisers: true
        })
      );


      //##################

      var yAxis_line = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {         
          renderer: am5xy.AxisRendererY.new(root, {
            opposite: true,
            pan: "zoom"
          })
        })
      );
      
      yAxis_line.children.moveValue(am5.Label.new(root, {
          text: IC_label,
          
          x: am5.p100,
          textAlign: 'center',
          y: am5.p50,
            rotation: -90,
          fontWeight: 'bold'
        }),0);
      var color = root.interfaceColors.get("background");
      // Add series
      // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
      var lineseries = chart.series.push(am5xy.LineSeries.new(root, {
        name: IC_label.substring(0, IC_label.indexOf("(")),
        xAxis: xAxis,
        yAxis: yAxis_line,
        valueYField: indoor_column,
        valueXField: "date_time1",
        tooltip: am5.Tooltip.new(root, {
          labelText: IC_label.substring(0, IC_label.indexOf("(")) + ": " + "{valueY}"
        })
      }));
      //#####################
      
      // Add cursor
      // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
      var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        xAxis: xAxis
      }));
      cursor.lineY.set("visible", false);


      // Function to convert string numbers to actual numbers
      function convertToNumbers(data) {
      return data.map(item => {
        return {
          date_time1: new Date(item.date_time1),
          min_reading: parseFloat(item.min_reading),
          max_reading: parseFloat(item.max_reading),
          Q1: parseFloat(item.Q1),
          median: parseFloat(item.median),
          Q3: parseFloat(item.Q3),
          avg_temp : parseFloat(item.avg_temp),
          avg_hum: parseFloat(item.avg_hum)
        };
      });
    }

    // Process the raw data
    let processedData = convertToNumbers(chart_data);
      var data = processedData
      
      
      
      series.data.processor = am5.DataProcessor.new(root, {
        dateFields: ["date_time1"],
        dateFormat: "yyyy-MM-dd hh:mm"
      });


      
      
      series.data.setAll(data);
      medianaSeries.data.setAll(data);

      //#####################
      lineseries.data.setAll(data);
      //#####################


      // Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
  width: am5.percent(100),
  /* paddingLeft: 20, */
  height: 30,
  x: am5.percent(40),
  fillField: "color"
}));


/* 
legend.itemContainers.template.set("width", am5.p100);
legend.valueLabels.template.setAll({
  width: am5.p100,
  textAlign: "right"
}); */

// It's is important to set legend data after all the events are set on template, otherwise events won't be copied
//legend.data.setAll(chart.series.values);
legend.data.push(series);
legend.data.push(lineseries);



      
      // Make stuff animate on load
      // https://www.amcharts.com/docs/v5/concepts/animations/
      series.appear(1000, 100);
      medianaSeries.appear(1000, 100);

      //#####################
      lineseries.appear(1000, 100);
      //#####################


      chart.appear(1000, 100);
      
      }); // end am5.ready()


}