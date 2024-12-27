<?php

namespace GlobalStudio\Common\Controllers;
use App\Http\Controllers\Controller;
use GlobalStudio\Login\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('common::dashboard');
    }
 
}
