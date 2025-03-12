document.addEventListener('DOMContentLoaded', function () {




  function fetchAllNames() {
      $.ajax({
          url: "borrowing/fetch-all-names", 
          dataType: 'json',
      }).done(function (result) {
          if (result.names) {
              const allNames = [];
              result.names.forEach(name => {
              allNames.push(name);
                 })
  
              updateDatalistWithNames(allNames); 
          } else {
              console.error('Failed to fetch names from the database.');
          }
      }).fail(function (jqXHR, textStatus, errorThrown) {
          console.error('Request failed: ' + textStatus);
          console.error('Error: ' + errorThrown);
      });
  }
  
  function updateDatalistWithNames(names) {
      const dataList = document.getElementById('names');
      if (dataList) {
      // Clear existing options by removing all child nodes
      while (dataList.firstChild) {
          dataList.removeChild(dataList.firstChild);
      }
  
      // Add new options
      names.forEach(name => {
          const option = document.createElement('option');
          option.value = name;
          dataList.appendChild(option);
      });
  }
  }
  
  fetchAllNames();
  
  
  
  
      const alertContainer = document.getElementById('alertContainer');
      const errorMessages = document.getElementById('errorMessages');
      const addBorrowerBtn = document.getElementById('addBorrowerBtn');
  
  
      if (addBorrowerBtn!=null){
          addBorrowerBtn.addEventListener('click', function (event) {
              event.preventDefault();
              if (addBorrowerBtn.textContent === 'Add Borrower') {
                  addBorrower();
              } else if (addBorrowerBtn.textContent === 'Update Borrower') {
                  const borrowerId = addBorrowerBtn.getAttribute('data-borrower-id');
                  updateBorrower(borrowerId);
              }
          });
      }
  
      
      
      
  
      
  
      function addBorrower() {
          var data = {
              'name': $('#name').val(),
              'email': $('#email').val(),
              'phone': $('#phone').val(),
              'book-id': $('#book-id').val(),
              // 'Date_Of_Borrowing': $('#Date_Of_Borrowing').val(),
              // 'Actual_Return_Date': $('#Actual_Return_Date').val(),
              'Expected_Return_Date': $('#Expected_Return_Date').val(),
          };
  
          $.ajax({
              url: "borrower/add-borrower",
              method: 'POST',
              dataType: 'json',
              data: data,
          }).done(function (result) {
              alertContainer.style.display = 'none';
              errorMessages.innerHTML = '';
  
              if (result.status === 'error') {
                  if (result.message === 'This borrower is blacklisted') {
                      // alert('This borrower is blacklisted.');
                      $('#alertContainer_black').removeClass('d-none');
                      $('#errorMessages_black').text('This borrower is blacklisted.');
  
                      // $('#exampleModal').modal('hide');
  
  
                  } else {
                      var messages = '';
                      for (var key in result.errors) {
                          if (result.errors.hasOwnProperty(key)) {
                              messages += '<p>' + result.errors[key] + '</p>';
                          }
                      }
                      errorMessages.innerHTML = messages;
                      alertContainer.style.display = 'block';
                  }
              } else {
                  // alert('Borrower added successfully');
                  $('#addAlert').removeClass('d-none');
                  $('#addMsg').text('Borrower added successfully');
                  $('#exampleModal').modal('hide');
                  fetchBorrowers();
                  fetchAllNames(); 
  
                  // updateDatalistWithNames(data.name);
                  
  
               
              }
          }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('Request failed: ' + textStatus);
              console.log('Error: ' + errorThrown);
          });
      }
  
      function updateBorrower(borrowerId) {
          const data = {
              'name': $('#name').val(),
              'email': $('#email').val(),
              'phone': $('#phone').val(),
              'book-id': $('#book-id').val(),
              'Date_Of_Borrowing': $('#Date_Of_Borrowing').val(),
              'Actual_Return_Date': $('#Actual_Return_Date').val(),
              'Expected_Return_Date': $('#Expected_Return_Date').val(),
          };
  
          $.ajax({
              url: `borrower/update-borrower/${borrowerId}`,
              method: 'POST',
              dataType: 'json',
              data: data,
          }).done(function(result) {
              alertContainer.style.display = 'none';
              errorMessages.innerHTML = '';
              if (result.status === 'success') {
                  // alert('Borrower updated successfully');
                  $('#exampleModal').modal('hide');
                  $('#updateAlert').removeClass('d-none');
                  $('#updateMsg').text('Borrower updated successfully');
                  fetchBorrowers();
                  fetchAllNames();
  
              // updateBlackList(borrowerId);
  
              } else {
                  // alert('Failed to update borrower');
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
  
      function fetchBorrowers() {
          $.ajax({
              url: "borrower/add-borrower",
              method: 'GET',
              dataType: 'json',
          }).done(function (result) {
              displayBorrowers(result.borrowers);
          }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('Request failed: ' + textStatus);
              console.log('Error: ' + errorThrown);
          });
      }
  
  
      function displayBorrowers(borrowers) {
          $('#dataTable tbody').empty();
          borrowers.forEach(function (borrower) {
              const isReturnDateSet = borrower.actual_return_date !== null;
              const checkBtnDisabled = isReturnDateSet ? 'disabled' : '';
              const checkIconColor = isReturnDateSet ? 'green' : '';
      
              var newRow = `
                  <tr data-borrower-id="${borrower.borrow_id}">
                      <td >${borrower.borrow_id}</td>
                      <td >${borrower.fullname}</td>
                      <td >${borrower.email}</td>
                      <td >${borrower.phone}</td>
                      <td >${borrower.title}</td>
                      <td >${borrower.date_of_borrowing}</td>
                      <td >${borrower.expected_return_date}</td>
                      <td  >${borrower.actual_return_date || ''}</td>
                      <td class="text-center" style="display: flex; justify-content: space-around;">
                      <button type="button" class="checkBtn btn" ${checkBtnDisabled}>
                          <i class="fa-solid fa-check" style="color: ${checkIconColor};"></i>
                      </button>
                      <button type="button" class="editBtn btn">
                          <i class="fa-solid fa-pen-to-square fs-4" style="color: #7b3a16;"></i>
                      </button>
                      <button type="button" class="deleteBtn btn">
                          <i class="fa-solid fa-trash fs-4 text-danger"></i>
                      </button>
                  </td>
                  
                  </tr>`;
              $('#dataTable tbody').append(newRow);
          });
      }
   
      
  
      function deleteBorrower(borrowerId) {
          $.ajax({
              url: "borrower/delete-borrower",
              method: 'POST',
              dataType: 'json',
              data: { id: borrowerId },
          }).done(function (result) {
              if (result.status === 'success') {
                  $('#deleteAlert').removeClass('d-none');
                  $('#deleteMsg').text(result.message);
                  // alert('Borrower deleted successfully');
                  fetchBorrowers();
                  fetchAllNames();
              } else {
                  alert('Failed to delete borrower');
              }
          }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('Request failed: ' + textStatus);
              console.log('Error: ' + errorThrown);
          });
      }
  
  
  
      document.addEventListener('click', function (event) {
          if (event.target.closest('.editBtn')) {
              const borrowerId = event.target.closest('tr').getAttribute('data-borrower-id');
              editBorrower(borrowerId);
          } else if (event.target.closest('.deleteBtn')) {
              const borrowerId = event.target.closest('tr').getAttribute('data-borrower-id');
              deleteBorrower(borrowerId);
          }
      });
      
  
      function editBorrower(borrowerId) {
          $.ajax({
              url: `borrower/get-borrower/${borrowerId}`,
              method: 'GET',
              dataType: 'json',
          }).done(function(result) {
              if (result.status === 'success') {
                  const borrower = result.borrower;
                  $('#name').val(borrower.fullname);
                  $('#email').val(borrower.email);
                  $('#phone').val(borrower.phone);
                  $('#book-id').val(borrower.book_id);
                  $('#Date_Of_Borrowing').val(borrower.date_of_borrowing);
                  $('#Expected_Return_Date').val(borrower.expected_return_date);
                  $('#Actual_Return_Date').val(borrower.actual_return_date);
  
                  $('#exampleModal').modal('show'); 
  
                  
                  addBorrowerBtn.textContent = 'Update Borrower';
                  addBorrowerBtn.setAttribute('data-borrower-id', borrowerId);
              } else {
                  alert('Failed to fetch borrower data');
              }
          }).fail(function(jqXHR, textStatus, errorThrown) {
              alert(`Request failed: ${textStatus}`);
              console.log(`Error: ${errorThrown}`);
          });
      }
  
      $('#exampleModal').on('hidden.bs.modal', function () {
          $('#borrowerForm')[0].reset();
          addBorrowerBtn.textContent = 'Add Borrower';
          addBorrowerBtn.removeAttribute('data-borrower-id');
      });
  
      fetchBorrowers();
  
  
  
      document.addEventListener('click', function (event) {
          if (event.target.closest('.checkBtn')) {
              const borrowerId = event.target.closest('tr').getAttribute('data-borrower-id');
              const actualReturnDate = new Date().toISOString().slice(0, 10); // Get today's date in YYYY-MM-DD format
      
              updateActualReturnDate(borrowerId, actualReturnDate, event.target);
          } else if (event.target.closest('.editBtn')) {
              const borrowerId = event.target.closest('tr').getAttribute('data-borrower-id');
              editBorrower(borrowerId);
          } else if (event.target.closest('.deleteBtn')) {
              const borrowerId = event.target.closest('tr').getAttribute('data-borrower-id');
           
          }
      });
      
     
  
  
  
      function getLocalDateTime(callback) {
          $.ajax({
              url: "/getLocalDateTime",  
              method: 'GET',
              dataType: 'json',
          }).done(function (result) {
              callback(result.localDateTime);
          }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('Failed to get local date and time: ' + textStatus);
          });
      }
      
      function updateActualReturnDate(borrowerId, button) {
          getLocalDateTime(function (localDateTime) {
              $.ajax({
                  url: `/borrower/update-actual-return-date/${borrowerId}`,
                  method: 'POST',
                  dataType: 'json',
                  data: { actual_return_date: localDateTime },
              }).done(function (result) {
                  if (result.status === 'success') {
                      alert('Actual return date updated successfully');
              
                      $(button).prop('disabled', true);
                      $(button).find('i').css('color', 'green');
                      location.reload();
                  } else {
                      alert('Failed to update actual return date');
                  }
              }).fail(function (jqXHR, textStatus, errorThrown) {
                  alert(`Request failed: ${textStatus}`);
              });
          });
      }
      
  
  
  
   function fetchOverdueBorrowers() {
          $.ajax({
              url: "borrowing/check-overdue-borrowers",
              method: 'GET',
              dataType: 'json',
          }).done(function (result) {
              if (result.status === 'success') {
                  $('#overdueTable tbody').empty();
                 
  
                  result.data.forEach(borrower => {
                      const row = `<tr>
                          <td>${borrower.borrow_id}</td>
                          <td>${borrower.fullname}</td>
                          <td>${borrower.email}</td>
                          <td>${borrower.phone}</td>
                          <td>${borrower.book_id}</td>
                          <td>${borrower.date_of_borrowing}</td>
                          <td>${borrower.expected_return_date}</td>
                      </tr>`;
                      $(' #overdueTable tbody').append(row);
                  });
  
                  
              }
  
          }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('Request failed: ' + textStatus);
              console.log('Error: ' + errorThrown);
          });
  
      }
  
  
  
      
      fetchOverdueBorrowers();
  
  //     let allEntries = [];
  
  // function updateDatalist() {
  //     const dataList = document.getElementById('names');
  //     dataList.innerHTML = '';
  
  //     allEntries.forEach(entry => {
  //         const option = document.createElement('option');
  //         option.value = entry;
  //         dataList.appendChild(option);
  //     });
  // }
  
  // function filterNames() {
  //     const inputElement = document.getElementById('name');
  //     const input = inputElement.value.toLowerCase();
  
  //     const filteredNames = allEntries.filter(entry => entry.toLowerCase().includes(input));
  
  //     const dataList = document.getElementById('names');
  //     dataList.innerHTML = '';
  
  //     filteredNames.forEach(entry => {
  //         const option = document.createElement('option');
  //         option.value = entry;
  //         dataList.appendChild(option);
  //     });
  
  // }
  
  
  //     const dataList = document.getElementById('names');
  //     const initialEntries = [];
  //     initialEntries.forEach(entry => {
  //         if (!allEntries.includes(entry)) {
  //             allEntries.push(entry);
  //         }
  //         const option = document.createElement('option');
  //         option.value = entry;
  //         dataList.appendChild(option);
  //     });
  
  
  
      
  });
  
  
  