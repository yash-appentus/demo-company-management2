<?php

namespace App\Services;

use App\Models\Company;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationService extends Service
{
    public function loginCheck($request)
    {
        try {
            $checkEmail = Company::where('email', $request['email'])->first();
            if (isset($checkEmail)) {
                if (Hash::check($request['password'], $checkEmail['password'])) {
                    if ($checkEmail->status == 'blocked') {
                        Session::put('ADMIN_ID', $checkEmail->id);
                        return ['status' => true, 'message' => 'Logged in successfully.'];
                    } else {
                        return ['status' => false, 'message' => 'Your account has been deactivated by the company.'];
                    }
                } else {
                    return ['status' => false, 'message' => 'Incorrect password!'];
                }
            } else {
                return ['status' => false, 'message' => 'Invalid email and password!!'];
            }
        } catch (\Throwable $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
            return ['status' => false, 'message' => 'Oops something went wrong!'];
        }
    }
}
