<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Menuitem;
use Session;

class MenuController extends Controller
{
    public function index(){
        $desiredMenu = '';
        $menuitems = '';
        if(isset($_GET['id']) && $_GET['id'] != 'new'){
            $id = $_GET['id'];
            $desiredMenu = Menu::where('id',$id)->first();
            if($desiredMenu->content != ''){
                $menuitems = json_decode($desiredMenu->content);
            }else{
                $menuitems = Menuitem::where('menu_id',$desiredMenu->id)->get();                    
            }
        } else {
            $desiredMenu = Menu::orderby('id','DESC')->first();
            if($desiredMenu){
                if($desiredMenu->content != ''){
                    $menuitems = json_decode($desiredMenu->content);
                } else {
                    $menuitems = Menuitem::where('menu_id',$desiredMenu->id)->get();                    
                }
            }    
        }
        return view ('backend.menu',['menus'=>Menu::all(),'desiredMenu'=>$desiredMenu,'menuitems'=>$menuitems]);
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        if(Menu::create($data)){
            $newdata = Menu::orderby('id','DESC')->first();          
            session::flash('success','Menu saved successfully !');             
            return redirect("manage-menus?id=$newdata->id");
        }else{
            return redirect()->back()->with('error','Failed to save menu !');
        }
    }

    public function ckeditor() {
        return view('backend.editor');
    }
}
