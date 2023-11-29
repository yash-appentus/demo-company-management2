<?php

namespace App\Services;

use App\Models\Company;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CompanyService extends Service
{
    public function CreateUsers($request)
    {
        try {
            $company_id = Session::get('ADMIN_ID');
            $checkEmail = Company::where('email', $request['email'])->first();
            if (!isset($checkEmail)) {
                $Save = [
                    "name" => $request['name'],
                    "email" => $request['email'],
                    "phone" => $request['phone'],
                    "parent_id" => $company_id,
                    "role_id" => $request['role_id'],
                    "password" => $request['password'],
                ];
                Company::create($Save);
                return ['status' => true, 'message' => 'New user has been created successfully.'];
            } else {
                return ['status' => false, 'message' => 'Email Already Exists.'];
            }
        } catch (\Throwable $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
            return ['status' => false, 'message' => 'Oops something went wrong!'];
        }
    }
}
