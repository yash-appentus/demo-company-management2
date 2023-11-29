<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $CompanyService;

    public function __construct(CompanyService $CompanyService)
    { 
        $this->CompanyService = $CompanyService;
    }

    public function login(Request $request)
    {
        try {
            $request = $request->all();
            $response = $this->CompanyService->CreateUsers($request);
            if ($response['status'] == true) {
                return redirect()->route('admin.dashboard')->with('success', $response['message']);
            } else {
                return back()->with('error', $response['message']);
            }
        } catch (\Throwable $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/')->with('success', "Admin logged out successfully!");
    }
}
