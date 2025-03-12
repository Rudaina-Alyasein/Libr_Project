$(document).ready(function () {
   
    $('#changeProfilePicBtn').click(function () {
      
        $('#profilePicInput').click(); 
    });

    $('#profilePicInput').change(function () {
        var formData = new FormData();
        formData.append('image', this.files[0]); 

        $.ajax({
            url: `/user/uploadProfilePicture`, 
            method: 'POST',
            data: formData, 
            processData: false, 
            contentType: false, 
            dataType: 'json', 
        }).done(function (result) { 
            if (result.status == 'success') {
                $('#profileImage').attr('src', result.image_url); 
                alert('Profile picture updated successfully'); 
            } else {
                console.log(result.errors);
                alert('Failed to update profile picture'); 
            }
        }).fail(function (jqXHR, textStatus, errorThrown) { 
            alert(`Request failed: ${textStatus}`); 
            console.log(`Error: ${errorThrown}`); 
            console.log(jqXHR.responseText); 
        });
    });

   
    $('#profileForm').submit(function (event) {
        event.preventDefault(); 
        var userId = $('#profileForm').data('user-id'); 

       
        updateUser(userId);
    });

  
    $('#editProfileBtn').click(function () {
        var userId = $('#profileForm').data('user-id');

        updateUser(userId);
    });
});


function updateUser(userId) {
    var data = {
        'firstname': $('#firstname').val(), 
        'lastname': $('#lastname').val(), 
        'email': $('#email').val(), 
    };


    $.ajax({
        url: `/user/updateProfile`, 
        method: 'POST', 
        dataType: 'json', 
        data: data, 
    }).done(function (result) { 
        if (result.status === 'success') {
            alert('User information updated successfully'); 
        } else {
            console.log(result.errors); 
            alert('Failed to update user information'); 
        }
    }).fail(function (jqXHR, textStatus, errorThrown) { 
        alert(`Request failed: ${textStatus}`); 
        console.log(`Error: ${errorThrown}`); 
        console.log(jqXHR.responseText); 
    });
}

function getUserId() {
    return $('#profileForm').data('user-id');
}
