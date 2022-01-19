<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', '=', $request->email)->firstorfail();
        $status = 'Error';
        $message = '';
        $data = null;
        $code = 401;

        if ($user) {

            //jika hasil hash dari password yang di input user sama dengan password di database user maka

            if (Hash::check($request->password, $user->password)) {
                //generate token

                $user->generateToken();
                $status = 'success';
                $message = 'Login Sukses';

                // Tampilkan data user menggunakan method array

                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'login Gagal! Password salah';
            }
        } else {
            $message = 'login gagal! username salah';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function register(Request $request)
    {
    }

    public function logout(Request $request)
    {
    }
}
