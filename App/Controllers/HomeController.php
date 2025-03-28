<?php

namespace Skeleton\SkeletonPhpApplication\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Skeleton\SkeletonPhpApplication\Core\Response;
use Skeleton\SkeletonPhpApplication\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function debug(Request  $request)
    {
        $user = User::find(1);
        if ($user) {
            return (new Response())->json($user)->status(200);
        } else {
            return (new Response())->json(['message' => 'User not found'])->status(404);
        }
    }
}