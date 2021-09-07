@extends('layouts.admin')

@section('title','Policy View')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">

@endsection

@section('content')

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <h3>Policy Details of Clients </h3>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Credit/Debit Statement</h6>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-danger">
    {{session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
     </div>
      @endif

    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered text-center table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                            <th>CLient_Id</th>
                                            <th>Policy Number</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Product Type</th>
                                            <th>Vehicle Number</th>
                                            <th>Model</th>
                                            <th>Insurance Start On</th>
                                            <th>Insurance Expire On</th>
                                            <th>Expiry Status</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Reference Number</th>
                                            <th>EMI1 Fill Date</th>
                                            <th>EMI2 Reminder Date</th>
                                            <th>EMI1 Amount</th>
                                            <th>EMI2 Fill Date</th>
                                            <th>EMI3 Reminder Date</th>
                                            <th>EMI2 Amount</th>
                                            <th>EMI3 Fill Date</th>
                                            <th>EMI3 Amount</th>
                                            <th>Total Amount</th>
                                            <th>Due Amount</th>
                                            <th>Action</th>
                                            
                        
                    </tr>
                </thead>
                
                <tbody>
                    @php 
                    $due = 0;
                    @endphp

                    @foreach ( $item as $value )

                    @php 
                $due_balance = $value->total_amount-($value->credit_debit_amount + $value->credit_debit_amount1 + $value->credit_debit_amount2);
                    @endphp
                                    
                    <tr>
                        <td>{{$value->client_id}}</td>
                        <td>{{$value->insurance_number}}</td>
                        <td>

                            
               
                                  @if(pathinfo($value->image, PATHINFO_EXTENSION)=='pdf')

                                    <img src="{{ asset('/storage/uploads/home/'. $value->image) }}" class="img-fluid d-none" />
                                    <img src="{{asset('img/pdf-icon.png')}}" class="img-thumbnail img-fluid" height="50px" width="50px"/>

                                @else
                                 <img src="{{ asset('/storage/uploads/home/'. $value->image) }}" class="img-thumbnail" style="height: 50px;width:100px;" />
                               
                                  @endif
                               

                                  {{$value->image}}
                                  <br><a type="button" href="{{ asset('storage/uploads/home/'. $value->image) }}" target="_blank" class="btn btn-primary">Preview</a>
                                  
                                  <p>Or</p>
                                  <a type="button" href="{{route('download',[$value->image])}}" target="_ravi" class="btn btn-primary">Download</a>


                        </td>
                        <td>{{$value->category}}</td>
                        <td>{{$value->category_value}}</td>
                        <td>{{$value->product_type}}</td>
                        <td>{{$value->vehicle_number}}</td>
                        <td>{{$value->vehicle_model}}</td>
                        <td>{{$value->insurance_startdate}}</td>
                        <td>{{$value->insurance_enddate}}

                        </td>
                        <td>
                             <?php
                                $today_date = date('Y/m/d');
                                $td = strtotime($today_date);
                      $exp_date=strtotime($value->insurance_enddate);
                                  if($td>$exp_date){
                                 $diff_days = $td-$exp_date;
                    $remain_date = abs(floor($diff_days/(60*60*24)));
                    echo "<b class='text-danger'>Insurance has expired before <span style='color:black;'>{$remain_date}</span> days ago</b>";
                                  }else{
                                   $diff_days = $td-$exp_date;
                    $remain_date = abs(floor($diff_days/(60*60*24)));
                            echo "<b class='text-success'>Insurance will expired in <span style='color:black;'>{$remain_date}</span> days</b>";
                                                
                                              }
                                              ?>
                        </td>
                        <td>{{$value->payment_mode}}</td>
                        <td>{{$value->payment_reference_number}}</td>
                        <td>{{$value->entry_date}}</td>
                        <td>{{$value->emi2_expected_date}}</td>
                        <td><?php $due+=$value->credit_debit_amount;?>
                            {{$value->credit_debit_amount}}
                        </td>
                        <td>{{$value->entry_date2}}</td>
                        <td>{{$value->emi3_expected_date}}</td>
                        <td>
                           <?php $due+=$value->credit_debit_amount1;?>
                            {{$value->credit_debit_amount1}}
                        </td> 
                        <td>{{$value->entry_date1}}</td>
                        <td>
                            <?php $due+=$value->credit_debit_amount2;?>
                            {{$value->credit_debit_amount2}}
                        </td>
                        <td>{{$value->total_amount}}</td>
                        <td>{{$due_balance}}</td>
                        
                     
                     <td>                          
                 <a href="{{route('policy.edit',[$value->client_id,$value->insurance_number])}}" value="Edit"><i class="fas fa-pen mr-5 text-success"></i></a>
                    <a href="{{route('policy.delete',$value->insurance_number)}}" value="Delete" onclick="return confirm('Are you sure to delete?')"><i class="far fa-trash-alt ml-5 text-danger"></i></a>
                    </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>

        </div>
        
    </div>


    <!-- for grand total -->
<div class="row">
  <div class="col-sm-6">
    <div class="card bg-warning">
      <div class="card-body">
        <h5 class="card-title"><b>Total Amount :</b> </h5>
        <p class="card-text">
          @if(isset($sum_total_amount))
          {{$sum_total_amount}}
          @endif

      </p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card bg-warning">
      <div class="card-body">
        <h5 class="card-title"><b>Total Due Amount :</b> </h5>
        <p class="card-text">
          @php
         $total_due_amount = $sum_total_amount-$due;
         @endphp
         {{$total_due_amount}}
          
        </p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
        <!-- <div data-date="<?php echo $value->insurance_enddate; ?>" id="count-down" ></div> -->
      </div>
    </div>
  </div>
</div>


@endsection



@push('script')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function (){
        //$.noConflict();
     $("#count-down").TimeCircles();
     
});
</script>




@endpush
