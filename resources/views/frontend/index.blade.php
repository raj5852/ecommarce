@extends('layouts.app')
@section('title', 'Home page')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == '0' ? 'active' : '' }} ">
                    <img src="{{ asset("$slider->image") }}" class="d-block w-100" alt="...">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{$slider->title}}</h5>
                        <p>{{$slider->description}}</p>
                    </div> --}}
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {!! $slider->title !!}
                            </h1>
                            <p>
                                {!! $slider->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcome to Ecommerce</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Welcome to our online store! We're excited to offer you a seamless shopping experience with our extensive range of products and user-friendly platform <br>

                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline"></div>
                </div>
                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">

                            @foreach ($trendingProducts as $productItem)
                                <div class="item">
                                    <div class="product-card" style="min-height: 380px;">
                                        <div class="product-card-img">
                                            <label class="stock bg-danger">New</label>
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">

                                                    <img src="/{{ $productItem->productImages[0]->image }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">{{ $productItem->selling_price }} </span>
                                                <span class="original-price">{{ $productItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Products Available </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="py-5 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>New Arrivals
                    <a href="{{ url('new-arrivals') }}" class="btn btn-warning float-end">View More</a>

                    </h4>
                    <div class="underline"></div>
                </div>
                @if ($newArrivalProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">

                            @foreach ($newArrivalProducts as $productItem)
                                <div class="item">
                                    <div class="product-card" style="min-height: 380px;">
                                        <div class="product-card-img">
                                            <label class="stock bg-danger">New</label>
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">

                                                    <img src="/{{ $productItem->productImages[0]->image }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">{{ $productItem->selling_price }} </span>
                                                <span class="original-price">{{ $productItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No New Arrivals Products Available </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Featured Products
                    <a href="{{ url('featured-products') }}" class="btn btn-warning float-end">View More</a>
                    </h4>
                    <div class="underline"></div>
                </div>
                @if ($featuredProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">

                            @foreach ($featuredProducts as $productItem)
                                <div class="item">
                                    <div class="product-card" style="min-height: 380px;" >
                                        <div class="product-card-img">
                                            <label class="stock bg-danger">New</label>
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">

                                                    <img src="/{{ $productItem->productImages[0]->image }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('collections/' . $productItem->categories->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">{{ $productItem->selling_price }} </span>
                                                <span class="original-price">{{ $productItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Featured Products Available </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots:true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection
