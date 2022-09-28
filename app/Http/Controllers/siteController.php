<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteController extends Controller
{
    // block component view
    function block($f)
    {
        $data['id'] = 1;
        $data['title'] = 'Home Page';
        $data['post'] = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo neque laudantium alias tempore.';


        // return $1f;
        // return view('component-test', compact('f'=>$f));
        // return view('component-test', ['ff' => $f]);

        // return view('component-test', ['ff' => $data]);
        return view('component-test', $data);

    }
}
