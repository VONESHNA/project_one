<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>    .login{
            color:white;
            background:green;
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
<body> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
      
    <h1>Login User</h1>
    <form action="{{ route('users.checklogin') }}" method="POST">
        @csrf
        <table><tr><td>
        <label for="email">Email:</label></td><td>
        <input type="email" name="email" id="email" required>
        </td></tr>
        <tr><td>
        <label for="password">Password:</label></td><td>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        </td></tr></table>
        <button  class="login" type="submit">Login</button>
    </form>
    <p> Click <a class="register" href="adduser">Register</a> to register a new user </p>
</body>
</html>
