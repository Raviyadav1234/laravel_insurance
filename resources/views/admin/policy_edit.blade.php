@extends('layouts.admin')

@section('title','Client Edit')

@section('css')
<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="col-lg-12 col-sm-12 mt-5">
    <!-- Page Heading -->
                   @if(session()->has('success'))
                    <div class="alert alert-success" id="success">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                     </div>
                      @endif
                     
               
    @foreach ($item as $value) 
             
    <form method="POST" id="myform" action="{{ route('policy.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div class="form-group">
               <label for="exampleFormControlInput1">Client Id</label>
               <input type="text" name="client_id" class="form-control" id="clientid" required value="{{$value->client_id}}" readonly>
           </div>
           

           <div class="form-group" id="fornext">
             <label for="exampleFormControlSelect1">Select Category</label>
             <select class="form-control" name="category" id="category">
                <option >Select Category</option>
                            
                <option value="motor"
                @php
                @if($value->category=="motor"){
                    echo "selected";
                    
                }
                  @endphp 
                >motor</option>
                <option value="nonmotor"
                @php
                if($value->category=="nonmotor"){
                    echo "selected";
                }
                  @endphp
                >Non Motor</option>
            
             </select>
             @error('category')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>

           
           <div class="form-group">
               <label for="exampleFormControlInput1">Insurance Policy Number</label>
               <input type="text" name="insurance_number" class="form-control" id="exampleFormControlInput1" placeholder="ABIUN78514646" required value="{{$value->insurance_number}}" readonly>
               
               @error('insurance_number')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>

           <div class="form-group">
               <label for="exampleFormControlInput1">Upload File</label>
               <input type="file" name="file_name" class="form-control" id="file_name" value="{{$value->image}}" onchange="previewImage();" />
                <input type="button" value="Preview" onclick="PreviewPdfBtn();" id="preview_pdf_btn" class="d-none"/>
               @error('file_name')
               <span class="text-danger">{{$message}}</span>
               @enderror
           </div>

           <img src="{{ asset('/storage/uploads/home/'. $value->image) }}" class="h-25 w-25 img-thumbnail img-fluid" id="preview">
                            <span id="img_nm">{{$value->image}}</span>

                            <a type="button" href="{{ asset('/storage/uploads/home/'. $value->image) }}" target="_blank" class="btn btn-secondary w-25" value="Preview" onclick="PreviewPdf();" id="pdf_btn">Preview Pdf</a>

                    <div style="clear:both">
                        <iframe id="viewer" frameborder="0" scrolling="no" width="300" height="200" class="d-none"></iframe>
                    </div>

           <div style="clear:both">
           <iframe id="viewer" frameborder="0" scrolling="no" width="300" height="200" class="d-none"></iframe>
       </div>

       <script>
        function PreviewPdfBtn() {
          pdffile=document.getElementById("file_name").files[0];
          pdffile_url=URL.createObjectURL(pdffile);
          $('#viewer').toggle();
          $('#viewer').removeClass("d-none");
          $('#viewer').attr('src',pdffile_url);     
      }
    </script>

                <!-- The Modal -->
                <div id="myModal" class="modal" style="overflow: auto;">
                    <span class="close text-white">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                    </div>
                    <!-- End Modal -->

                <!-- Start JS for Modal -->
                            <script>
                            var modal = document.getElementById("myModal");
                            var img = document.getElementById("preview");
                            var modalImg = document.getElementById("img01");
                            var captionText = document.getElementById("caption");
                            img.onclick = function(){
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            captionText.innerHTML = this.alt;
                            }
                            var span = document.getElementsByClassName("close")[0];
                            span.onclick = function() { 
                            modal.style.display = "none";
                            }
                            </script>
                            <!-- End JS for Modal -->

                <!-- Start JS for image preview -->       
                    <script>
                    function previewImage() {
                       
                        var file = document.getElementById("file_name").files;
                        var file_name = file[0]['name'];
                        
                       var extention= file_name.substr((file_name.lastIndexOf('.') + 1));
                       //console.log(extention);
                        if (file.length>0 && extention!=='pdf') {
                       
                        var fileReader = new FileReader();
                
                fileReader.onload = function (event) {
                    document.getElementById("preview").setAttribute("src", event.target.result);
                    document.getElementById("preview").setAttribute("style", "height:200px;width:200px");
                    $('#preview_pdf_btn').addClass("d-none");
                    document.getElementById("img_nm").style.display="none";
                    document.getElementById("pdf_btn").style.display="none";
                    $('#viewer').addClass("d-none");
                            
                    };
        
                    fileReader.readAsDataURL(file[0]);
                       
                    } else if(file.length>0 && extention=='pdf'){
                        var fileReader = new FileReader();
                
                        fileReader.onload = function (event) {
                            document.getElementById("preview").style.display="none";
                            $('#preview_pdf_btn').removeClass("d-none");
                            document.getElementById("img_nm").style.display="none";
                            document.getElementById("pdf_btn").style.display="none";
                                    
                            };
                
                            fileReader.readAsDataURL(file[0]);
                            }
                       
                }
               </script>
               <!-- End JS for image preview -->

           <div class="form-group" id="product_type">
               <label for="exampleFormControlSelect1">Select Product</label>
               <select class="form-control" name="product_type" id="product_type_value">
                <option value="{{$value->product_type}}" 
                    @php
                    if($value->product_type=="private_car"){
                        echo "selected";
                      }
                   @endphp
                    >Private Car</option>
                    <option value="{{$value->product_type}}"
                    @php
                    if($value->product_type=="wheeler_2"){
                        echo "selected";
                      }
                    @endphp
                    >2 Wheeler</option>
                    <option value="{{$value->product_type}}"
                    @php 
                    if($value->product_type=="commercial"){
                        echo "selected";
                      }
                    @endphp
                    >Commerical</option>
                    <option value="{{$value->product_type}}"
                    @php
                    if($value->product_type=="others"){
                        echo "selected";
                      }
                    @endphp
                    >Others</option>
               </select>
                     @error('product_type')
                     <span class="text-danger">{{$message}}</span>
                      @enderror
           </div>
           <div class="form-group" id="vehicle_number">
               <label for="exampleFormControlInput1">Vehicle Number</label>
               <input type="text" name="vehicle_number" id="vehicle_number_input" class="form-control" id="exampleFormControlInput1" value="{{$value->vehicle_number}}" placeholder="HR-26-AD-8985">
               @error('vehicle_number')
               <span class="text-danger">{{$message}}</span>
                @enderror

           </div>
           <div class="form-group" id="vehicle_model">
               <label for="exampleFormControlInput1">Model & Make</label>
               <input type="text" name="vehicle_model" id="vehicle_model_input" class="form-control" id="exampleFormControlInput1" value="{{$value->vehicle_model}}" placeholder="Honda City ivtec 2016">
               @error('vehicle_model')
               <span class="text-danger">{{$message}}</span>
                @enderror
           </div>
           
       <div class="row">
     <div class="col-sm-12">
     <label for="exampleFormControlInput1">Period of Insurance</label>
     </div>
       <div class="form-group col-md-5">
   <input type="date" class="form-control" id="insurance_startdate" name="insurance_startdate" value="{{$value->insurance_startdate}}">
   @error('insurance_startdate')
   <span class="text-danger">{{$message}}</span>
    @enderror
 </div> <span> to </span>
 <div class="form-group col-md-5">
   <input type="date" class="form-control" id="insurance_enddate" name="insurance_enddate" value="{{$value->insurance_enddate}}">
   @error('insurance_enddate')
   <span class="text-danger">{{$message}}</span>
    @enderror
 </div>
    </div>
       </div>

       <!-- Account Entry -->

       <div class=" col-sm-12">
           <div class="form-group">
               <label for="exampleFormControlInput1">Total Amount to Collect</label>
               <input type="text" name="total_amount" class="form-control" id="exampleFormControlInput1" placeholder="50000" required value="{{$value->total_amount}}">
               @error('total_amount')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           
           <div class="form-group">
           <label for="exampleFormControlSelect1">Select Installment</label>
           <select class="form-control" name="installment" id="exampleFormControlSelect1" onchange="showDiv(this)">
               <option value="noemi">Select EMI</option>
               <option value="0">EMI 1</option>
               <option value="1">EMI 2</option>
               <option value="2">EMI 3</option>
           </select>
           </div>

           <div class="form-group">
           <div id="hidden_div" style="display:none;">
               <label for="exampleFormControlInput1">Input Credit/Debit Amount for EMI 1</label>
               <input type="text" value="{{$value->credit_debit_amount}}" name="credit_debit_amount" class="form-control" id="exampleFormControlInput1" placeholder="10000" value="{{$value->credit_debit_amount}}">
               @error('credit_debit_amount')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           <div id="hidden_div1" style="display:none;">
           <p><strong style="color:red;">Update EMI 1 first</strong></p>
           </div>
           <div id="hidden_div2" style="display:none;">
           <p><strong style="color:red;">Update EMI 1 first</strong></p>
           </div>
           </div>
           
               <script type="text/javascript">
               function showDiv(select){
               if(select.value==0){
                   document.getElementById('hidden_div').style.display = "block";
                   document.getElementById('hidden_div1').style.display = "none";
                   document.getElementById('hidden_div2').style.display = "none";
               } else if (select.value==1)
               {
                   document.getElementById('hidden_div1').style.display = "block";
                   document.getElementById('hidden_div').style.display = "none";
                   document.getElementById('hidden_div2').style.display = "none";
               }
                   else if (select.value==2)
               {
                   document.getElementById('hidden_div2').style.display = "block";
                   document.getElementById('hidden_div1').style.display = "none";
                   document.getElementById('hidden_div').style.display = "none";
               }
               else{
                   document.getElementById('hidden_div').style.display = "none";
                   document.getElementById('hidden_div1').style.display = "none";
                   document.getElementById('hidden_div2').style.display = "none";
               }
               }
               </script>

           <!-- <div class="form-group">
               <label for="exampleFormControlInput1">Input Credit/Debit Amount</label>
               <input type="text" name="credit_debit_amount" class="form-control" id="exampleFormControlInput1" placeholder="60000" required>
           </div> -->

           <div class="form-group">
               <label for="exampleFormControlInput1">Enter Date</label>
               <input type="date" class="form-control" name="entry_date" id="exampleFormControlInput1" required value="{{$value->entry_date}}">
               @error('entry_date')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>

           <div class="form-group">
               <label for="exampleFormControlInput1">Enter EMI2 Reminder Date</label>
               <input type="date" class="form-control" name="emi2_expected_date" id="exampleFormControlInput1" required value="{{$value->emi2_expected_date}}">
               @error('emi2_expected_date')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
          
           <div class="form-group">
               <label for="exampleFormControlSelect1">Mode of Payment</label>
               <select class="form-control" name="payment_mode" id="exampleFormControlSelect1">
                 <option value="cash" >Cash</option>
                 <option value="cheque" >Cheque</option>
                 <option value="online" >Online</option>
               </select>
               @error('payment_mode')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           <div class="form-group">
               <label for="exampleFormControlInput1">Payment Reference Number</label>
               <input type="text" class="form-control" name="payment_reference_number" id="exampleFormControlInput1" placeholder="UPI: 87954sdf858" required value="{{$value->payment_reference_number}}">
               @error('payment_reference_number')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           <button type="submit" class="btn btn-primary mb-2" name="submit_btn" id="submit">Submit</button>
         
         </form>
      @endforeach
    </div>

@endsection

@push('script')
<script>
    $("#category").change(function(){
    var value = $(this).val();
    if(value=='motor'){
      $("#secondfield").hide();
      $("#product_type").show();
      $("#vehicle_number").show();
      $("#vehicle_model").show();
   
    } else if(value=='nonmotor') {
       $("#firstfield").hide();
        $("#product_type").hide();
        $("#vehicle_number").hide();
        $("#vehicle_model").hide();
        $("#fornext").after(`
        <div class="form-group" id="secondfield">
                          <label for="exampleFormControlSelect1">Select non motor</label>
                          <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
                          <option value="" selected disabled>Select Non-Motor</option>
                          <option value="health">health</option>
                          <option value="life">life</option>
                          <option value="property">property</option>
                          <option value="travel">travel</option>
                          <option value="other">other</option>
                          </select>
                        </div>
        `);
    

    }
});
</script>
 
 <script>

    window.onload =  function(){
    var select = document.getElementById('category');
    if(select.value =='motor'){
        
      $("#secondfield").hide();
      $("#product_type").show();
      $("#vehicle_number").show();
      $("#vehicle_model").show();


    } else if(select.value=='nonmotor') {
        $("#firstfield").hide();
        $("#product_type").hide();
        $("#vehicle_number").hide();
        $("#vehicle_model").hide();
        $("#fornext").after(`
        <div class="form-group" id="secondfield">
                          <label for="exampleFormControlSelect1">Select non motor</label>
                          <select class="form-control" name="category_value" id="exampleFormControlSelect1">
                          
                          <option value="" selected disabled>Select Non-Motor</option>
                          <option value="health">health</option>
                          <option value="life">life</option>
                          <option value="property">property</option>
                          <option value="travel">travel</option>
                          <option value="other">other</option>
                          </select>
                        </div>
        `);

    }
        var file = document.getElementById("preview").getAttribute('src');
                            var extention= file.substr((file.lastIndexOf('.') + 1));
                            //console.log(extention);
                            if(extention!=='pdf'){
                               document.getElementById("pdf_btn").style.display="none"; 
                            } else if(extention=='pdf'){
                            document.getElementById("pdf_btn").style.display="block";
                            document.getElementById("preview").style.display="none"; 
                            }

}
</script>
@endpush


