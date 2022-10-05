@extends('Layouts.Main')

@section('content')
    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-8">
                            <h5>Tambah Tamu</h5>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-12" style="position: relative;">
                    <div class="panel panel-default-card">
                        <h6 class="control-label mb-10">Tambah Tamu</h6>
                        <div class="panel-body">
                            <div class="form-wrap">
                                {{-- form --}}
                                <form action="{{ route('insertdeposit') }}" method="POST">
                                    <div class="form-group">
                                        @csrf
                                        <label class="control-label mb-10" for=""></label>
                                        <input type="hidden" name="visitor_id" value="{{ $id }}"
                                            class="form-control">
                                        <label class="control-label mb-10" for="">Jenis Pembayaran</label>
                                        <select name="payment_type" id="payment_type" class="form-control"  onchange="showDiv(this)">
                                            <option disabled selected>Pilih Pembayaran</option>
                                            <option value="cash" name="payment_type" id="payment_type">Cash</option>
                                            <option value="transfer" name="payment_type" id="payment_type">Transfer</option>
                                        </select>
                                        <br>
                                        <label class="control-label mb-10" for="" style="display:none;" id="hidden_div">
                                        <input type="hidden" name="visitor_id" value="{{ $id }}"
                                            class="form-control">
                                        <label class="control-label mb-10" for="">Tambah Jumlah Deposit</label>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control"  name="balance" size="50px"
                                            placeholder="Masukan Jumlah Deposit" id="balance">
                                        <p>Pastikan tamu memberitahu atau memberi bukti transfer, baik berupa screenshoot
                                        </p>
                                    </label>
                                    </div>
                                    <div class="form-group text-left">
                                        <a href="daftar-tamu"><button type="submit"
                                                class="btn btn-info">Submit</button></a>
                                    </div>
                                </form>

                            </div>
                            <!-- /Basic Table -->
                        </div>
                    </div>

                </div>

            </div>
        </div>

<script type="text/javascript">
    function showDiv(select){
    if(select.value=='cash'){
        document.getElementById('hidden_div').style.display = "block";
    } else if(select.value=='transfer'){
        document.getElementById('hidden_div').style.display = "block";
    }else{
        document.getElementById('hidden_div').style.display = "none";
        document.getElementById("balance").value = "0";
    }
    }
</script>
@endsection 

