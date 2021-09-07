<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Client;
use  App\Models\PolicyData;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(){

        return view('admin.client_register');
    }

    public function save(Request $request)
    {

        // return $request->post();
        // exit;
        $request->validate([
            'client_name'=>'required',
            'client_email'=> 'required|email|unique:client',
            'client_mobile'=>'required',
            ]);  
            
            $data = new Client;
            
            $data->client_name = $request->client_name;
            $data->client_email = $request->client_email;
            $data->client_mobile = $request->client_mobile;
            $data->save();
    
            // return redirect()->back()->with('success','Client Registered Successfully !!');
            return response()->json(['success'=>'Client Register Successfully !!']);
        
            
            
    }


    public function autofill(Request $request){
  
        if($request->has('search')){
            $search = $request->search;
            $res =Client::where('id','LIKE',"%$search%")->get();

            foreach($res as $key=>$each)
            {
                $res[$key]['text']=$each['client_name']." (".$each['client_email'].")";
                
            }
        }else
        $res=[];
       echo json_encode(['data'=>$res]);
    }


    public function edit(Request $request,$id){
        $id=$request->id;
        $data = Client::where('id','=',$id)->get();
        //dd($data);
        return view('admin.client_edit',['item'=>$data]);
    }


    public function update(Request $request)
    {
        $id =$request->id;
        $data = Client::find($id);
        //dd($data);
        $request->validate([
            'client_name'=>'required',
            'client_email'=> 'required|email|unique:client',
            'client_mobile'=>'required',
            ]);  
            
            $data->client_name = $request->client_name;
            $data->client_email = $request->client_email;
            $data->client_mobile = $request->client_mobile;
            $data->save();
    
           // return redirect()->back()->with('success','Client Updated Successfully !!');
            return response()->json(['success'=>'Client Updated Successfully !!']);
    }


    public function delete(Request $request,$id){
        $id=$request->id;
        $policy_data=DB::table('policy_data')->where('client_id', '=', $id)->delete();
        if($policy_data){
            DB::table('client')->where('id', '=', $id)->delete();

            return redirect()->back()->with('success','Client Deleted Successfully !!');
        }
        
    }

}
