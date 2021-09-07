@extends('layouts.admin')

@section('title','Admin Dashboard')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
@endsection

@section('content')

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <h3>Basic Details of Clients </h3>
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
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Client Mobile</th>
                        <th>Policy Details</th>
                        <th>Export Data</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ( $item as $value )
                                    
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->client_name}}</td>
                        <td>{{$value->client_email}}</td>
                        <td>{{$value->client_mobile}}</td>
                        <td>
                        <a href="{{route('policy.view',$value->id)}}" class="text-decoration-none"><span class="text-success">View</span>&nbsp;<i class="fa fa-eye text-success" aria-hidden="true"></i></a>
                    </td>
                    <td>                          
                    
                    
                    <a href="{{route('export',[$value->id])}}" class="btn btn-primary" >Export</a>
                    </td>
    
                     <td>                          
                    <a href="{{route('client.edit',$value->id)}}" value="Edit"><i class="fas fa-pen mr-5 text-success"></i></a>
                    <a href="{{route('client.delete',$value->id)}}" value="Delete" onclick="return confirm('After Delete User You will also lost all of your policy !! Are you sure to delete?')"><i class="far fa-trash-alt ml-5 text-danger"></i></a>
                    </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>

        </div>
        
    </div>


@endsection

@push('script')
<script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

<script>

 $(document).ready( function ($) {
    //$.noConflict();
    $('#dataTable').DataTable();
} );
</script>
@endpush


