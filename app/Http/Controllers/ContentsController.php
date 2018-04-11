<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContentsController extends Controller
{
    //
    public function home(Request $request) // inject Request to method
    {
        $data = [];
        $data['version'] = '0.1.2';
        $last_update = $request->session()->has('last_updated') ?
        $request->session()->pull('last_updated') : 'none';
        $data['last_updated'] = $last_update; // pass session to $data
        return view('contents/home', $data);
    }

    public function upload(Request $request) // inject Request to method
    {
        $data = [];
        if( $request->isMethod('post') )
        { // NOTE: We can't let to upload any file! This is dangerious! They could upload videos, harmful files or even php scripts to take over our server. Let's use laravel to validate our fields.

            $this->validate(
                $request,
                [
                    'image_upload' => 'mimes:jpeg,bmp,png'
                ]
            );
            Input::file('image_upload')->move('images', 'attractions.jpg'); // Move image to images in public folder and replace the old one attractions.jpg
            return redirect('/');
        }
        return view('contents/upload', $data);
    }

}
