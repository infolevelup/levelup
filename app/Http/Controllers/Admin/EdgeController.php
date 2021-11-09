<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Edge;
use App\Edge_logo;
use App\Course_timeline;
use Carbon\Carbon;
class EdgeController extends Controller
{
    //
     public function index()
    {
        $data = Edge::orderBy('id','DESC')->get();
        return view('admin.edge.index',compact('data'));
    }
     public function create()
    {
        return view('admin.edge.create');

    }

    public function store(Request $request)
    {
        
            $product = new Edge;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->save();
    
        	 $pdf_name = $request->name;
              
               if(count($pdf_name)){
                    foreach($request->file('logo') as $key => $image) {
                        $name=time().'.' .$image->extension();
                            $image->move(public_path().'/uploads/', $name);  
                            $dataa[] = $name;
        				 if ($pdf_name[$key]!=null && $name!=null  ) {
            				$product_pricee= new Edge_logo();
                            $product_pricee->edge_id = $product->id;
                            $product_pricee->logo = $name;
                            $product_pricee->name = $pdf_name[$key];
                            $product_pricee->save();
                        
        				 }
                      
                    }
               }
				    return back()->with('flash_success', ' Created successfully');

    }


    public function destroy($id)
    {
    }

      public function edit(Request $request,$id)
    {
        $data = Edge::where('id',$id)->first();
        $product = Edge_logo::where('edge_id',$id)->get();
       
        return view('admin.edge.edit',compact('data','product'));

    }

    public function update(Request $request, $id)
    {
        $product = Edge::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();
        return back()->with('flash_success', ' Updated successfully');
    }

 public function deleteMoreEdge(Request $request,$id)
    {
       // $id = $_REQUEST['id'];
        $data = Edge_logo::find($id);
        $delete = @unlink(public_path('public/uploads/'.$data->image));
        if ($delete = true) {
            if ($data->delete()) {
                return back()->with('flash_success', 'Image Deleted Successfully!');
            }
        }
    }

 public function addMoreEdge(Request $request)
    {
        	if($request->hasfile('logo'))
         {
            foreach($request->file('logo') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/', $name);  
                //$datt[] = $name; 
			$datt= array(
                            'logo'=>$name,
							
                           'edge_id'=>$request->edge_id,
                           'name'=>$request->name,
                );	
 Edge_logo::insert($datt);				
            }
         }
   /*
        	 $pdf_name = $request->name;
              
               if(count($pdf_name)){
                    foreach($request->file('logo') as $key => $image) {
                        $name=time().'.' .$image->extension();
                            $image->move(public_path().'/uploads/', $name);  
                            $dataa[] = $name;
        				 if ($pdf_name[$key]!=null && $name!=null  ) {
            				$product_pricee= new Edge_logo();
                            $product_pricee->edge_id = $request->edge_id;
                            $product_pricee->logo = $name;
                            $product_pricee->name = $pdf_name[$key];
                            $product_pricee->save();
                        
        				 }
                      
                    }
               
        } 
     */   return back()->with('flash_success', 'Uploaded successfully');
        
    }

}
