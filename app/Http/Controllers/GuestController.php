<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['title'] = 'Login';

        return view('guest.login', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            // Custom error messages
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        // Step 2: Attempt to find the admin in the database
        $user = User::where('email', $request->email)->first();
        if ($user != NULL) {
            if (Hash::check($request->password, $user->password)) {
                $remember = $request->rememberMe ? true : false;
                Auth::login($user, $remember);

                return redirect('/dashboard')->with(["msg" => "<div class='alert alert-success'><strong>Success </strong>  Login Successfully !!! </div>"]);
            } else {
                return redirect()->back()->with(["msg" => "<div class='alert alert-danger'><strong>Wrong </strong>  password does not matched !!! </div>"]);
            }
        } else {
            // Admin not found or password incorrect, redirect back with error message
            return redirect('guest/')->with(["msg" => "<div class='alert alert-danger'><strong>Wrong </strong>  User does not exists!!! </div>"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
