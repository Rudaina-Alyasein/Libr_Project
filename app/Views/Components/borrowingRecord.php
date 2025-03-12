

                

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-left py-3">Borrower Management</h1>



                    <div id="addAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                      <strong id="addMsg"></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <!-- <div id="updateAlert" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                      <strong id="updateMsg"></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div id="deleteAlert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                      <strong id="deleteMsg"></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- < class="m-0 font-weight-bold text-primary">DataTables Example</>  -->
                            <!--  Button trigger modal -->
                           <!-- Button trigger modal -->
                            <button type="button" class="btn theme text-white float-right" data-toggle="modal" data-target="#exampleModal">                            
                                Add Borrower
                            </button>
                         

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Borrower</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                  <div id="alertContainer_black" class="col-12 d-none" >
                                        <div class="alert alert-danger" role="alert" id="errorMessages_black"></div>

                                  </div>
                                  <div id="alertContainer" class="col-12" style="display: none;">
                                        <div class="alert alert-danger" role="alert" id="errorMessages"></div>

                                  </div>
                                  <form id="borrowerForm">
                                       
                                       <div class="form-group">
                                           <label for="name">Full Name</label>
                                           <input type="text" class="form-control" id="name" name="name" list="names" require>
                                           <datalist id="names"> </datalist>
                                              

                                       

                                       </div>

                                       <div class="form-group">
                                           <label for="email">Email</label>
                                           <input type="email" class="form-control" id="email" name="email" required>
                                       </div>

                                       <div class="form-group">
                                           <label for="phone">Phone</label>
                                           <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10,15}">
                                       </div>

                                       <div class="form-group">
                                           <label for="book-id">Book </label>
                                           <!-- <input type="number" class="form-control" id="book-id" name="book-id" value="1" required> -->
                                           <select class="form-control" id="book-id" name="book-id" required>

                                           <?php foreach($books as $book):?>
                                            <option value="<?= $book->book_id ?>"><?= $book->title ?></option>

                                           <?php endforeach ?>
                                           </select>
                                       </div>

                                       <div class="form-group">
                                           <label for="Date_Of_Borrowing">Date Of Borrowing</label>
                                           <input type="datetime-local" class="form-control" id="Date_Of_Borrowing" name="Date_Of_Borrowing" required>
                                       </div>

                                       <div class="form-group">
                                           <label for="Expected_Return_Date">Expected Return Date</label>
                                           <input type="datetime-local" class="form-control" id="Expected_Return_Date" name="Expected_Return_Date" required>
                                       </div>

                                       <!-- <div class="form-group">
                                           <label for="Actual_Return_Date">Actual Return Date</label>
                                           <input type="datetime-local" class="form-control" id="Actual_Return_Date" name="Actual_Return_Date">
                                        </div> -->

                               <div class="modal-footer">
                                   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                   <button type="button" class="btn theme text-white" id="addBorrowerBtn">Add Borrower</button>
                               </div>
                         </form>
                               
                                
                                </div>
                              </div>
                            </div>
                        </div>


                           
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Book</th>
                                            <th>Bor</th>
                                            <th>Exp</th>
                                            <th>Act</th>
                                            <th>Action</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Book</th>
                                            <th>Bor</th>
                                            <th>Exp</th>
                                            <th>Act</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       
                                   
                                     
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <!-- /.container-fluid -->




    
                


  
  

        
