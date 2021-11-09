<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Helpers\Helper;
use DB;
class ContactController extends Controller
{

    function index()
    {
    //  return 'a';
     $data = DB::table('contacts')->orderBy('id', 'DESC')->paginate(10);
     return view('admin.contacts.index', compact('data'));
    }

   
    public function create(Request $request)
    {
        $firstcategory = Contact::where('id')->first();
       
        return view('admin.contacts.create',compact('firstcategory'));
    }
 public function edit(Request $request,$id)
   {
       $data= Contact::where('id',$id)->first();
   
       return view('admin.contacts.edit',compact('data'));
   }

   public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($_REQUEST);
        // exit();

        $this->validate($request, [
          
            'email' => 'required',
            'phone' => 'required',
           
        ]);
        if (Contact::where('email', '=', $request->email)->count() > 0)
        {
           return back()->with('flash_error', 'Exists Can not Create email Twice');
        }
        else
        {

          
                $product = new Contact;
                $product->address= $request->address;
                $product->map_link = $request->map_link;
                $product->email = $request->email;
                $product->phone = $request->phone;
               $product->facebook = $request->facebook;
               $product->instagram = $request->instagram;
               $product->linkedin = $request->linkedin;
               $product->twitter= $request->twitter;
               $product->pintrest = $request->pintrest;
                $product->save();

              

                
                return back()->with('flash_success', ' Created successfully');
            }
        
    }
    public function update(Request $request, $id)
   {
       //dd($_REQUEST);
        $this->validate($request, [
           'email' => 'required',
         
       ]);
       $product = Contact::find($id);
        $product->address= $request->address;
                $product->map_link = $request->map_link;
                $product->email = $request->email;
                $product->phone = $request->phone;
                 $product->facebook = $request->facebook;
               $product->instagram = $request->instagram;
               $product->linkedin = $request->linkedin;
               $product->twitter= $request->twitter;
               $product->pintrest = $request->pintrest;
             $product->save();
       return back()->with('flash_success', ' Updated successfully');
   }

    public function destroy($id)
    {
        $data =Contact::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

    
}
