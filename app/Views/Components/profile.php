<h1 class="h3 mb-2 text-gray-800 text-left py-3">My Profile</h1>
<div class="container container-pro">
    <div class="row">
        <div class="col personal col-lg-3">
            <div class="profile_pic">
                <img id="profileImage" class="pro-img" src="<?= session()->get('image') ? session()->get('image') : '/assets/img/profile-icon-design-free-vector.jpg' ?>" alt="Profile Picture" style="width: 115px;">
            </div>
            <input type="file" id="profilePicInput" style="display: none;">
            <button id="changeProfilePicBtn" class="btn-pro btn btn-primary btn-user btn-block">Change</button>
        </div>
        <div class="col pro_form col-lg-9">
          
            <form id="profileForm" class="user" method="POST" action="" data-user-id="<?= session()->get('id') ?>">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class=" form-control form-control-user" name="firstname" id="firstname" placeholder="First Name" value="<?= session()->get('firstname') ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control form-control-user" name="lastname" id="lastname" placeholder="Last Name" value="<?= session()->get('lastname') ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control form-control-user" readonly
                     name="email" id="email" placeholder="Email Address" value="<?= session()->get('email') ?? '' ?>">
                </div>

                <button type="button" id="editProfileBtn" class="btn btn-primary btn-user btn-block">
                    Edit Profile
                </button>
            </form>
        </div>
    </div>
</div>

<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/assets/js/sb-admin-2.min.js"></script>
<script>
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
                if (result.status === 'success') {
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
            url: `/user/update/${userId}`,
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
</script>
