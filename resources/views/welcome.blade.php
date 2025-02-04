<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1> <a href="login">Login</a> | <a href="adduser">Register</a></h1>

</body>
</html>
