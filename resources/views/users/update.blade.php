<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit User Detail</title>
        <style>    
              .profile_pic{width:150px;}
            .save{
            color:white;
            background:blue;
            border-radius:20px;
            border:red;
            }
             .logout
             {
            color:white;
            background:red;
            border-radius:20px;
            border:red;
             }
            .update{
            color:white;
            background:orange;
            border-radius:20px;
            border:red;
            }
            body
            {
                padding-left:35%;
                padding-righ:40%;
            }
        </style>
</head>
<body> 
    <h1>My Details <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button class="logout" type="submit">Logout</button>
</form></h1>
    <h2>Edit My  Detail</h2>
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
<table>
<tr>
    <td><label for="name">Name:</label></td>
    <td><input type="text" name="name" id="name"  pattern="[A-Z a-z]{A-Z a-z}" placeholder="Only alphabate" value="{{ $user->name }}"></td>
</tr>
<tr>
    <td><label for="email">Email:</label></td>
    <td><input type="email" name="email" id="email" value="{{ $user->email }}"></td>
</tr>
<tr>
    <td> <label for="mob_no">Mob No:</label></td>
    <td><input type="text"  max="10" name="mob_no" id="mob_no" onchange="checkmobno()" placeholder="only 10 digit number" pattern="[0-9]{10}" value="{{ $user->mob_no }}" ></td>
</tr>
<tr>
    <td><label for="profile_pic">Old Profile Pic:</label></td><td><img  class="profile_pic" src="{{ $user->profile_pic }}"></td>
</tr>
<tr>
    <td>         Upload New Profile pic:</td>
    <td> <input type="file" name="profile_pic" id="profile_pic" accept=".jpeg, .jpg, .png" ></td>
</tr>
<tr>
    <td><label for="password">Password:</label></td>
    <td><input type="password" name="password"  min="8" id="password" placeholder="minimumn length 8" > </td>
</tr>
        </table>

        <button class="update" type="submit" id="submitform">Update</button>
        <p> Already registered, click <a href="login">Login</a> to login to your account </p>
    </form>

     @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
    function checkmobno(){
        const mobno = document.getElementById('mob_no').value;
       if(mobno.length<10 || mobno.length>10){ alert('Please enter 10 digit mobile no only');}
    }

document.getElementById('submitform').onsubmit = function() {
    const fileInput = document.getElementById('profile_pic');
    const filePath = fileInput.value;
    const allowedExtensions = /(\.png|\.jpg|\.jepg)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload a file with .jpg or .jpeg or .png extension.');
        fileInput.value = '';
        return false;
    }
};
</script>


</body>
</html>
