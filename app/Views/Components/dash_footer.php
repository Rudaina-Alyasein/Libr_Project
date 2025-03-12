
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="/assets/vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script> -->

<!-- page datatables -->
<script src="/assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>


<!-- Page level plugins -->
<script src="/assets/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>


<!--charts files-->
<script src="/assets/vendor/chart.js/Chart.bundle.js"></script>
<script src="/assets/vendor/chart.js/Chart.js"></script>
<script src="/assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="/assets/vendor/chart.js/Chart.min.js"></script>


<script src="/assets/js/demo/chart-area-demo.js"></script>
<!-- <script src="/assets/js/demo/chart-pie-demo.js"></script> -->



<script src="/assets/js/book.js"></script>
<script src="/assets/js/borrower.js"></script>


<script>
    var array_bo = [];
    var array_bo1 = [];
    var ggg = <?php echo json_encode($borrowedBooksByCategory); ?>;
    console.log(ggg);
    ggg.forEach((element) => array_bo.push(element['borrow_count']));
    ggg.forEach((element) => array_bo1.push(element['cat_name']));

    console.log(array_bo);


    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily =
        "Nunito, -apple-system, system-ui, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif";
    Chart.defaults.global.defaultFontColor = "#858796";

    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: array_bo1,
            datasets: [{
                data: array_bo, // Ensure this array matches the number of labels
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
            }, ],
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
</script>



</body>

</html>