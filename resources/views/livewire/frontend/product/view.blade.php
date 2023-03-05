<div>

    <div class="py-3 py-md-5">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3" >
                    <div class="bg-white border" wire:ignore >
                        @if ($product->productImages)
                            <div class="exzoom" id="exzoom">
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->productImages as $itemImg)
                                            <li><img style="max-width: 449px" src="{{ asset($itemImg->image) }}" /></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Images
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->categories->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }} </span>
                            <span class="original-price">${{ $product->original_price }} </span>
                        </div>
                        @if ($product->productColors->count() > 0)

                            @if ($product->productColors)
                                @foreach ($product->productColors as $colorItem)
                                    <label class="colorSelectionLabel" style="background: {{ $colorItem->color->name }}"
                                        wire:click="colorSelected({{ $colorItem->id }})">
                                        {{ $colorItem->color->name }}
                                    </label>
                                @endforeach
                            @endif
                            <div>

                                @if ($this->productColorSlectedQuantity == 'outOfStock')
                                    <label class="btn-sm py-1 text-white bg-danger">Out of Stock</label>
                                @elseif ($this->productColorSlectedQuantity > 0)
                                    <label class="btn-sm py-1 text-white bg-success">In Stock</label>
                                @endif
                            </div>
                        @else
                            @if ($product->quantity)
                                <label class="btn-sm py-1 text-white bg-success">In Stock</label>
                            @else
                                <label class="btn-sm py-1 text-white bg-danger">Out of Stock</label>
                            @endif

                        @endif


                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input readonly type="text" value="{{ $quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn1" wire:click="addToCard({{ $product->id }})">

                                <i class="fa fa-shopping-cart"></i> Add To Cart

                            </button>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                                <span >
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>

                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related
                        @if ($category)
                            {{ $category->name }}
                        @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">

                        @if ($category)
                            @foreach ($category->products->take(10) as $productItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
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
                        @else
                            <div class="p-2">
                                <h4>No Products Available </h4>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related
                        @if ($product)
                            {{ $product->brand }}
                        @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">

                        @if ($product)
                            @forelse ($category->products->take(10) as $productItem)
                                @if ($productItem->brand == "$product->brand")
                                    <div class="item">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                {{ $productItem->brand }}
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
                                                    <span class="selling-price">{{ $productItem->selling_price }}
                                                    </span>
                                                    <span
                                                        class="original-price">{{ $productItem->original_price }}</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endif


                            @endforeach
                        @else
                            <div class="col-md-12 p-2">
                                <h4>No Products Available </h4>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({

                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                "autoPlay": false,

                "autoPlayTimeout": 2000

            });

        });

        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
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
@endpush
