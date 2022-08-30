@extends('Layouts.main')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row heading-bg">
                <!-- Breadcrumb -->
                @include('Layouts.Breadcrumb')
                <!-- /Breadcrumb -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default card-view" style="height: 200px;">
                        <strong>Pilih Paket Bermain</strong>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="checkbox" for="myCheckboxId">
                                </label>
                                <input class="checkbox__input" type="checkbox" name="myCheckboxId" id="myCheckboxId">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view" style="height: 200px;">
                        <h5 style="text-align: center;"><strong>DAFTAR ORDER</strong></h5>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:start;">Product</p>
                        </div>
                        <div class="col-lg-6 mt-5">
                            <p style="color: #7D7D7D; text-align:end;">Sub-Total</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr color="gray">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
