 <!-- footer section -->
 <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Libra</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="/assets/js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="/assets/js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="/assets/js/custom.js"></script>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

  <script src="/assets/js/book.js"></script>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const categoryFilter = document.getElementById('categoryFilter');
        const tabContent = document.querySelector('.tab-content');
        const tabs = document.querySelectorAll('.tab-pane');

        if(categoryFilter!=null){
          categoryFilter.addEventListener('change', function() {
            const selectedCategory = categoryFilter.value;

            tabs.forEach(tab => {
                if (selectedCategory === 'all') {
                    tab.classList.add('show');
                    tab.classList.add('active');
                } else {
                    if (tab.id === selectedCategory) {
                        tab.classList.add('show');
                        tab.classList.add('active');
                    } else {
                        tab.classList.remove('show');
                        tab.classList.remove('active');
                    }
                }
            });
        });
        }





        // Search
        var searchForm = document.querySelector('.search_form');

        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();  

            var searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filterBooks(searchTerm);
        });


        function filterBooks(searchTerm) {
            tabContent.innerHTML = ''; 
            books.forEach(function(book) {
                if (book.title.toLowerCase().includes(searchTerm)) {
                    var bookHtml = `
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="book-item">
                                <h4>${book.title}</h4>
                                <p>Category: ${book.category}</p>
                            </div>
                        </div>
                    `;
                    tabContent.innerHTML += bookHtml;
                }
            });
        }
        
    });


    
document.getElementById('scrollButton').addEventListener('click', function() {
        window.scrollTo({
            top: 1000,
            behavior: 'smooth'  
        });
    });

</script>





</body>

</html>