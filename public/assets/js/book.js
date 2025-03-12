document.addEventListener('DOMContentLoaded', function (event) {

    const alertContainer = document.getElementById('alertContainer');
    const errorMessages = document.getElementById('errorMessages');
    const bookSave = document.getElementById('book-save');

if (bookSave!=null){
    bookSave.addEventListener('click', function (event) {
        event.preventDefault();
        if (bookSave.textContent === 'Add Book') {
            addBook();
        } else if (bookSave.textContent === 'Update Book') {
            const bookId = bookSave.getAttribute('data-book-id');
            updateBook(bookId);
        }
    });
}
    




    function addBook() {
        var formData = new FormData();
        formData.append('book_cover', $('#bookcover')[0].files[0]);
        formData.append('title', $('#title').val());
        formData.append('cat_id', $('#cat_id').val());
        formData.append('author', $('#author').val());
        formData.append('publish', $('#publish').val());
        formData.append('quantity', $('#quantity').val());
    
        $.ajax({
            url: "book/add-book",
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false, 
            contentType: false
        }).done(function (result) {
            var alertContainer = document.getElementById('alertContainer');
            var errorMessages = document.getElementById('errorMessages');
            alertContainer.style.display = 'none';
            errorMessages.innerHTML = '';
    
            if (result.status === 'error') {
                var messages = '';
                for (var key in result.errors) {
                    if (result.errors.hasOwnProperty(key)) {
                        messages += '<p>' + result.errors[key] + '</p>';
                    }
                }
                errorMessages.innerHTML = messages;
                alertContainer.style.display = 'block';
            } else {
                $('#addAlert').removeClass('d-none');
                $('#addMsg').text('Book added successfully');
                $('.modal').modal('hide');
                // Fetch books based on the selected category
                // fetchBooksByCategory($('#cat_id').val());
                fetchBooks();

            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Request failed: ' + textStatus);
            console.log('Error: ' + errorThrown);
        });
    }




    function CompareCategory(books) { 
        $('.nav-pills .nav-item a').click(function() {
           
            var categoryId = $(this).attr('href').replace('#', '');
            displayBooksByCategory(books, categoryId);
        });
    }
    
    function displayBooksByCategory(books, categoryId) {
      
        

        let categoryDiv = $(`#${categoryId} .row`);
        categoryDiv.empty();
              books.forEach(function (book) {


            if (book.cat_name.toLowerCase() == categoryId.replace(/_/g, ' ')) {
                // alert(book['book_cover'])
                let newBook = `<div class="col-md-6 col-lg-3 catagory py-3">
                <div class="catagory-item">
                <div class="catagory-img">
                <div class="catagory-img-efects">
                <img src="/assets/uploads/${book['book_cover']}" class="img-fluid w-100 rounded-top" alt="Image" style="height: 280px;">
                </div>
                </div>
                <div class="catagory-title text-center rounded-bottom p-4">
                <div class="catagory-title-inner">
                <h4 class="mt-3">${book['title']}</h4>
                <p class="mb-0">${book['author']}</p>
                </div>
                </div>
                </div>
                </div>`;
                categoryDiv.append(newBook);
                
    
            }
        

            //$('#' + categoryId).append(newBook);

        });
    }


    function updateBook(bookId) {
        var formData = new FormData();
        formData.append('book_cover', $('#bookcover')[0].files[0]);
        formData.append('title', $('#title').val());
        formData.append('cat_id', $('#cat_id').val());
        formData.append('author', $('#author').val());
        formData.append('publish', $('#publish').val());
        formData.append('quantity', $('#quantity').val());

        $.ajax({
            url: `book/update-book/${bookId}`,
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false, 
            contentType: false
        }).done(function(result) {
            alertContainer.style.display = 'none';
            errorMessages.innerHTML = '';
            if (result.status === 'success') {
                // alert('Book updated successfully');
                $('#addBookModal').modal('hide');
                $('#addAlert').removeClass('d-none');
                $('#addMsg').text('Book updated successfully');
                fetchBooks();
            } else {
                // alert('Failed to update book');
                console.log(result.errors);
                var messages = '';
                for (var key in result.errors) {
                    if (result.errors.hasOwnProperty(key)) {
                        messages += '<p>' + result.errors[key] + '</p>';
                    }
                }
                errorMessages.innerHTML = messages;
                alertContainer.style.display = 'block';
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert(`Request failed: ${textStatus}`);
            console.log(`Error: ${errorThrown}`);
        });
    }

    
    function fetchBooks() {
        $.ajax({
            url: "book/fetch-book",
            method: 'GET',
            dataType: 'json',
        }).done(function (result) {
            CompareCategory(result.books);
            displayBooksByCategory(result.books, 'history');

            displayBooks(result.books);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Request failed: ' + textStatus);
            console.log('Error: ' + errorThrown);
        });
    }

    fetchBooks();





    function displayBooks(books) {
        $('#dataTable tbody').empty();

        books.forEach(function (book) {
            // const coverImg = book.book_cover ? `<img src="/uploads/${book.book_cover}" alt="Book Cover" width="50" height="50">` : '';
            const newRow = `<tr data-book-id="${book.book_id}">
                <td>${book.book_id}</td>
                <td><img src="/assets/uploads/${book.book_cover}" alt="Book Cover" width="85" height="100"></td>
                <td>${book.title}</td>
                <td>${book.cat_name}</td>
                <td>${book.author}</td>
                <td>${book.publish_date}</td>
                <td class="text-center">
                <i class="fa-solid fa-minus btn px-2"></i>
                <span class="quantity">${book.quantity}</span>
                <i class="fa-solid fa-plus btn px-2"></i>
                </td>
                <td class="text-center">
                    <button type="button" class="editBtn btn"><i class="fa-solid fa-pen-to-square fs-4" style="color: #7b3a16"></i></button>
                    <button type="button" class="deleteBtn btn"><i class="fa-solid fa-trash fs-4 text-danger"></i></button>
                </td>
            </tr>`;
            $('#dataTable tbody').append(newRow);
        });
    }


    $('#dataTable').off('click', '.fa-plus');
    $('#dataTable').off('click', '.fa-minus');
    
    $('#dataTable').on('click', '.fa-plus', function() {
        const quantityElement = $(this).siblings('.quantity');
        let quantity = parseInt(quantityElement.text());
        const bookId = $(this).closest('tr').data('book-id');
    
        quantityElement.text(++quantity);
        updateBookQuantity(bookId, quantity);
    });
    
    $('#dataTable').on('click', '.fa-minus', function() {
        const quantityElement = $(this).siblings('.quantity');
        let quantity = parseInt(quantityElement.text());
        const bookId = $(this).closest('tr').data('book-id');
    
        if (quantity > 0) {
            quantityElement.text(--quantity);
            updateBookQuantity(bookId, quantity);
        }
    });


    
    function updateBookQuantity(bookId, quantity) {
        $.ajax({
            url: `book/update-quantity/${bookId}`,
            method: 'POST',
            dataType: 'json',
            data: { quantity: quantity },
        }).done(function(result) {
            if (result.status === 'success') {
                console.log('Quantity updated successfully');
            } else {
                console.log('Failed to update quantity');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('Request failed: ' + textStatus);
            console.log('Error: ' + errorThrown);
        });
    }





    // $(document).on('click', '.deleteBtn', function () {
    //     var bookId = $(this).closest('tr').attr('data-book-id');
    //     console.log(bookId);
    //     deleteBook(bookId);
    // });

    function deleteBook(bookId) {
        $.ajax({
            url: "book/delete-book",
            method: 'POST',
            dataType: 'json',
            data: { id: bookId },
        }).done(function (result) {
            if (result.status === 'success') {
                // alert('Book deleted successfully');
                $('#addAlert').removeClass('d-none');
                $('#addMsg').text(result.message);
                fetchBooks();
            } else {
                alert('Failed to delete book');
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Request failed: ' + textStatus);
            console.log('Error: ' + errorThrown);
        });
    }

    

    document.addEventListener('click', function (event) {
        if (event.target.closest('.editBtn')) {
            const bookId = event.target.closest('tr').getAttribute('data-book-id');
            editBook(bookId);
        } else if (event.target.closest('.deleteBtn')) {
            const bookId = event.target.closest('tr').getAttribute('data-book-id');
            deleteBook(bookId);
        }
    });


    function editBook(bookId) {
        $.ajax({
            url: `book/get-book/${bookId}`,
            method: 'GET',
            dataType: 'json',
        }).done(function(result) {
            if (result.status === 'success') {
                const book = result.book;
                $('#title').val(book.title);
                $('#cat_id').val(book.category_id);
                $('#author').val(book.author);
                $('#publish').val(book.publish_date);
                $('#quantity').val(book.quantity);
                if (book.book_cover) {
                    $('#bookcoverPreview').attr('src', `/assets/uploads/${book.book_cover}`).show();
                } else {
                    $('#bookcoverPreview').hide();
                }
                $('#addBookModal').modal('show'); 

                bookSave.textContent = 'Update Book';
                bookSave.setAttribute('data-book-id', bookId);
            } else {
                alert('Failed to fetch book data');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert(`Request failed: ${textStatus}`);
            console.log(`Error: ${errorThrown}`);
        });
    }

    $('#addBookModal').on('hidden.bs.modal', function () {
        $('#bookForm')[0].reset();
        bookSave.textContent = 'Add Book';
        bookSave.removeAttribute('data-book-id');
    });

    fetchBooks();
 
    });

  
    


// });