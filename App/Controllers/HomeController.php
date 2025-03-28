<?php

namespace Skeleton\SkeletonPhpApplication\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Skeleton\SkeletonPhpApplication\Core\Response;

class HomeController extends Controller
{
    public function index()
    {
        return (new Response())->json([
            'message' => 'Welcome to the Skeleton PHP Application!',
            'status' => 'success',
        ])->status(200);
    }
}