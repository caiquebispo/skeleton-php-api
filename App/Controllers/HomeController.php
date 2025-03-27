<?php

namespace Skeleton\SkeletonPhpApplication\Controllers;

use Illuminate\Routing\Controller;
use Skeleton\SkeletonPhpApplication\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return User::all();
    }
}