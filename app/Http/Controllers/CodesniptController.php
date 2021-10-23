<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Codesnipt;
use Illuminate\Support\Facades\Auth;

class CodesniptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codesnipts = auth()->user()->codesnipts;
        return view('codesnipt.index',compact('codesnipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('codesnipt.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // htmlentities

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'code_snipt' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if(!$validator->Fails()){
            $data = $request->input();
            $codeSnipt = new Codesnipt;
            $codeSnipt->user_id = Auth::user()->id;
            $codeSnipt->title = $data['title'];
            $codeSnipt->slug = convert_title_to_slug($data['title']);
            $codeSnipt->description =  $data['description'];
            $codeSnipt->code_snipt = htmlentities($data['code_snipt']);
            $codeSnipt->save();

            return redirect()->route('codesnipt.create')->with('status','succfully inserted.');
           
        }else{
            dd($validator);
        }
    //     echo convert_title_to_slug('TESt Added q rqwrqwre qwr q erqwrer   eqerWxWWWSS');
    //    dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $codesnipt = Codesnipt::where(['slug'=>$slug])->get();
        return view('codesnipt.view',compact('codesnipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $codesnipt = Codesnipt::findOrFail($id);
        return view('codesnipt.edit',compact('codesnipt'));
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
        $rules = [
            'title' => [
                'required',
                'unique:codesnipts,title,'.$id.',id'
            ],
            'description' => 'required',
            'code_snipt' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        
        if(!$validator->fails()){
           try{
                $codesnipt = Codesnipt::findorFail($id);
                $codesnipt->title = $request->input('title');
                $codesnipt->slug = convert_title_to_slug($request->input('title'));
                $codesnipt->description = $request->input('description');
                $codesnipt->code_snipt = htmlentities($request->input('code_snipt'));
                $codesnipt->save();
                return redirect('admin/codesnipt')->with('status','Successfully update.');
            }catch(Exception $e){    
                return redirect()->back()->with('failed','Operation failed.');
            }
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $codesnipt = Codesnipt::findOrFail($id);
        if($codesnipt->delete()){
            return redirect()->back()->with('status','successfully deleted.');
        }else{
            return redirect()->back()->with('failed','Operation failed.');
        }
    }

    public function codesnipts(Request $request){
        $codesnipts = Codesnipt::where('title','LIKE','%'.$request->get('search').'%')->paginate(5);
        return view('codesnipt.list',compact('codesnipts'));
    }
}
