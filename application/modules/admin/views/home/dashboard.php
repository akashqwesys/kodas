<?php if ($title == "Administration - Home") { ?>
  <script>
    var xValues = ["<?php echo $mTmOrdersMonthStr; ?>"];
    var yValues = [<?php echo $mTmOrdersValue; ?>];
    var barColors = ["#faebcc", "#faebcc", "#faebcc", "#faebcc", "#faebcc", "#faebcc"];

    new Chart("mTomOrders", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Last 6 Month (Monthly Orders)"
        }
      }
    });

    var xValues = ["<?php echo $mTmActiveCustomerMonthStr; ?>"];
    var yValues = [<?php echo $mTmActiveCustomerValue; ?>];
    var barColors = ["#ebccd1", "#ebccd1", "#ebccd1", "#ebccd1", "#ebccd1", "#ebccd1"];

    new Chart("mTomActiveUser", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Last 6 Month Active Users"
        }
      }
    });

    new Chart("viewVsOrder", {
      type: "bar",
      data: {
        labels: ["<?php echo $voMonth; ?>"],
        datasets: [{
            label: "Order Count",
            yAxisID: 'bar-stack',
            backgroundColor: "#faebcc",
            borderColor: "gray",
            borderWidth: 1,
            stack: 'now',
            data: [<?php echo $voOrders; ?>]
          },
          {
            label: "Product Views",
            yAxisID: 'bar-stack',
            backgroundColor: "#ebccd1",
            borderColor: "gray",
            borderWidth: 1,
            stack: 'bef',
            data: [<?php echo $voViews; ?>]
          },
        ]
      },
      options: {       
        title: {
          display: true,
          text: "Last 6 Month Product Views & Orders"
        },
        responsive: true,
        scales: {
          yAxes: [{
            id: "bar-stack",
            position: "left",
            stacked: true,
            ticks: {
              beginAtZero: true
            }
          }, ]
        }
      }
    });
    new Chart("customerVsOrder", {
      type: "bar",
      data: {
        labels: ["<?php echo $coMonth; ?>"],
        datasets: [{
            label: "Order Count",
            yAxisID: 'bar-stack',
            backgroundColor: "#faebcc",
            borderColor: "gray",
            borderWidth: 1,
            stack: 'now',
            data: [<?php echo $coOrders; ?>]
          },
          {
            label: "Registered User",
            yAxisID: 'bar-stack',
            backgroundColor: "#ebccd1",
            borderColor: "gray",
            borderWidth: 1,
            stack: 'bef',
            data: [<?php echo $coUser; ?>]
          },
        ]
      },
      options: {       
        title: {
          display: true,
          text: "Last 6 Month Customer Registration & Orders"
        },
        responsive: true,
        scales: {
          yAxes: [{
            id: "bar-stack",
            position: "left",
            stacked: true,
            ticks: {
              beginAtZero: true
            }
          }, ]
        }
      }
    });
  </script>
<?php } ?>