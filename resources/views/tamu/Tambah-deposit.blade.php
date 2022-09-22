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
                                        <label class="control-label mb-10" for="">Tambah Jumlah Deposit</label>
                                        <input type="text" min="0"
                                            onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                            class="form-control" value="0" name="balance" size="50px"
                                            placeholder="Masukan Jumlah Deposit">
                                        <p>Pastikan tamu memberitahu atau memberi bukti transfer, baik berupa screenshoot
                                        </p>
                                    </div>
                                    <div class="form-group text-left">
                                        <a href="daftar-tamu"><button type="submit"
                                                class="btn btn-info">Submit</button></a>
                                        <a href="daftar-tamu"><button class="btn btn-info">Lewati</button></a>

                                    </div>
                                </form>

                            </div>
                            <!-- /Basic Table -->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endsection
    <script></script>
