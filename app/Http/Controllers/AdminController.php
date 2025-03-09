<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function blog()
    {
    $blogs = DB::table('blogs')->get();
    return view('blog', compact('blogs'));
    }
    
    public function about()
    {
        $name = 'Ncwjj Dev';
        $date = '19 มิ.ย 2025';

        return view('about', compact('name', 'date'));
    }

    function delete($id){
        DB::table('blogs')->where('id',$id)->delete();
        return redirect('/blog');
        }

    public function insert(Request $request)
        {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status, 
            ];
            
            DB::table('blogs')->insert($data);
            return redirect('/blog');
        }
        


    public function create()
    {
        return view('form'); 
    }

    function edit($id){
        $blog=DB::table('blogs')->where('id',$id)->first();
        return view('edit', compact('blog'));
        }

    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status  
        ];
        
        DB::table('blogs')->where('id', $id)->update($data);
        
        return redirect('/blog');
    }
            
            

}
