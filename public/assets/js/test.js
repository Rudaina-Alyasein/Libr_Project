document.addEventListener("DOMContentLoaded", function (event) {
  document
    .getElementById("comment_form")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission behavior

      // Collect form data
      var name = document.getElementById("username").value;
      var comment = document.getElementById("comment").value;
      var rating = getSelectedRating(); // Retrieve the selected rating

      // Create a JavaScript object with the form data
      var formData = {
        name: name,
        comment: comment,
        rating: rating,
      };

      console.log(formData);

      $.ajax({
        url: "test",
        method: "POST",
        dataType: "json",
        data: formData,
      })
        .done(function (data) {
          if (data.status == "success") {
            alert("Review submitted successfully!");
            loadReviews();
            // Clear the form fields after successful submission
            document.getElementById("username").value = "";
            document.getElementById("comment").value = "";
            clearRating();
          } else {
            alert("An error occurred while submitting the review.");
          }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
          alert("Request failed: " + textStatus);
          console.log("Error: " + errorThrown);
        });
    });

  // Function to retrieve the selected rating from the form
  function getSelectedRating() {
    var checkedStars = document.querySelectorAll(
      '.rate_sec input[type="checkbox"]:checked'
    );
    return checkedStars.length; // Return the number of selected stars
  }

  // Function to clear the rating checkboxes
  function clearRating() {
    var stars = document.querySelectorAll('.rate_sec input[type="checkbox"]');
    stars.forEach(function (star) {
      star.checked = false;
    });

    handleStarClick(0); // Reset the visual representation of stars
  }

  function loadReviews() {
    $.ajax({
      url: "getReview",
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          renderReviews(response.reviews);
        } else {
          console.log("Failed to load reviews");
        }
      },
      error: function (xhr, status, error) {
        console.error("Request failed: " + status + ", " + error);
      },
    });
  }

  loadReviews();

  function getRandomColor() {
    // Generate a random color in hexadecimal format
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  function renderReviews(reviews) {
    var reviewsHtml = "";
    $("#comment_count").text(reviews.length);

    $.each(reviews, function (index, review) {
      var randomColor = getRandomColor();
      reviewsHtml += '<div class="comment">';
      reviewsHtml += '<div class="cmnt">';
      reviewsHtml +=
        '<div class="user_latter" style="background-color:' +
        randomColor +
        ';">' +
        review.name.charAt(0).toUpperCase() +
        "</div>";
      reviewsHtml += '<div class="comment-author">' + review.name + "</div>";
      reviewsHtml += "</div>";
      reviewsHtml += '<div class="comment-text">' + review.comments + "</div>";
      reviewsHtml += '<div class="comment-rating">';
      for (var i = 0; i < review.rating; i++) {
        reviewsHtml += '<i class="fa-solid fa-star"></i>';
      }
      reviewsHtml += "</div>";
      reviewsHtml += "</div>";
    });

    $("#comment_section .comments").html(reviewsHtml);
  }
});

function handleStarClick(starNum) {
  var stars = document.querySelectorAll(".rate_sec label i");
  stars.forEach(function (star, index) {
    if (index < starNum) {
      star.classList.remove("fa-regular");
      star.classList.add("fa-solid");
    } else {
      star.classList.remove("fa-solid");
      star.classList.add("fa-regular");
    }
  });
}
