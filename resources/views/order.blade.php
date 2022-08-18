@extends('Layouts.Main')
@section('content')

<div class="page-wrapper pa-0 ma-0 auth-page">
    <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
            <div class="table-cell vertical-align-middle auth-form-wrap">
                
                <div class="auth-form  ml-auto mr-auto no-float">
                    <div class="row">
                        <div class="">
                            
                            <h6 class=""><strong>Pilih Permainan</strong></h6>
                        </div>	
                        <div class="col-sm-12 col-xs-12">

                            <div class="form-wrap">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label class="pull-left control-label mb-10" >Data Pengunjung</label>
                                        <select class="form-control required" id="test" name="form_select" onchange="showDiv(this)">
                                            <option value="">Pilih metode Pembayaran</option>
                                            <option value="1">Limit Bulanan</option>
                                            <option value="2">Limit Kupon</option>
                                            <option value="3">Cash / Transfer</option>
                                         </select>
                                    </div>
                                    <div class="form-group" id="hidden_div" style="display:none;">
                                       <input type="radio" name="" value="one game" checked>
                                       <label class="right control-label mb-10" for="password">One Game</label>
                                       <label for="">&nbsp;</label>
                                       <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Praktice     
                                        <br>
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Mobile 1 Cabine
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Aditional 1
                                        <br>
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Mobile 2 Cabine
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Aditional 2
                                        <br>
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Mobile 3 Cabine
                                        <input type="number" id="quantity" name="quantity" min="1" placeholder="0">Aditional 3
                                        <br>
                                        <button type="submit" class="btn btn-info btn-rounded">Proses</button>
                                    </div>
                                    <div class="form-group" id="hidden_div2" style="display:none;">
                                        <input type="radio" name="" value="one game" checked>
                                        <label class="control-label mb-10" for="">Pilih Item Tambahan</label>
                                     </div>
                                     
                                    
                                </form>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->	
    </div>
    
</div>
<script>
    function showDiv(select){
   if(select.value==1 || select.value==2){
    document.getElementById('hidden_div').style.display = "block";
   }
   else if(select.value==3){
    document.getElementById('hidden_div').style.display = "block";
   } else{
    document.getElementById('hidden_div').style.display = "none";
   }
} 
</script>
@endsection
