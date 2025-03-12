<!--  -->
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/assets/css/scan.css" rel="stylesheet">
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>



<body>
    <div class="container">
        <div class="body_dis">
            
            <div class="book">
                <img src="/assets/img/cover.webp" alt="Book cover">
            </div>
           
            <div class="info">
                <div class="title_book">
                    <h1>The Invisible Man</h1>
                </div>
                <div class="author">
                    <h4>Herbert Wells</h4>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <i class="fa-regular fa-star"></i>
                </div>
               
                <div class="description_book">
                    <p>When Cecilia's abusive ex takes his own life and leaves her his fortune, she suspects his death was a hoax. As a series of coincidences turn lethal, Cecilia works to prove that she is being hunted by someone nobody can see.</p>
                </div>
            </div>
        </div>

     
        <div class="cmnt_tabarak">
            <p class="cmnt_raghda"> FeedBack</p>
        </div>
        <div class="input">
            <form id="comment_form" action="/librapro/CommentController/submitComment" method="POST">

                <div class="rate_sec">
                    <input type="checkbox" id="s1" hidden>
                    <label for="s1"><i class="fa-regular fa-star"></i></label>
                    <input type="checkbox" id="s2" hidden>
                    <label for="s2"><i class="fa-regular fa-star"></i></label>
                    <input type="checkbox" id="s3" hidden>
                    <label for="s3"><i class="fa-regular fa-star"></i></label>
                    <input type="checkbox" id="s4" hidden>
                    <label for="s4"><i class="fa-regular fa-star"></i></label>
                    <input type="checkbox" id="s5" hidden>
                    <label for="s5"><i class="fa-regular fa-star"></i></label>
                </div>
                <div class="T">
                    <input type="text" class="write_cm" name="comment" id="comment" placeholder="Write a comment" required>
                    <button type="submit" class="submit_class" id="submitBtn">Submit</button>
                </div>
                <div>
                    <input type="text" id="username" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="this.setCustomValidity('')">
                </div>
            </form>
        </div>

        <div class="cooment_label">
            <p class="cmnt_raghda"><span id="comment_count">10</span> comments</p>
            <span class="com_break"></span>
        </div>
        <div class="comment_section" id="comment_section">
            <div class="comments">
               
            </div>
        </div>
    </div>
    


    <script src="/assets/js/main.js"></script>
</body>

</html> -->