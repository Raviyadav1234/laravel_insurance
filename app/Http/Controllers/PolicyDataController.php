<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\PolicyData;
use  App\Models\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PolicyDataExport;
use Illuminate\Support\Facades\Response;

class PolicyDataController extends Controller
{

  public function index(){
    return view('admin.policy_register');
  }


  public function save(Request $request){

    $request->validate([
      'file_name' => 'required|mimes:pdf,png,jpg,jpeg|max:2097152'
      ]);  
      
      $data = new PolicyData;
      if($request->file('file_name')){
      $data->client_id = $request->client_id;
      $data->category = $request->category;
      $data->category_value = $request->category_value;
      $data->product_type = $request->product_type;
      $data->vehicle_number = $request->vehicle_number;
      $data->vehicle_model = $request->vehicle_model;
      $data->insurance_number = $request->insurance_number;
      $data->insurance_startdate = $request->insurance_startdate;
      $data->insurance_enddate = $request->insurance_enddate;
      $data->total_amount = $request->total_amount;
      $data->credit_debit_amount = $request->credit_debit_amount;
      $data->entry_date = $request->entry_date;
      $data->emi2_expected_date = $request->emi2_expected_date;
      $data->payment_mode = $request->payment_mode;
      $data->payment_reference_number = $request->payment_reference_number;
      
      $fileName = time().'_'.$request->file_name->getClientOriginalName();
      $filePath = $request->file('file_name')->storeAs('uploads/home', $fileName, 'public');
      //$data->image = '/storage/' . $filePath;
      $data->image =  $fileName;
      
       //dd($data);
          $data->save();

          return redirect()->back()->with('success','Policy Registered Successfully !!');
          //return response()->json(['success'=>'Client Register Successfully !!']);
      }
  }

      public function show(Request $request){
      
        $id=$request->id;
        $policy_data = Client::join('policy_data', 'client.id', '=', 'policy_data.client_id')->where('client_id','=',$id)->get(['client.*', 'policy_data.*']);
        $sum_total_amount = DB::table('policy_data')
        ->where('client_id','=',$id)->SUM('total_amount');
      //dd($sum_total_amount);
        return view('admin.policy_view',['item'=>$policy_data,'sum_total_amount'=>$sum_total_amount]);
          
      }
      


      public function edit(Request $request){
        $id=$request->client_id;
        $insurance_number=$request->insurance_number;
    
        $policy_data = Client::join('policy_data', 'client.id', '=', 'policy_data.client_id')
        ->where('client_id','=',$id)
        ->where('insurance_number','=',$insurance_number)
        ->get(['client.*', 'policy_data.*']);
        return view('admin.policy_edit',['item'=>$policy_data]);
    }


    public function update(Request $request)
    {
        $client_id =$request->client_id;

        $insurance_number = $request->insurance_number;
        // $data = PolicyData::where('client_id','=',$client_id)
        // ->where('insurance_number','=',$insurance_number)
        // ->first();
        $data = Client::join('policy_data', 'client.id', '=', 'policy_data.client_id')
        ->where('client_id','=',$client_id)
        ->where('insurance_number','=',$insurance_number)
        ->first();
       
        //dd($data);
        
        $request->validate([
          'file_name' => 'mimes:pdf,png,jpg,jpeg|max:2097152'
          ]);

          if($request->file('file_name')!=null){
           //$data->client_id = $request->client_id;
           $data->category = $request->category;
            $data->category_value = $request->category_value;
            $data->product_type = $request->product_type;
            $data->vehicle_number = $request->vehicle_number;
            $data->vehicle_model = $request->vehicle_model;
            //$data->insurance_number = $request->insurance_number;
            $data->insurance_startdate = $request->insurance_startdate;
            $data->insurance_enddate = $request->insurance_enddate;
            $data->total_amount = $request->total_amount;
            $data->credit_debit_amount = $request->credit_debit_amount;
            $data->entry_date = $request->entry_date;
            $data->emi2_expected_date = $request->emi2_expected_date;
            $data->payment_mode = $request->payment_mode;
            $data->payment_reference_number = $request->payment_reference_number;
            
            $fileName = time().'_'.$request->file_name->getClientOriginalName();
            
            $filePath= $request->file('file_name')->storeAs('uploads/home', $fileName, 'public');
            //$data->image = '/storage/' . $filePath;
            $data->image =  $fileName;
            // dd($data->image);
             //dd($data);
            $data->save();
            
            return redirect()->back()->with('success','Policy Registered Successfully !!');
                
            }
            elseif($request->file('file_name')==null){
            //$data->client_id = $request->client_id;
            $data->category = $request->category;
            $data->category_value = $request->category_value;
            $data->product_type = $request->product_type;
            $data->vehicle_number = $request->vehicle_number;
            $data->vehicle_model = $request->vehicle_model;
            //$data->insurance_number = $request->insurance_number;
            $data->insurance_startdate = $request->insurance_startdate;
            $data->insurance_enddate = $request->insurance_enddate;
            $data->total_amount = $request->total_amount;
            $data->credit_debit_amount = $request->credit_debit_amount;
            $data->entry_date = $request->entry_date;
            $data->emi2_expected_date = $request->emi2_expected_date;
            $data->payment_mode = $request->payment_mode;
            $data->payment_reference_number = $request->payment_reference_number;
            
             //dd($data);
            $data->save();
      
            return redirect()->back()->with('success','Policy Registered Successfully !!');
            }
    }


      
      public function delete($insurance_number){

        DB::table('policy_data')->where('insurance_number', '=', $insurance_number)->delete();
        return redirect()->back()->with('success','Policy deleted Successfully !!');
      }


      public function download($filename){

         // Define the path and the extension
    $file = public_path() . "/storage/uploads/home/" . $filename;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if($ext == 'png' || 'PNG'){
      $headers = array(
          'Content-Type:image/png',
        );
    }

    else if($ext == 'jpg' || 'jpeg' || 'JPEG' || 'JPG'){
      $headers = array(
          'Content-Type:image/jpeg',
        );
      }

      else if($ext == 'pdf' || 'PDF'){
      $headers = array(
          'Content-Type:image/pdf',
        );
      }

      $response = Response::download($file, $filename, $headers);

      return $response;

      }


       public function export($id) 
    {
         //$policy_data = Client::join('policy_data', 'client.id', '=', 'policy_data.client_id')
         // ->where('client_id','=',$id)->get();
        // ->get(['client.*', 'policy_data.*']);
          //$policy_data = PolicyData::where('client_id','=',$id)->first();
        //dd($policy_data);
        //return Excel::download($policy_data, 'details.xlsx');
      return Excel::download(new PolicyDataExport, 'bulkData.xlsx');
    }


}
