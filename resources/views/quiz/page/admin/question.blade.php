@extends('quiz.layout.master')

@section('title', $slug)

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 style="text-transform: capitalize;">@yield('title')</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li style="text-transform: capitalize;">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </section>

        <section id="services" class="services">
            <div class="container">
                <div class="row">
                   {{-- <livewire:admin.quiz :id="$categoryId" :slug="$slug" />--}}
                </div>
            </div>
        </section>
    </main>
@endsection
