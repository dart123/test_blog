<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }
    public function index() {
        $users = $this->userService->getUsers();
        Log::debug("users: ".print_r($users,true));
        return view('user_list')->with(['users' => $users]);
    }
}
