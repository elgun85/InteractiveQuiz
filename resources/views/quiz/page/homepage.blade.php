@extends('quiz.layout.master')
@section('title','Home page ')
@section('content')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>@yield('title')</h2>
                    <ol>
                        <li><a href="{{route('home')}}">Home</a></li>

                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Services Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container">

                <div class="row">
                    @forelse($categories as $categoryItem)
                        <div class="col-lg-6 mt-3">
                            <div class="testimonial-item mt-4 mt-lg-0">
                                <h4 class="text-center" style="font-size: 28px; ">
                                    <a href="#" class="text-body custom-hover">
                                        {{ \Illuminate\Support\Str::limit($categoryItem->title, 50) }}
                                    </a>
                                    <style>
                                        .custom-hover:hover {
                                            color: red !important; /* Rəngi qırmızı olaraq təyin edir */
                                        }
                                    </style>
                                </h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {{\Illuminate\Support\Str::limit($categoryItem->description,130)}}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>

                    @empty
                        <h3> Not data</h3>
                    @endforelse
                </div>

            </div>
        </section>
        <!-- End Services Section -->

    </main>

@endsection


