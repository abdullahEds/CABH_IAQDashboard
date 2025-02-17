// chart 1

am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    startAngle: 160, endAngle: 380
  })
);

// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series

var series0 = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "litres",
    categoryField: "country",
    startAngle: 160,
    endAngle: 380,
    radius: am5.percent(95),
    innerRadius: am5.percent(85)
  })
);

var colorSet = am5.ColorSet.new(root, {
  colors: [series0.get("colors").getIndex(0)],
  passOptions: {
    lightness: -0.05,
    hue: 0
  }
});

series0.set("colors", colorSet);

series0.ticks.template.set("forceHidden", true);
series0.labels.template.set("forceHidden", true);

/* var series1 = chart.series.push(
  am5percent.PieSeries.new(root, {
    startAngle: 160,
    endAngle: 380,
    valueField: "bottles",
    innerRadius: am5.percent(90),
    categoryField: "country"
  })
);

series1.ticks.template.set("forceHidden", true);
series1.labels.template.set("forceHidden", true); */

var label = chart.seriesContainer.children.push(
  am5.Label.new(root, {
    textAlign: "center",
    centerY: am5.p100,
    centerX: am5.p50,
    text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
  })
);

var data = [
  {
    country: "Lithuania",
    litres: 501.9,
    bottles: 1500
  },
  {
    country: "Czech Republic",
    litres: 301.9,
    bottles: 990
  },
  {
    country: "Ireland",
    litres: 201.1,
    bottles: 785
  },
  {
    country: "Germany",
    litres: 165.8,
    bottles: 255
  },
  {
    country: "Australia",
    litres: 139.9,
    bottles: 452
  },
  {
    country: "Austria",
    litres: 128.3,
    bottles: 332
  },
  {
    country: "UK",
    litres: 99,
    bottles: 150
  },
  {
    country: "Belgium",
    litres: 60,
    bottles: 178
  },
  {
    country: "The Netherlands",
    litres: 50,
    bottles: 50
  }
];

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series0.data.setAll(data);
series1.data.setAll(data);

}); // end am5.ready()


/////////////////////////////////////////////////////////////////////////////
//chart2


am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv2");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        startAngle: 160, endAngle: 380
      })
    );
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    
    var series0 = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "litres",
        categoryField: "country",
        startAngle: 160,
        endAngle: 380,
        radius: am5.percent(95),
        innerRadius: am5.percent(85)
      })
    );
    
    var colorSet = am5.ColorSet.new(root, {
      colors: [series0.get("colors").getIndex(0)],
      passOptions: {
        lightness: -0.05,
        hue: 0
      }
    });
    
    series0.set("colors", colorSet);
    
    series0.ticks.template.set("forceHidden", true);
    series0.labels.template.set("forceHidden", true);
    
    /* var series1 = chart.series.push(
      am5percent.PieSeries.new(root, {
        startAngle: 160,
        endAngle: 380,
        valueField: "bottles",
        innerRadius: am5.percent(90),
        categoryField: "country"
      })
    );
    
    series1.ticks.template.set("forceHidden", true);
    series1.labels.template.set("forceHidden", true); */
    
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p100,
        centerX: am5.p50,
        text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
      })
    );
    
    var data = [
      {
        country: "Lithuania",
        litres: 501.9,
        bottles: 1500
      },
      {
        country: "Czech Republic",
        litres: 301.9,
        bottles: 990
      },
      {
        country: "Ireland",
        litres: 201.1,
        bottles: 785
      },
      {
        country: "Germany",
        litres: 165.8,
        bottles: 255
      },
      {
        country: "Australia",
        litres: 139.9,
        bottles: 452
      },
      {
        country: "Austria",
        litres: 128.3,
        bottles: 332
      },
      {
        country: "UK",
        litres: 99,
        bottles: 150
      },
      {
        country: "Belgium",
        litres: 60,
        bottles: 178
      },
      {
        country: "The Netherlands",
        litres: 50,
        bottles: 50
      }
    ];
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series0.data.setAll(data);
    series1.data.setAll(data);
    
    }); // end am5.ready()

    
    ////////////////////////////////////////////////////////////////////
    //chart3

    
am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv3");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        startAngle: 160, endAngle: 380
      })
    );
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    
    var series0 = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "litres",
        categoryField: "country",
        startAngle: 160,
        endAngle: 380,
        radius: am5.percent(95),
        innerRadius: am5.percent(85)
      })
    );
    
    var colorSet = am5.ColorSet.new(root, {
      colors: [series0.get("colors").getIndex(0)],
      passOptions: {
        lightness: -0.05,
        hue: 0
      }
    });
    
    series0.set("colors", colorSet);
    
    series0.ticks.template.set("forceHidden", true);
    series0.labels.template.set("forceHidden", true);
    
    /* var series1 = chart.series.push(
      am5percent.PieSeries.new(root, {
        startAngle: 160,
        endAngle: 380,
        valueField: "bottles",
        innerRadius: am5.percent(90),
        categoryField: "country"
      })
    );
    
    series1.ticks.template.set("forceHidden", true);
    series1.labels.template.set("forceHidden", true); */
    
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p100,
        centerX: am5.p50,
        text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
      })
    );
    
    var data = [
      {
        country: "Lithuania",
        litres: 501.9,
        bottles: 1500
      },
      {
        country: "Czech Republic",
        litres: 301.9,
        bottles: 990
      },
      {
        country: "Ireland",
        litres: 201.1,
        bottles: 785
      },
      {
        country: "Germany",
        litres: 165.8,
        bottles: 255
      },
      {
        country: "Australia",
        litres: 139.9,
        bottles: 452
      },
      {
        country: "Austria",
        litres: 128.3,
        bottles: 332
      },
      {
        country: "UK",
        litres: 99,
        bottles: 150
      },
      {
        country: "Belgium",
        litres: 60,
        bottles: 178
      },
      {
        country: "The Netherlands",
        litres: 50,
        bottles: 50
      }
    ];
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series0.data.setAll(data);
    series1.data.setAll(data);
    
    }); // end am5.ready()

    
    /////////////////////////////////////////////////////////////////
    //chart4
    
am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv4");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        startAngle: 160, endAngle: 380
      })
    );
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    
    var series0 = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "litres",
        categoryField: "country",
        startAngle: 160,
        endAngle: 380,
        radius: am5.percent(95),
        innerRadius: am5.percent(85)
      })
    );
    
    var colorSet = am5.ColorSet.new(root, {
      colors: [series0.get("colors").getIndex(0)],
      passOptions: {
        lightness: -0.05,
        hue: 0
      }
    });
    
    series0.set("colors", colorSet);
    
    series0.ticks.template.set("forceHidden", true);
    series0.labels.template.set("forceHidden", true);
    
    /* var series1 = chart.series.push(
      am5percent.PieSeries.new(root, {
        startAngle: 160,
        endAngle: 380,
        valueField: "bottles",
        innerRadius: am5.percent(90),
        categoryField: "country"
      })
    );
    
    series1.ticks.template.set("forceHidden", true);
    series1.labels.template.set("forceHidden", true); */
    
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p100,
        centerX: am5.p50,
        text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
      })
    );
    
    var data = [
      {
        country: "Lithuania",
        litres: 501.9,
        bottles: 1500
      },
      {
        country: "Czech Republic",
        litres: 301.9,
        bottles: 990
      },
      {
        country: "Ireland",
        litres: 201.1,
        bottles: 785
      },
      {
        country: "Germany",
        litres: 165.8,
        bottles: 255
      },
      {
        country: "Australia",
        litres: 139.9,
        bottles: 452
      },
      {
        country: "Austria",
        litres: 128.3,
        bottles: 332
      },
      {
        country: "UK",
        litres: 99,
        bottles: 150
      },
      {
        country: "Belgium",
        litres: 60,
        bottles: 178
      },
      {
        country: "The Netherlands",
        litres: 50,
        bottles: 50
      }
    ];
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series0.data.setAll(data);
    series1.data.setAll(data);
    
    }); // end am5.ready()

    
    //////////////////////////////////////////////////////////////////
    //chart5
    
am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv5");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        startAngle: 160, endAngle: 380
      })
    );
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    
    var series0 = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "litres",
        categoryField: "country",
        startAngle: 160,
        endAngle: 380,
        radius: am5.percent(95),
        innerRadius: am5.percent(85)
      })
    );
    
    var colorSet = am5.ColorSet.new(root, {
      colors: [series0.get("colors").getIndex(0)],
      passOptions: {
        lightness: -0.05,
        hue: 0
      }
    });
    
    series0.set("colors", colorSet);
    
    series0.ticks.template.set("forceHidden", true);
    series0.labels.template.set("forceHidden", true);
    
    /* var series1 = chart.series.push(
      am5percent.PieSeries.new(root, {
        startAngle: 160,
        endAngle: 380,
        valueField: "bottles",
        innerRadius: am5.percent(90),
        categoryField: "country"
      })
    );
    
    series1.ticks.template.set("forceHidden", true);
    series1.labels.template.set("forceHidden", true); */
    
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p100,
        centerX: am5.p50,
        text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
      })
    );
    
    var data = [
      {
        country: "Lithuania",
        litres: 501.9,
        bottles: 1500
      },
      {
        country: "Czech Republic",
        litres: 301.9,
        bottles: 990
      },
      {
        country: "Ireland",
        litres: 201.1,
        bottles: 785
      },
      {
        country: "Germany",
        litres: 165.8,
        bottles: 255
      },
      {
        country: "Australia",
        litres: 139.9,
        bottles: 452
      },
      {
        country: "Austria",
        litres: 128.3,
        bottles: 332
      },
      {
        country: "UK",
        litres: 99,
        bottles: 150
      },
      {
        country: "Belgium",
        litres: 60,
        bottles: 178
      },
      {
        country: "The Netherlands",
        litres: 50,
        bottles: 50
      }
    ];
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series0.data.setAll(data);
    series1.data.setAll(data);
    
    }); // end am5.ready()

    
    /////////////////////////////////////////////////////////////////////
    //chart 6
    
am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv6");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
    var chart = root.container.children.push(
      am5percent.PieChart.new(root, {
        startAngle: 160, endAngle: 380
      })
    );
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    
    var series0 = chart.series.push(
      am5percent.PieSeries.new(root, {
        valueField: "litres",
        categoryField: "country",
        startAngle: 160,
        endAngle: 380,
        radius: am5.percent(95),
        innerRadius: am5.percent(85)
      })
    );
    
    var colorSet = am5.ColorSet.new(root, {
      colors: [series0.get("colors").getIndex(0)],
      passOptions: {
        lightness: -0.05,
        hue: 0
      }
    });
    
    series0.set("colors", colorSet);
    
    series0.ticks.template.set("forceHidden", true);
    series0.labels.template.set("forceHidden", true);
    
    /* var series1 = chart.series.push(
      am5percent.PieSeries.new(root, {
        startAngle: 160,
        endAngle: 380,
        valueField: "bottles",
        innerRadius: am5.percent(90),
        categoryField: "country"
      })
    );
    
    series1.ticks.template.set("forceHidden", true);
    series1.labels.template.set("forceHidden", true); */
    
    var label = chart.seriesContainer.children.push(
      am5.Label.new(root, {
        textAlign: "center",
        centerY: am5.p100,
        centerX: am5.p50,
        text: "[fontSize:20px]total[/]:\n[bold fontSize:20px]1647.9[/]"
      })
    );
    
    var data = [
      {
        country: "Lithuania",
        litres: 501.9,
        bottles: 1500
      },
      {
        country: "Czech Republic",
        litres: 301.9,
        bottles: 990
      },
      {
        country: "Ireland",
        litres: 201.1,
        bottles: 785
      },
      {
        country: "Germany",
        litres: 165.8,
        bottles: 255
      },
      {
        country: "Australia",
        litres: 139.9,
        bottles: 452
      },
      {
        country: "Austria",
        litres: 128.3,
        bottles: 332
      },
      {
        country: "UK",
        litres: 99,
        bottles: 150
      },
      {
        country: "Belgium",
        litres: 60,
        bottles: 178
      },
      {
        country: "The Netherlands",
        litres: 50,
        bottles: 50
      }
    ];
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series0.data.setAll(data);
    series1.data.setAll(data);
    
    }); // end am5.ready()
    