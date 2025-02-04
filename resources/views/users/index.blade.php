<!DOCTYPE html>
<html>
<head>
    <title>My Details</title>
    <style> 
    .profile_pic
    {
        width:150px;
    }
    .logout
    {
            color:white;
            background:red;
            border-radius:20px;
            border:red;
    }
    .profile_name
    {
        padding-bottom:30%;
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
<div class="userdetail">
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

 <p>  Click <a class="edit" href="edit" type="submit">Edit</a> to edit detail</p>
<table><tr>
    <td><p><strong>Name:</strong></p></td><td><p> {{ $user->name }}</p></td></tr>
    <tr><td><p><strong>Age:</strong></p></td><td><p> {{ $user->mob_no }}</p></td></tr>
    <tr><td><p><strong>Email:</strong></p></td><td><p> {{ $user->email }}</p></td></tr>
    <tr><td><p class="profile_name"><span ><strong>Profile pic:</strong></span></p></td><td> <img  class="profile_pic" src="{{ $user->profile_pic }}"> </p></td></tr>
</table>
    
</div>

</body>
</html>
