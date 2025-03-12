

  
  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 py-3">Book Management</h1>



                <!-- <div  id="deleteAlert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                <span id="deleteMsg"></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->


                <div id="addAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                      <strong id="addMsg"></strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div id="updateAlert" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
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
                    </div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- < class="m-0 font-weight-bold text-primary">DataTables Example</> -->
       <!-- Button trigger modal -->

       <button type="button" class="btn theme text-white float-right" data-toggle="modal" data-target="#addBookModal">                            
          Add New Book
        </button>

    


    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Publish-date</th>
                        <th>Quantity</th>
                        <!-- <th>QR</th> -->
                        <th>Action</th>
                        
                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Publish-date</th>
                        <th>Quantity</th>
                        <!-- <th>QR</th> -->
                        <th>Action</th>
                       
                    </tr>
                </tfoot>
                <tbody id="bookdata">                   
                    
               
                </tbody>
            </table>
        </div>
    </div>
  </div>

</div>

     <!-- Add Modal -->
     <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div id="alertContainer" class="col-12" style="display: none;">
                  <div class="alert alert-danger" role="alert" id="errorMessages"></div>

              </div>
              <form action="" id="bookForm"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <!-- <input type="text" class="form-control" id="category" name="category" aria-describedby="emailHelp" required> -->
                    <select class="form-control" id="cat_id" name="cat_id" required>

                      <?php foreach($cates as $cat):?>
                        <option value="<?= $cat['cat_id']?>"><?= $cat['cat_name']?></option>
                      <?php endforeach?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" aria-describedby="emailHelp" required>
                </div>

                <div class="form-group">
                    <label for="publish">Publish-date</label>
                    <input type="date" class="form-control" id="publish" name="publish" aria-describedby="emailHelp" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" aria-describedby="emailHelp" value="1">
                </div>

                <div class="form-group mt-5">
                <label for="bookcover" class="d-block">Book Cover</label>
                <input type="file" class="bookcover" id="bookcover" name="bookcover">
                <img id="bookcoverPreview" src="#" alt="Book Cover" style="display:none; width:100px; height:100px;"/>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn theme text-white" id="book-save">Add Book</button>
              </div>
        

                
            </form>
              </div>
    
            </div>
          </div>
        </div>


        