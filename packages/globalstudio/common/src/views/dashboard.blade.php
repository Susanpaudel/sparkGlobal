@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Dashboard
@endsection
@php
    $users = \DB::table('users');
   
    // $events = \DB::table('events');
@endphp
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">

                        <div class="inner">
                            <h3>{{ $users->count() }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-users"></i>
                        </div>
                        <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $events->count() }}</h3>
                            <p>Events</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.event.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}


                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Blogs</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Advertisements</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            <div class="row">
                @if (count(app('App\Helpers\Helper')->getBlogs()) > 0)
                    <div class=" col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Blogs</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach (app('App\Helpers\Helper')->getBlogs(5) as $blog)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ asset($blog->image) }}" alt="" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#"
                                                    class="product-title">{{ $blog->title }}
                                                    <span class=" float-right">
                                                    </span></a>
                                                <span class="product-description">
                                                    {{ \Carbon\Carbon::parse($blog->created_at) }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('admin.blog.index') }}" class="uppercase">View All Blogs</a>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- @if (count(app('App\Helpers\Helper')->getPopularVisas()) > 0)
                    <div class=" col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Popular Visas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Visa</th>
                                                <th>Enrolled</th>
                                                <th>Total Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (app('App\Helpers\Helper')->getPopularVisas(5) as $index => $visa)
                                                <tr>
                                                    <td> {{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $visa->name }}
                                                    </td>
                                                    <td>{{ $visa->enrolled }}
                                                    </td>
                                                    <td>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            {{ $visa->views }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ route('admin.visa.index') }}" class="uppercase">View All Visa</a>
                            </div>

                        </div>

                    </div>
                @endif
                @if (count(app('App\Helpers\Helper')->getPopularCourses()) > 0)
                    <div class=" col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Popular Courses</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Course</th>
                                                <th>Enrolled</th>
                                                <th>Total Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (app('App\Helpers\Helper')->getPopularCourses(5) as $index => $course)
                                                <tr>
                                                    <td> {{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $course->name }}
                                                    </td>
                                                    <td>{{ $course->enrolled }}
                                                    </td>
                                                    <td>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            {{ $course->views }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ route('admin.course.index') }}" class="uppercase">View All Courses</a>
                            </div>

                        </div>

                    </div>
                @endif
                @if (count(app('App\Helpers\Helper')->getPopularDestinations()) > 0)
                    <div class=" col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Popular Destinations</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Destination</th>
                                                <th>Enrolled</th>
                                                <th>Total Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (app('App\Helpers\Helper')->getDestinations(5) as $index => $destination)
                                                <tr>
                                                    <td> {{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $destination->name }}
                                                    </td>
                                                    <td><span class="badge badge-info">{{ $destination->enrolled }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            {{ $destination->views }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ route('admin.destination.index') }}" class="uppercase">View All
                                    Destinations</a>
                            </div>

                        </div>

                    </div>
                @endif --}}

            </div>
        </div>
    </div>
@endsection
