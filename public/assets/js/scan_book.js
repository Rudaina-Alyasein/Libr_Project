// Function to generate a random color
function getRandomColor() {
  var letters = "0123456789ABCDEF";
  var color = "#";
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

// Function to create a comment element
function createCommentElement(name, comment, color, rating) {
  var commentDiv = document.createElement("div");
  commentDiv.className = "comment";

  var cmntDiv = document.createElement("div");
  cmntDiv.className = "cmnt";

  var userLetterDiv = document.createElement("div");
  userLetterDiv.className = "user_latter";
  userLetterDiv.style.backgroundColor = color;

  var userInitialSpan = document.createElement("span");
  userInitialSpan.textContent = name.charAt(0).toUpperCase();

  userLetterDiv.appendChild(userInitialSpan);
  cmntDiv.appendChild(userLetterDiv);

  var authorDiv = document.createElement("div");
  authorDiv.className = "comment-author";
  authorDiv.textContent = name;
  cmntDiv.appendChild(authorDiv);

  commentDiv.appendChild(cmntDiv);

  var commentTextDiv = document.createElement("div");
  commentTextDiv.className = "comment-text";
  commentTextDiv.textContent = comment;
  commentDiv.appendChild(commentTextDiv);

  var ratingDiv = document.createElement("div");
  ratingDiv.className = "comment-rating";
  for (var i = 0; i < rating; i++) {
    var starIcon = document.createElement("i");
    starIcon.className = "fa-solid fa-star";
    ratingDiv.appendChild(starIcon);
  }
  commentDiv.appendChild(ratingDiv);

  return commentDiv;
}

// Function to load comments from localStorage
function loadComments() {
  var comments = JSON.parse(localStorage.getItem("comments")) || [];
  var commentSection = document
    .getElementById("comment_section")
    .querySelector(".comments");
  comments.forEach(function (comment) {
    var commentElement = createCommentElement(
      comment.name,
      comment.comment,
      comment.color,
      comment.rating
    );
    commentSection.appendChild(commentElement);
  });
  document.getElementById("comment_count").textContent = comments.length;
}

// Function to save a comment to localStorage
function saveComment(name, comment, color, rating) {
  var comments = JSON.parse(localStorage.getItem("comments")) || [];
  comments.push({
    name: name,
    comment: comment,
    color: color,
    rating: rating,
  });
  localStorage.setItem("comments", JSON.stringify(comments));
}

// Load comments when the page is loaded
window.onload = function () {
  loadComments();
};

// Handle comment form submission
document
  .getElementById("comment_form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var name = document.getElementById("username").value;
    var comment = document.getElementById("comment").value;
    var color = getRandomColor();

    // Calculate the rating
    var rating = 0;
    var checkedStars = document.querySelectorAll(
      '.rate_sec input[type="checkbox"]:checked'
    );
    rating = checkedStars.length;

    // Create the comment element and append to the comment section
    var commentSection = document
      .getElementById("comment_section")
      .querySelector(".comments");
    var commentElement = createCommentElement(name, comment, color, rating);
    commentSection.appendChild(commentElement);

    // Update comment count
    var commentCount = document.getElementById("comment_count");
    commentCount.textContent = parseInt(commentCount.textContent) + 1;

    // Save the comment to localStorage
    saveComment(name, comment, color, rating);

    // Clear the form and hide the username field
    document.getElementById("comment_form").reset();
    document.getElementById("username").style.display = "none";
  });

document.getElementById("comment").addEventListener("input", function () {
  var commentInput = document.getElementById("comment").value;
  if (commentInput.trim() !== "") {
    document.getElementById("username").style.display = "block";
  } else {
    document.getElementById("username").style.display = "none";
  }
});

// Function to handle star rating
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
