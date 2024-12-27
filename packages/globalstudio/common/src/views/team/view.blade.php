@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Team
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1604.44px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Invoice #{{ $order->id }}</h1> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Teams</a></li>
                            <li class="breadcrumb-item active">view</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        {{-- <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to
                            test.
                        </div> --}}

                        <div class="invoice p-3 mb-3">




                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th> </th>
                                                    <td> <img class="profile-user-img img-fluid img-circle"
                                                            src="{{ asset('storage/team/'.$team->image) }}" alt="User profile picture"></td>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Name:</th>
                                                    <td>
                                                        <h5>{{ $team->name }}<h5>
                                                    </td>
                                                </tr>
                                               

                                               
                                               
                                              

                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Employee Type:</th>
                                                    <td>
                                                        <h5>{{ ucfirst($team->employee_type) }}</h5>
                                                    </td>
                                                </tr>

                                               
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Facebook:</th>
                                                    <td>
                                                        <h5>{{ $team->facebook }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Linkedin:</th>
                                                    <td>
                                                        <h5>{{ $team->linkedin }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Google:</th>
                                                    <td>
                                                        <h5>{{ $team->google}}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Twitter:</th>
                                                    <td>
                                                        <h5>{{ $team->twitter }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Description:</th>
                                                    <td>
                                                        <h5>{{ $team->description }}<h5>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            {{-- 
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
