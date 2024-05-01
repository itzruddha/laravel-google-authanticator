@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="card card-default">
                            <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>

                            @if (Auth::guard('admin')->user()->google2fa_secret == null)
                                <div class="card-body" style="text-align: center;">
                                    <p>Set up your two factor authentication by scanning the barcode below. Alternatively,
                                        you
                                        can use
                                        the code <strong>{{ $secret }}</strong></p>
                                    <div>
                                        {!! $QR_Image !!}
                                    </div>
                                    <p>You must set up your Google Authenticator app before continuing. You will be unable
                                        to
                                        login
                                        otherwise</p>
                                    <div>
                                        <a href="{{ route('complete.registration') }}" class="btn btn-primary">Complete
                                            Registration</a>
                                    </div>
                                </div>
                            @else
                                <div class="card-body" style="text-align: center;">
                                    <p>Your two factor authentication Complete!!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
