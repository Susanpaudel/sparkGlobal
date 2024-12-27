@extends('frontend.layouts.master')
@section('css')
    <style>
        .sh-single-services {
            background: url("{{ asset('frontend/images/bg-content/sh-single-services.jpg') }}") no-repeat;

        }
    </style>
@endsection
@section('content')
    <section class="no-padding sh-single-services">
        <div class="sub-header ">
            <span>WHAT WE DO</span>
            <h3>Life Support Services</h3>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('index') }}"><i class="fa fa-home"></i> HOME </a>
                </li>
                <li>
                    <a href="{{ route('service') }}"> SERVICES </a>
                </li>
                <li class="active">Life Support Services</li>
            </ol>
        </div>
    </section>
    <!-- /Sub HEader -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="services-2-detail-warp">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title-block title-contact">
                                    <h3>Overview</h3>
                                    <span class="bottom-title"></span>
                                </div>

                                <p>Spark Global goes beyond just transport; we offer essential life support services to
                                    ensure that our clients, especially those involved in humanitarian, government, and
                                    military projects, are fully supported in challenging environments.</p>

                            </div>

                        </div>
                    </div>


                    <div class="benefit-services-warp-2 desk-pdt-60">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title-block title-contact">
                                    <h3>Why Traders Choose Us</h3>
                                    <span class="bottom-title"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconbox">
                                    <span class="icon icon-trophy"></span>
                                    <h4>Accommodation Setup</h4>
                                    <p>We arrange secure and comfortable accommodation in remote or operational areas.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconbox">
                                    <span class="icon icon-briefcase"></span>
                                    <h4>Catering Services</h4>
                                    <p>Full meal provisions for staff and personnel in field operations</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="iconbox">
                                    <span class="icon icon-briefcase"></span>
                                    <h4>Medical Support</h4>
                                    <p>Provision of emergency medical supplies and staff for health and safety assurance</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="strategy-services-3-warp desk-pdt-60">
                        <div class="title-block title-contact">
                            <h3>How Clients Benefits</h3>
                            <span class="bottom-title"></span>
                        </div>
                        <div class="statements-accordion">
                            <div class="panel-group accordion-2" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseOne">
                                                Seamless integration of logistics and life support, reducing operational
                                                stress.
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Seamless integration of logistics and life support, reducing operational stress.

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseTwo">
                                                Safe, secure, and well-maintained working environments for personnel.
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Safe, secure, and well-maintained working environments for personnel.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseThree">
                                                Focus on mission-critical tasks while we handle the rest.
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            Focus on mission-critical tasks while we handle the rest.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="sideabar">
                        <div class="widget widget-sidebar widget-list-link">
                            <h4 class="title-widget-sidebar">
                                Services
                            </h4>
                            <ul class="wd-list-link">
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('company-history') }}">History</a></li>
                                <li><a href="{{ route('service') }}">Services</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('blog') }}">Blogs</a></li>

                            </ul>
                        </div>
                        <div class="widget widget-sidebar widget-text-block">
                            <h4 class="title-widget-sidebar">
                                Company in Lines
                            </h4>
                            <div class="wd-text-warp">
                                <p>Temporibus autem quibusdam et aut officiis debitis is necessitatibus saepes eveniet ut et
                                    seo repudiandae sint et molestiae non Creating futures seon through world.</p>
                                <a href="#" class="ot-btn btn-main-color">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Download Presentation</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
