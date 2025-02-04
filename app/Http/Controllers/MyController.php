<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class MyController extends Controller
{
        public function index()
        {   $userId = Auth::id();  
        //     $user = [
        //     ['name' => 'John Doe', 'age' => 30],
        //     ['name' => 'Jane Smith', 'age' => 25],
        //     ['name' => 'Alice Johnson', 'age' => 28],
        // ];
            $user = User::find($userId);
            // $user=User::where('id',$userId);
            //$users = User::all();
            return view('users.index', compact('user'));
        }

        public function create()
        {
            return view('users.create');
        }

        public function store(Request $request)
        {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|min:8|max:255|unique:users',
                'mob_no' => 'required|string|size:10',
                'password' => 'required|string|min:8', // Ensure password confirmation

            ]);
    
            $request->validate([
                'profile_pic' => 'required|file|mimes:jpg,png,|max:2048', // Adjust the validation rules as needed
            ]);
            $uuid=(string) Str::uuid();
            // Store the file
            $destinationPath='uploads/profile_pic/';
            $fileNameWithoutExtension = File::name($request->profile_pic->getClientOriginalName());
            $fileName = $fileNameWithoutExtension.$uuid.time().'.'.$request->profile_pic->extension();  
            $request->profile_pic->move(public_path('uploads/profile_pic'), $fileName);
            $path=$destinationPath.$fileName;
            // Create a new user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mob_no' => $request->mob_no,
                'profile_pic' => $path, 
                'password' => Hash::make($request->password), // Hash the password

            ]);
           
            // Redirect to a specific route with a success message
            return redirect()->route('login')->with('success', 'User created successfully, Now  user can login.');
        }
        public function edit()
        {   $userId = Auth::id();
            $user = User::find($userId); 
            return view('users.update', compact('user'));

        }
        public function update(Request $request)
        {
         $userId = Auth::id();
         $user = User::find($userId); 
 
         $request->validate([
            'name' => 'string|min:2|max:255',
            'email' => 'required|string|email|min:8|max:255|unique:users,email,' . $user->id,
            'mob_no' => 'string|size:10',

        ]);

       $all=$request->all();
       if(!empty($all['password']))
       {     
            $request->validate([
                'password' => 'string|min:8', // Ensure password confirmation

            ]);
            
            if (!Hash::check($request->input('password'), $user->password)) {
                $user->password = Hash::make($request->password);
                $user->remember_token = null;
            }
        }
        if(!empty($request->profile_pic))
        {
            $request->validate([
                'profile_pic' => 'required|file|mimes:jpg,png,|max:2048', // Adjust the validation rules as needed
            ]);
            $uuid=(string) Str::uuid();
            // Store the file
            $destinationPath='uploads/profile_pic/';
            $fileNameWithoutExtension = File::name($request->profile_pic->getClientOriginalName());
            $fileName = $fileNameWithoutExtension.$uuid.time().'.'.$request->profile_pic->extension();  
            $request->profile_pic->move(public_path('uploads/profile_pic'), $fileName);
            $path=$destinationPath.$fileName;
            $user->profile_pic = $path;
        }

        $user->name = $request->name;
        $user->mob_no = $request->mob_no;
        $user->email = $request->email;
        
        
        $user->save();

        return redirect()->route('updated.user', compact('user'))->with('success', 'Your detail updated successfully.');

        }
        public function login(Request $request)
        {
            // Validate the request
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // Attempt to log the user in
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Authentication passed
               /// $users = User::all();
            return redirect()->route('dashboard.index');
                //return response()->json(['message' => 'Login successful!'], 200);
            }
            return redirect()->route('login')->with('success', 'User credenatials mismatch, Now try login again.');

            //return response()->json(['message' => 'Invalid credentials.'], 401);
        }


        public function logout(Request $request)
        {
            Auth::logout(); // Log the user out
    
            // Invalidate the session
            $request->session()->invalidate();
    
            // Regenerate the session token
            $request->session()->regenerateToken();
    
            // Redirect to the login page or home page
            return redirect('/login')->with('status', 'You have been logged out successfully.');
        }

        
}
