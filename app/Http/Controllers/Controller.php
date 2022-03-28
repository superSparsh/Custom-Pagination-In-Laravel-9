<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getController(Request $request)
    {
        $page = $request->get('page');
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        $total_records = \App\Models\Post::count();
        $total_pages = ceil($total_records / $per_page);
        $post = DB::table('posts')->select('*')->offset($offset)->take($per_page)->get();
        return view('welcome', compact('post','total_pages','page'));
    }
}
