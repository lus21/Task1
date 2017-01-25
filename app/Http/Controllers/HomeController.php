<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function addUser(Request $request) {
        $f_name = $request->input('first_name');
        $l_name = $request->input('last_name');
        $keywords = $request->input('keywords');
        $file = $request->file('fileToUpload');
        if(empty($f_name) || empty($l_name) || empty($keywords) || empty($file)){
             $msg=1;
        }else{
            $allowed_types = ["doc","docx","pdf","txt"];
            $filename=$file->getClientOriginalName();
            $array = explode(".",$filename);
            $format = end($array);
                if(!in_array($format,$allowed_types)){
                    $msg=2;
                }else{
                    $date=date('Y_m_d_H_i_s');
                    $file_name='resume_'.$f_name.'_'.$l_name.'_'.$date.'.'.$format; 
                    $move=move_uploaded_file($file,'uploads/'.$file_name);
                    $add=Home::insert(
                        ['f_name' => $f_name, 'l_name' => $l_name,'keywords' => $keywords,'resume' => $file_name]
                    );
                    if($move && $add){
                        $msg=3;
                    }else{
                        $msg=4;
                    }
                }
        }
        return redirect()->back()->with('msg',$msg);    
       // return view('home')->with('msg',$msg);
    }
    public function search(Request $request) {
       $f_name = $request->input('first_name');
       $l_name = $request->input('last_name');
       $keywords = $request->input('keywords');
       if(!empty($f_name) || !empty($l_name) || !empty($keywords)){
            $selected = Home::where('f_name','like','%'.$f_name.'%')
                ->where('l_name','like','%'.$l_name.'%')
                ->where('keywords','like','%'.$keywords.'%')
                ->get();
            echo json_encode($selected);
            exit();
       }
    }
}

