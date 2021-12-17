@extends('layouts.master_home')

@section('home_content')
<?php $page = 'portfolio'; ?>
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Portfolio</h2>
            <ol>
                <li><a href="{{ route('homepage') }}">Home</a></li>
                <li>Portfolio</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container">

        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">

            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
            @php($i = $j = 1)
            @foreach ($multipics as $multipic)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <img src="{{ $multipic->image }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                    <h4>{{ Carbon\Carbon::parse($multipic->created_at)->diffForHumans() }}</h4>
                    <p>Project {{ $i++ }}</p>
                    <a href="{{ $multipic->image }}" data-gall="portfolioGallery" class="venobox preview-link" title="Project {{ $j++ }}"><i class="bx bx-plus"></i></a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
<!-- End Portfolio Section -
@endsection