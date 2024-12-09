// function getLinechart1(duration, typology, spaceType, sensorID, pollutants, post_url){
//     console.log("function called " + duration + typology + spaceType +  sensorID + pollutants);
//     $.ajax({
//         url: post_url, // URL of the PHP file
//         type: 'POST', // Use POST method
//         //contentType: 'application/json',
//         data: { 
//             duration: duration,
//             typology: typology,
//             spaceType: spaceType,
//             sensorID: sensorID,
//             pollutants: pollutants
//             }, // Data to send in the request
//         success: function(response) {
//             // Handle the successful response
//             //alert(response);
//             console.log(response);
//             var result = JSON.parse(response);
//             if(result.ApiResponse=="Success"){
//                 indoordata = result.Data;
//                 updateLineChart(indoordata, pollutants);
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             // Handle errors here
//             console.error('Error:', textStatus, errorThrown);
//         }
//     });
// }

// function maybeDisposeRoot1(divId) {
//   if (typeof am5 !== 'undefined' && am5.registry && Array.isArray(am5.registry.rootElements)) {
//     am5.registry.rootElements.forEach(function (root) {
//         // Check if root and root.dom are defined
//         if (root && root.dom && root.dom.id === divId) {
//             root.dispose();
//         }
//     });
// } else {
//     console.warn('am5 or am5.registry.rootElements is not defined.');
// }
//   };
// function updateLineChart(chart_data, pollutants){
  
//   var label = "";
//   var unit = "";
//   if (pollutants == "pm25"){
//     label = "PM 2.5:";
//     unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
//   }
//   if (pollutants == "pm10"){
//     label = "PM 10:";
//     unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";

//   }
//   if (pollutants == "aqi"){
//     label = "AQI:";
//     unit = ""
//   }
//   if (pollutants == "co2"){
//     label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
//     unit = "(ppm)";
//   }
//   if (pollutants == "voc"){
//     label = "TVOC:";
//     unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";

//   }
  
  
    
//     /**
//  * ---------------------------------------
//  * This demo was created using amCharts 5.
//  * 
//  * For more information visit:
//  * https://www.amcharts.com/
//  * 
//  * Documentation is available at:
//  * https://www.amcharts.com/docs/v5/
//  * ---------------------------------------
//  */

//     maybeDisposeRoot1("linechart1");
    
// // Create root element
// // https://www.amcharts.com/docs/v5/getting-started/#Root_element
// var root = am5.Root.new("linechart1");


// // Set themes
// // https://www.amcharts.com/docs/v5/concepts/themes/
// root.setThemes([
//   am5themes_Animated.new(root)
// ]);


// // Create chart
// // https://www.amcharts.com/docs/v5/charts/xy-chart/
// var chart = root.container.children.push(am5xy.XYChart.new(root, {
//   panX: true,
//   panY: true,
//   wheelX: "panX",
//   wheelY: "zoomX",
//   pinchZoomX:true,
//   paddingLeft: 0
// }));


// // Add cursor
// // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
// var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
//   behavior: "none"
// }));
// cursor.lineY.set("visible", false);


// // Create axes
// // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
// var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
//   maxDeviation: 0.2,
//   baseInterval: {
//     timeUnit: "minute",
//     count: 15
//   },
//   renderer: am5xy.AxisRendererX.new(root, {
//     minorGridEnabled:true
//   }),
//   tooltip: am5.Tooltip.new(root, {})
// }));

// var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//   renderer: am5xy.AxisRendererY.new(root, {
//     pan:"zoom"
//   }) 
// }));

// yAxis.children.moveValue(am5.Label.new(root, {
//   text: label.substring(0, label.length - 1) + ' ' + unit,
//   textAlign: 'center',
//   y: am5.p50,
//     rotation: -90,
//   fontWeight: 'bold'
// }),0);
// // Add series
// // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
// var series = chart.series.push(am5xy.LineSeries.new(root, {
//   name: "Indoor",
//   xAxis: xAxis,
//   yAxis: yAxis,
//   stroke: "#2fb996",
//   valueYField: pollutants,
//   valueXField: "datetime",
//   tooltip: am5.Tooltip.new(root, {
//     labelText: label + " {valueY} "
//   }),
//   legendLabelText: "{name}",
// }));


// // Add scrollbar
// // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
// chart.set("scrollbarX", am5.Scrollbar.new(root, {
//   orientation: "horizontal"
// }));
// // Processor needs to be set before data
// series.data.processor = am5.DataProcessor.new(root, {
//     numericFields: [pollutants],
//     dateFields: ["datetime"],
//     dateFormat: "yyyy-MM-dd HH:mm:ss"
//   });

// // Set data
// series.data.setAll(chart_data);

// // Add legend
// // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
// var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
//   width: am5.percent(100),
//   /* paddingLeft: 20, */
//   height: 30,
//   x: am5.percent(50)
// }));

// // When legend item container is hovered, dim all the series except the hovered one
// legend.itemContainers.template.events.on("pointerover", function(e) {
//   var itemContainer = e.target;

//   // As series list is data of a legend, dataContext is series
//   var series = itemContainer.dataItem.dataContext;

//   chart.series.each(function(chartSeries) {
//     if (chartSeries != series) {
//       chartSeries.strokes.template.setAll({
//         strokeOpacity: 0.15,
//         stroke: "#2fb996",
//       });
//     } else {
//       chartSeries.strokes.template.setAll({
//         strokeWidth: 3
//       });
//     }
//   })
// })

// // When legend item container is unhovered, make all series as they are
// legend.itemContainers.template.events.on("pointerout", function(e) {
//   var itemContainer = e.target;
//   var series = itemContainer.dataItem.dataContext;

//   chart.series.each(function(chartSeries) {
//     chartSeries.strokes.template.setAll({
//       strokeOpacity: 1,
//       strokeWidth: 1,
//       stroke: "#2fb996"
//     });
//   });
// })

// legend.itemContainers.template.set("width", am5.p100);
// legend.valueLabels.template.setAll({
//   width: am5.p100,
//   textAlign: "right"
// });

// // It's is important to set legend data after all the events are set on template, otherwise events won't be copied
// legend.data.setAll(chart.series.values);

// // Make stuff animate on load
// // https://www.amcharts.com/docs/v5/concepts/animations/
// series.appear(1000);
// chart.appear(1000, 100);
// }


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

// function updateLineChart(chart_data, pollutants) {
//   var label = "";
//   var unit = "";
//   if (pollutants === "pm25") {
//       label = "PM 2.5:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
//   } else if (pollutants === "pm10") {
//       label = "PM 10:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
//   } else if (pollutants === "aqi") {
//       label = "AQI:";
//       unit = "";
//   } else if (pollutants === "co2") {
//       label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
//       unit = "(ppm)";
//   } else if (pollutants === "voc") {
//       label = "TVOC:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
//   }

//   maybeDisposeRoot1("linechart1");

//   // Create root element
//   var root = am5.Root.new("linechart1");

//   // Set themes
//   root.setThemes([
//       am5themes_Animated.new(root)
//   ]);

//   // Create chart
//   var chart = root.container.children.push(am5xy.XYChart.new(root, {
//       panX: true,
//       panY: true,
//       wheelX: "panX",
//       wheelY: "zoomX",
//       pinchZoomX: true,
//       paddingLeft: 0
//   }));

//   // Add cursor
//   var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
//       behavior: "none"
//   }));
//   cursor.lineY.set("visible", false);

//   // Create axes
//   var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
//       maxDeviation: 0.2,
//       baseInterval: {
//           timeUnit: "minute",
//           count: 15
//       },
//       renderer: am5xy.AxisRendererX.new(root, {
//           minorGridEnabled: true
//       }),
//       // tooltip: am5.Tooltip.new(root, {})
//   }));

//   var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           pan: "zoom"
//       })
//   }));

//   yAxis.children.moveValue(am5.Label.new(root, {
//       text: label.substring(0, label.length - 1) + ' ' + unit,
//       textAlign: 'center',
//       y: am5.p50,
//       rotation: -90,
//       fontWeight: 'bold'
//   }), 0);

//   // Add series
//   var series = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Indoor",
//       color: am5.color("#2fb996"),
//       xAxis: xAxis,
//       yAxis: yAxis,
//       stroke: "#2fb996",
//       valueYField: pollutants,
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: label + " {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"), // Tooltip text color
//               fontSize: 14 // Adjust text size if needed
//           })
//       }),
//       legendLabelText: "{name}",
//   }));

//   series.get("tooltip").get("background").setAll({
//     fill: am5.color("#2fb996"),  
//     stroke: am5.color("#2fb996"), 
//     strokeWidth: 1 
// });

// series.get("tooltip").set("getFillFromSprite", false);
// series.get("tooltip").set("getStrokeFromSprite", false);

//   // Add scrollbar
//   chart.set("scrollbarX", am5.Scrollbar.new(root, {
//       orientation: "horizontal"
//   }));

//   // Processor needs to be set before data
//   series.data.processor = am5.DataProcessor.new(root, {
//       numericFields: [pollutants],
//       dateFields: ["datetime"],
//       dateFormat: "yyyy-MM-dd HH:mm:ss"
//   });

//   // Set data
//   series.data.setAll(chart_data);

//   // Add legend
//   var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
//       width: am5.percent(100),
//       height: 30,
//       x: am5.percent(50)
//   }));

//   // When legend item container is hovered, dim all the series except the hovered one
//   legend.itemContainers.template.events.on("pointerover", function(e) {
//       var itemContainer = e.target;
//       var series = itemContainer.dataItem.dataContext;

//       chart.series.each(function(chartSeries) {
//           if (chartSeries !== series) {
//               chartSeries.strokes.template.setAll({
//                   strokeOpacity: 0.15,
//                   stroke: "#2fb996",
//               });
//           } else {
//               chartSeries.strokes.template.setAll({
//                   strokeWidth: 3
//               });
//           }
//       });
//   });

//   // When legend item container is unhovered, make all series as they are
//   legend.itemContainers.template.events.on("pointerout", function(e) {
//       var itemContainer = e.target;
//       var series = itemContainer.dataItem.dataContext;

//       chart.series.each(function(chartSeries) {
//           chartSeries.strokes.template.setAll({
//               strokeOpacity: 1,
//               strokeWidth: 1,
//               stroke: "#2fb996"
//           });
//       });
//   });

//   legend.itemContainers.template.set("width", am5.p100);
//   legend.valueLabels.template.setAll({
//       width: am5.p100,
//       textAlign: "right"
//   });

//   legend.data.setAll(chart.series.values);

//   // Make stuff animate on load
//   series.appear(1000);
//   chart.appear(1000, 100);
// }
// function updateLineChart(chart_data, pollutants) {
//    // Determine indoor column and label based on IC_column
//   //  let indoor_column = "";
//   //  let IC_label = "";
//   //  if (IC_column == "temp") {
//   //    indoor_column = "avg_temp";
//   //    IC_label = "Temperature (C)";
//   //  } else if (IC_column == "RH") {
//   //    indoor_column = "avg_hum";
//   //    IC_label = "Humidity (%)";
//   //  }
//   var label = "";
//   var unit = "";
//   if (pollutants === "pm25") {
//       label = "PM 2.5:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/]) ";
//   } else if (pollutants === "pm10") {
//       label = "PM 10:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
//   } else if (pollutants === "aqi") {
//       label = "AQI:";
//       unit = "";
//   } else if (pollutants === "co2") {
//       label = "CO[fontSize:10px; verticalAlign: sub;]2[/]:";
//       unit = "(ppm)";
//   } else if (pollutants === "voc") {
//       label = "TVOC:";
//       unit = "(µg/m[fontSize:10px; verticalAlign: super;]3[/])";
//   }

//   maybeDisposeRoot1("linechart1");

//   // Create root element
//   var root = am5.Root.new("linechart1");

//   // Set themes
//   root.setThemes([
//       am5themes_Animated.new(root)
//   ]);

//   // Create chart
//   var chart = root.container.children.push(am5xy.XYChart.new(root, {
//       panX: true,
//       panY: true,
//       wheelX: "panX",
//       wheelY: "zoomX",
//       pinchZoomX: true,
//       paddingLeft: 0
//   }));

//   // Add cursor
//   var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
//       behavior: "none"
//   }));
//   cursor.lineY.set("visible", false);

//   // Create X-Axis
//   var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
//       maxDeviation: 0.2,
//       baseInterval: {
//           timeUnit: "minute",
//           count: 15
//       },
//       renderer: am5xy.AxisRendererX.new(root, {
//           minorGridEnabled: true
//       })
//   }));

//   // Create Primary Y-Axis for pollutants
//   var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           pan: "zoom"
//       })
//   }));

//   // Set Axis Title
//   yAxis.children.moveValue(am5.Label.new(root, {
//       text: label.substring(0, label.length - 1) + ' ' + unit,
//       textAlign: 'center',
//       y: am5.p50,
//       rotation: -90,
//       fontWeight: 'bold'
//   }), 0);

//   // Create Secondary Y-Axis for temperature
//   var yAxisTemp = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           opposite: true
//       }),
//       min: -10,
//       max: 55,
//       title: am5.Label.new(root, {
//         text: "Temperature",
//         fontSize: 15,
//         fill: am5.color(0x000000) // Adjust color if needed
//     })

//   }));

//   // Create Series for pollutants
//   var series = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Indoor",
//       color: am5.color("#2fb996"),
//       xAxis: xAxis,
//       yAxis: yAxis,
//       stroke: "#2fb996",
//       valueYField: pollutants,
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: label + " {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"), // Tooltip text color
//               fontSize: 14 // Adjust text size if needed
//           })
//       }),
//       legendLabelText: "{name}",
//   }));

//   series.get("tooltip").get("background").setAll({
//       fill: am5.color("#2fb996"),  
//       stroke: am5.color("#2fb996"), 
//       strokeWidth: 1 
//   });

//   series.get("tooltip").set("getFillFromSprite", false);
//   series.get("tooltip").set("getStrokeFromSprite", false);

//   // Create Series for temperature
//   var seriesTemp = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Average Temperature",
//       color: am5.color("#f16463"),
//       xAxis: xAxis,
//       yAxis: yAxisTemp,  // Use the secondary Y-axis
//       stroke: "#f16463",
//       valueYField: "avg_temp",
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: "Average Temp: {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"), // Tooltip text color
//               fontSize: 14 // Adjust text size if needed
//           })
//       }),
//       legendLabelText: "{name}",
//   }));
//   seriesTemp.get("tooltip").get("background").setAll({
//     fill: am5.color("#f16463"),  
//     stroke: am5.color("#f16463"), 
//     strokeWidth: 1 
// });
//   // Add scrollbar
//  chart .set("scrollbarX", am5.Scrollbar.new(root, {
//       orientation: "horizontal"
//   }));

//   // Processor needs to be set before data
//   series.data.processor = am5.DataProcessor.new(root, {
//       numericFields: [pollutants, "avg_temp"],
//       dateFields: ["datetime"],
//       dateFormat: "yyyy-MM-dd HH:mm:ss"
//   });

//   // Set data
//   series.data.setAll(chart_data);
//   seriesTemp.data.setAll(chart_data);

//   // Add legend
//   var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
//       width: am5.percent(100),
//       height: 30,
//       x: am5.percent(50)
//   }));

//   // When legend item container is hovered, dim all the series except the hovered one
//   legend.itemContainers.template.events.on("pointerover", function(e) {
//       var itemContainer = e.target;
//       var series = itemContainer.dataItem.dataContext;

//       chart.series.each(function(chartSeries) {
//           if (chartSeries !== series) {
//               chartSeries.strokes.template.setAll({
//                   strokeOpacity: 0.15,
//                   stroke: "#f16463",
//               });
//           } else {
//               chartSeries.strokes.template.setAll({
//                   strokeWidth: 3
//               });
//           }
//       });
//   });

//   // When legend item container is unhovered, make all series as they are
//   legend.itemContainers.template.events.on("pointerout", function(e) {
//       chart.series.each(function(chartSeries) {
//           chartSeries.strokes.template.setAll({
//               strokeOpacity: 1,
//               strokeWidth: 1,
//               stroke: "#f16463"
//           });
//       });
//   });

//   legend.itemContainers.template.set("width", am5.p100);
//   legend.valueLabels.template.setAll({
//       width: am5.p100,
//       textAlign: "right"
//   });

//   legend.data.setAll(chart.series.values);

//   // Make stuff animate on load
//   series.appear(1000);
//   seriesTemp.appear(1000);
//   chart.appear(1000, 100);
// }
// function updateLineChart(chart_data, pollutants) {
//   var label = "";
//   var unit = "";
//   if (pollutants === "pm25") {
//       label = "PM 2.5:";
//       unit = "(µg/m³)";
//   } else if (pollutants === "pm10") {
//       label = "PM 10:";
//       unit = "(µg/m³)";
//   } else if (pollutants === "aqi") {
//       label = "AQI:";
//       unit = "";
//   } else if (pollutants === "co2") {
//       label = "CO₂:";
//       unit = "(ppm)";
//   } else if (pollutants === "voc") {
//       label = "TVOC:";
//       unit = "(µg/m³)";
//   }

//   maybeDisposeRoot1("linechart1");

//   var root = am5.Root.new("linechart1");
//   root.setThemes([am5themes_Animated.new(root)]);

//   var chart = root.container.children.push(am5xy.XYChart.new(root, {
//       panX: true,
//       panY: true,
//       wheelX: "panX",
//       wheelY: "zoomX",
//       pinchZoomX: true,
//       paddingLeft: 0
//   }));

//   var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
//       behavior: "none"
//   }));
//   cursor.lineY.set("visible", false);

//   var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
//       maxDeviation: 0.2,
//       baseInterval: {
//           timeUnit: "minute",
//           count: 15
//       },
//       renderer: am5xy.AxisRendererX.new(root, {
//           minorGridEnabled: true
//       })
//   }));

//   var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           pan: "zoom"
//       })
//   }));

//   yAxis.children.moveValue(am5.Label.new(root, {
//       text: label + ' ' + unit,
//       textAlign: 'center',
//       y: am5.p50,
//       rotation: -90,
//       fontWeight: 'bold'
//   }), 0);

//   var yAxisTemp = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           opposite: true
//       }),
//       min: -10,
//       max: 55,
//       title: am5.Label.new(root, {
//           text: "Temperature (°C)",
//           fontSize: 15,
//           fill: am5.color(0x000000)
//       })
//   }));

//   var yAxisHum = chart.yAxes.push(am5xy.ValueAxis.new(root, {
//       renderer: am5xy.AxisRendererY.new(root, {
//           opposite: true
//       }),
//       min: 0,
//       max: 100,
//       title: am5.Label.new(root, {
//           text: "Humidity (%)",
//           fontSize: 15,
//           fill: am5.color(0x000000)
//       })
//   }));

//   var series = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Pollutant",
//       color: am5.color("#2fb996"),
//       xAxis: xAxis,
//       yAxis: yAxis,
//       stroke: "#2fb996",
//       valueYField: pollutants,
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: label + " {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"),
//               fontSize: 14
//           })
//       }),
//       legendLabelText: "{name}",
//   }));

//   series.get("tooltip").get("background").setAll({
//       fill: am5.color("#2fb996"),
//       stroke: am5.color("#2fb996"),
//       strokeWidth: 1
//   });

//   series.get("tooltip").set("getFillFromSprite", false);
//   series.get("tooltip").set("getStrokeFromSprite", false);

//   var seriesTemp = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Average Temperature",
//       color: am5.color("#f16463"),
//       xAxis: xAxis,
//       yAxis: yAxisTemp,
//       stroke: "#f16463",
//       valueYField: "avg_temp",
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: "Average Temp: {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"),
//               fontSize: 14
//           })
//       }),
//       legendLabelText: "{name}",
//   }));

//   seriesTemp.get("tooltip").get("background").setAll({
//       fill: am5.color("#f16463"),
//       stroke: am5.color("#f16463"),
//       strokeWidth: 1
//   });

//   var seriesHum = chart.series.push(am5xy.LineSeries.new(root, {
//       name: "Average Humidity",
//       color: am5.color("#4b9bd5"),
//       xAxis: xAxis,
//       yAxis: yAxisHum,
//       stroke: "#4b9bd5",
//       valueYField: "avg_hum",
//       valueXField: "datetime",
//       tooltip: am5.Tooltip.new(root, {
//           labelText: "Average Humidity: {valueY}",
//           label: am5.Label.new(root, {
//               fill: am5.color("#ffffff"),
//               fontSize: 14
//           })
//       }),
//       legendLabelText: "{name}",
//   }));

//   seriesHum.get("tooltip").get("background").setAll({
//       fill: am5.color("#4b9bd5"),
//       stroke: am5.color("#4b9bd5"),
//       strokeWidth: 1
//   });

//   chart.set("scrollbarX", am5.Scrollbar.new(root, {
//       orientation: "horizontal"
//   }));

//   series.data.processor = am5.DataProcessor.new(root, {
//       numericFields: [pollutants, "avg_temp", "avg_hum"],
//       dateFields: ["datetime"],
//       dateFormat: "yyyy-MM-dd HH:mm:ss"
//   });

//   series.data.setAll(chart_data);
//   seriesTemp.data.setAll(chart_data);
//   seriesHum.data.setAll(chart_data);

//   var legend = chart.bottomAxesContainer.children.push(am5.Legend.new(root, {
//       width: am5.percent(100),
//       height: 30,
//       x: am5.percent(50)
//   }));

//   // Ensure hover affects only the hovered series
//   legend.itemContainers.template.events.on("pointerover", function(e) {
//       var itemContainer = e.target;
//       var series = itemContainer.dataItem.dataContext;

//       chart.series.each(function(chartSeries) {
//           if (chartSeries !== series) {
//               chartSeries.strokes.template.setAll({
//                   strokeOpacity: 0.15,
//                   stroke: chartSeries.get("color"), // Ensure the original color is retained
//               });
//           } else {
//               chartSeries.strokes.template.setAll({
//                   strokeWidth: 3
//               });
//           }
//       });
//   });

//   legend.itemContainers.template.events.on("pointerout", function(e) {
//       chart.series.each(function(chartSeries) {
//           chartSeries.strokes.template.setAll({
//               strokeOpacity: 1,
//               strokeWidth: 1,
//               stroke: chartSeries.get("color") // Ensure the original color is retained
//           });
//       });
//   });

//   legend.itemContainers.template.set("width", am5.p100);
//   legend.valueLabels.template.setAll({
//       width: am5.p100,
//       textAlign: "right"
//   });

//   legend.data.setAll(chart.series.values);

//   // Set default visibility
//   seriesTemp.show();
//   seriesHum.hide();

//   // Button event listeners
//   document.getElementById('showTemp').addEventListener('click', function() {
//       seriesTemp.show();
//       seriesHum.hide();
//       document.getElementById('showTemp').classList.add('active');
//       document.getElementById('showHumidity').classList.remove('active');
//   });

//   document.getElementById('showHumidity').addEventListener('click', function() {
//       seriesTemp.hide();
//       seriesHum.show();
//       document.getElementById('showTemp').classList.remove('active');
//       document.getElementById('showHumidity').classList.add('active');
//   });
// }

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
      label = "AQI:";
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

  var yAxisPollutants = chart.yAxes.push(am5xy.ValueAxis.new(root, {
      renderer: am5xy.AxisRendererY.new(root, {
          pan: "zoom"
      }),
      title: am5.Label.new(root, {
          text: label + ' ' + unit,
          fontSize: 15,
          fill: am5.color(0x000000)
      })
  }));

  var series = chart.series.push(am5xy.LineSeries.new(root, {
      name: "Pollutant",
      color: am5.color("#2fb996"),
      xAxis: xAxis,
      yAxis: yAxisPollutants,
      stroke: "#2fb996",
      valueYField: pollutants,
      valueXField: "datetime",
      tooltip: am5.Tooltip.new(root, {
          labelText: label + " {valueY}",
          label: am5.Label.new(root, {
              fill: am5.color("#ffffff"),
              fontSize: 14
          })
      }),
      legendLabelText: "{name}",
  }));

  series.get("tooltip").get("background").setAll({
      fill: am5.color("#2fb996"),
      stroke: am5.color("#2fb996"),
      strokeWidth: 1
  });

  series.get("tooltip").set("getFillFromSprite", false);
  series.get("tooltip").set("getStrokeFromSprite", false);

  // Add scrollbar
  chart.set("scrollbarX", am5.Scrollbar.new(root, {
      orientation: "horizontal"
  }));

  series.data.processor = am5.DataProcessor.new(root, {
      numericFields: [pollutants],
      dateFields: ["datetime"],
      dateFormat: "yyyy-MM-dd HH:mm:ss"
  });

  series.data.setAll(chart_data);

  // Button event listeners
  document.getElementById('showTemp').addEventListener('click', function() {
      document.getElementById('showTemp').classList.add('active');
      document.getElementById('showHumidity').classList.remove('active');
  });

  document.getElementById('showHumidity').addEventListener('click', function() {
      document.getElementById('showTemp').classList.remove('active');
      document.getElementById('showHumidity').classList.add('active');
  });
}
