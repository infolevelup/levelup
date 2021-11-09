<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Faq;
  
use App\Helpers\Helper;

class FaqController extends Controller
{

  public function index(Request $request)
    {
    	$data = Faq::paginate(100);
    	return view('admin.faq.index',compact('data'));
    }
    
    public function store(Request $request)
    {
     $faq =  Faq::create([
                    'qustion' => $_REQUEST['qustion'],
                    'answer' => $_REQUEST['answer'],
               ]);
         return back()->with('flash_success', 'Faq added successfully');

    }
    public function create()
    {
        return view('admin.faq.create');
    }

    
 public function destroy($id)
    {
        Faq::find($id)->delete();
        return back()->with('flash_success', 'faq deleted successfully');
    }
    
    
    public function edit($id)
    {
        //
         $data = Faq::find($id);
        return view('admin.faq.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        
//return $request->all();
      
         $faq = Faq::where('id',$id)
            ->update([
                'qustion'=>$request->input('qustion'),
                'answer'=>$request->input('answer')
                 
                ]);
        return back()->with('flash_success', 'Faq Updated successfully');
        
      
    }

}
