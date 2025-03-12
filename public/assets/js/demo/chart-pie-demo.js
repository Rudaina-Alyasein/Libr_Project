// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  "Nunito, -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif";
Chart.defaults.global.defaultFontColor = "#858796";

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: [
      "Romance",
      "History",
      "Science Fiction",
      "Children",
      "Technology",
      "Personal Development",
      "Cook Books",
      "Psychology",
    ],
    datasets: [
      {
        data: [55, 30, 15, 10, 5, 25, 20, 35], // Ensure this array matches the number of labels
        backgroundColor: [
          "#FF6384", // Romance
          "#36A2EB", // History
          "#FFCE56", // Science Fiction
          "#4BC0C0", // Children
          "#9966FF", // Technology
          "#FF9F40", // Personal Development
          "#FF6384", // Cook Books
          "#36A2EB", // Psychology
        ],
        hoverBackgroundColor: [
          "#FF6384",
          "#36A2EB",
          "#FFCE56",
          "#4BC0C0",
          "#9966FF",
          "#FF9F40",
          "#FF6384",
          "#36A2EB",
        ],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: "#dddfeb",
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false,
    },
    cutoutPercentage: 60,
  },
});
