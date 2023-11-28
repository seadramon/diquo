<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\SptbListResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\Pelanggan\PelangganResource;
use App\Models\Pelanggan;
use App\Models\PelangganUser;
use App\Models\SptbD2;
use App\Models\SptbH;
use App\Models\User;
use App\Services\KalenderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $code    = 200;
        $message = "Success";
        $data    = null;

        try {
            Validator::make($request->all(), [
                'username'    => 'required',
                'password' => 'required'
            ])->validate();
            $user = User::where('username', $request->username)->first();
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'username' => ['The provided credentials are incorrect.'],
                ]);
            }
            $data['token'] = $user->createToken('mobile')->plainTextToken;
            $data['user'] = $user;
            return new LoginResource($data);
        } catch (Exception $e) {
            $code = 400;
            $message = $e->getMessage();
            return response()->json([
                'success' => $code == 200 ? true : false,
                'message' => $message,
                'data' => $data
            ], $code);
        }

    }

    public function login1(Request $request)
    {
        return response()->json($request->user());
    }
}

