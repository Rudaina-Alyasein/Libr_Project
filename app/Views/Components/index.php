<!-- Page Wrapper -->


<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">




            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!--  total no. books Card  -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="cards card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text_card text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            total books</div>
                                        <!-- Components/index.php -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $existingBooksCount; ?></div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="dash_icons fa-solid fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  Borrowing Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="cards card shadow h-100 py-2">
                            <div class="card-body">
                                <div class=" row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text_card text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Borrowing</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $existingBorrowersCount; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="dash_icons fa-solid fa-list-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- borrowers Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="cards card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text_card text-xs font-weight-bold text-info text-uppercase mb-1">borrowers
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $countDistinctBorrowers; ?></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="dash_icons fa-solid fa-user-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- black list Card-->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="cards card shadow h-100 py-2">
                            <div class="card-body">
                                <div class=" row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text_card text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            black list</div>
                                        <div id="rowCountElement" class="blacklist h5 mb-0 font-weight-bold text-gray-800"><?= $overdueBorrowersCount ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="dash_icons fa-solid fa-user-large-slash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header card_header_color py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Users Overview</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header card_header_color py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Categories Borrowed </h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <!-- <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#FF6384;"></i> Romance
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#36A2EB;"></i> History
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#FFCE56;"></i> Science Fiction
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#4BC0C0;"></i> Children
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#9966FF;"></i> Technology
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#FF9F40;"></i> Personal Development
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#FFCD56;"></i> Cook Books
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color:#C9CBCF;"></i> Psychology
                                    </span>
                                </div> -->
                            </div>


                            <!-- Content Row -->
                            <div class="row">


                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->


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