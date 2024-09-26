@extends('quiz.layout.master')
@section('title','Category')
@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>@yield('title')</h2>
                    <ol>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>@yield('title')</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="row">
<livewire:admin.category />



                </div>

            </div>
        </section>


        <!-- ======= Features Section ======= -->

    </main>


@endsection


