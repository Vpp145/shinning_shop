@extends('front.layout.layout')
@section('content')
    <!--====== App Content ======-->
    <div class="app-content">
        <!--====== Primary Slider ======-->
        <div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey">
            <div class="owl-carousel primary-style-1" id="hero-slider">
                @foreach ($home_banners as $sidebar_banner)
                    <div class="hero-slide hero-slide--1"
                        style="background-image: url('{{ asset('front/images/banners/' . $sidebar_banner['image']) }}');"
                        alt='{{ $sidebar_banner['alt'] }}'>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="slider-content slider-content--animation">
                                        <span class="content-span-2 u-c-secondary">{{ $sidebar_banner['title'] }}</span>
                                        <a class="shop-now-link btn--e-brand" href="{{ $sidebar_banner['link'] }}">SHOP
                                            NOW
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--====== End - Primary Slider ======-->

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">SHOP BY DEALS</h1>
                                <span class="section__span u-c-silver">BROWSE FAVOURITE DEALS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        @foreach ($home_fix_banners as $slider_banner)
                            @if (isset($slider_banner['image']))
                                <div class="col-lg-6 col-md-6 u-s-m-b-30">
                                    <a class="collection" href="{{ $slider_banner['link'] }}"
                                        title="{{ $slider_banner['title'] }}">
                                        <div class="aspect aspect--bg-grey aspect--square">
                                            <img class="aspect__img collection__img img-fluid"
                                                src="{{ asset('front/images/banners/' . $slider_banner['image']) }}"
                                                alt="{{ $slider_banner['alt'] }}">
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!--====== Section Content ======-->
        </div>
        <!--====== End - Section 1 ======-->

        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-16">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">TOP TRENDING</h1>
                                <span class="section__span u-c-silver">CHOOSE CATEGORY</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-category-container">
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1 js-checked" type="button"
                                        data-filter="*">ALL</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button"
                                        data-filter=".newarrivals">NEW ARRIVALS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button"
                                        data-filter=".bestsellers">BEST SELLERS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button"
                                        data-filter=".discountedproducts">DISCOUNTED PRODUCTS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button"
                                        data-filter=".featuredproducts">FEATURED PRODUCTS</button>
                                </div>
                            </div>
                            <div class="filter__grid-wrapper u-s-m-t-30">
                                <div class="row">
                                    @php
                                        // Combine the two collections, and add a key to differentiate them if needed
                                        $combinedProducts = collect($new_products)
                                            ->map(function ($product) {
                                                $product['type'] = 'newarrivals';
                                                return $product;
                                            })
                                            ->merge(
                                                collect($best_sellers)->map(function ($product) {
                                                    $product['type'] = 'bestsellers';
                                                    return $product;
                                                }),
                                            );
                                    @endphp

                                    @foreach ($combinedProducts as $product)
                                        <div
                                            class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item {{ $product['type'] }}">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block"
                                                        href="product-detail.html">
                                                        @if (isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                                                            <img class="aspect__img"
                                                                src="{{ asset('front/images/products/small/' . $product['images'][0]['image']) }}"
                                                                alt="">
                                                        @else
                                                            <img class="aspect__img"
                                                                src="images/product/electronic/product1.jpg" alt="">
                                                        @endif
                                                    </a>
                                                </div>
                                                <span class="product-o__category">
                                                    <a
                                                        href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a>
                                                </span>
                                                <span class="product-o__name">
                                                    <a href="product-detail.html">{{ $product['product_name'] }}</a>
                                                </span>
                                                <div class="product-o__rating gl-rating-style">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span class="product-o__review">(25)</span>
                                                </div>
                                                <span class="product-o__price">₹{{ $product['final_price'] }}
                                                    @if ($product['discount_type'] != '')
                                                        <span
                                                            class="product-o__discount">₹{{ $product['product_price'] }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 2 ======-->

        <!--====== Section 6 ======-->
        <div class="u-s-p-y-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">FEATURED PRODUCTS</h1>

                                <span class="section__span u-c-silver">FIND NEW FEATURED PRODUCTS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                            <div class="product-o product-o--hover-on u-h-100">
                                <div class="product-o__wrap">

                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                        <img class="aspect__img" src="images/product/electronic/product19.jpg"
                                            alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                    data-placement="top" title="Quick View"><i
                                                        class="fas fa-search-plus"></i></a>
                                            </li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Email me When the price drops"><i
                                                        class="fas fa-envelope"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">

                                    <a href="shop-side-version-2.html">Electronics</a></span>

                                <span class="product-o__name">

                                    <a href="product-detail.html">Tablet 14inch Screen</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star-half-alt"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">$125.00

                                    <span class="product-o__discount">$160.00</span></span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                            <div class="product-o product-o--hover-on u-h-100">
                                <div class="product-o__wrap">

                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                        <img class="aspect__img" src="images/product/electronic/product20.jpg"
                                            alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                    data-placement="top" title="Quick View"><i
                                                        class="fas fa-search-plus"></i></a>
                                            </li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Email me When the price drops"><i
                                                        class="fas fa-envelope"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">

                                    <a href="shop-side-version-2.html">Electronics</a></span>

                                <span class="product-o__name">

                                    <a href="product-detail.html">Tablet 18inch Screen</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star-half-alt"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">$125.00

                                    <span class="product-o__discount">$160.00</span></span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                            <div class="product-o product-o--hover-on u-h-100">
                                <div class="product-o__wrap">

                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                        <img class="aspect__img" src="images/product/electronic/product21.jpg"
                                            alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                    data-placement="top" title="Quick View"><i
                                                        class="fas fa-search-plus"></i></a>
                                            </li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Email me When the price drops"><i
                                                        class="fas fa-envelope"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">

                                    <a href="shop-side-version-2.html">Electronics</a></span>

                                <span class="product-o__name">

                                    <a href="product-detail.html">Tablet 13inch Screen Ram 16GB</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star-half-alt"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">$125.00

                                    <span class="product-o__discount">$160.00</span></span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                            <div class="product-o product-o--hover-on u-h-100">
                                <div class="product-o__wrap">

                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">

                                        <img class="aspect__img" src="images/product/electronic/product22.jpg"
                                            alt=""></a>
                                    <div class="product-o__action-wrap">
                                        <ul class="product-o__action-list">
                                            <li>

                                                <a data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip"
                                                    data-placement="top" title="Quick View"><i
                                                        class="fas fa-search-plus"></i></a>
                                            </li>
                                            <li>

                                                <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Add to Wishlist"><i class="fas fa-heart"></i></a>
                                            </li>
                                            <li>

                                                <a href="signin.html" data-tooltip="tooltip" data-placement="top"
                                                    title="Email me When the price drops"><i
                                                        class="fas fa-envelope"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <span class="product-o__category">

                                    <a href="shop-side-version-2.html">Electronics</a></span>

                                <span class="product-o__name">

                                    <a href="product-detail.html">Tablet 12inch Screen Ram 16GB</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star-half-alt"></i>

                                    <span class="product-o__review">(23)</span>
                                </div>

                                <span class="product-o__price">$125.00

                                    <span class="product-o__discount">$160.00</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 6 ======-->


        <!--====== Section 9 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon"><i class="fas fa-truck"></i></div>
                                <div class="service__info-wrap">

                                    <span class="service__info-text-1">Free Shipping</span>

                                    <span class="service__info-text-2">Free shipping on all US order or order
                                        above $200</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon"><i class="fas fa-redo"></i></div>
                                <div class="service__info-wrap">

                                    <span class="service__info-text-1">Shop with Confidence</span>

                                    <span class="service__info-text-2">Our Protection covers your purchase from
                                        click to delivery</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="service u-h-100">
                                <div class="service__icon"><i class="fas fa-headphones-alt"></i></div>
                                <div class="service__info-wrap">

                                    <span class="service__info-text-1">24/7 Help Center</span>

                                    <span class="service__info-text-2">Round-the-clock assistance for a smooth
                                        shopping experience</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 9 ======-->


        <!--====== Section 10 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">LATEST FROM BLOG</h1>

                                <span class="section__span u-c-silver">START YOU DAY WITH FRESH AND LATEST
                                    NEWS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->


            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="bp-mini bp-mini--img u-h-100">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">

                                        <img class="aspect__img" src="images/blog/post-2.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a>

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="blog-detail.html"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a>Learning</a>

                                        <a>News</a>

                                        <a>Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="blog-detail.html">Life is an extraordinary Adventure</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="bp-mini bp-mini--img u-h-100">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">

                                        <img class="aspect__img" src="images/blog/post-12.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a>

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="blog-detail.html"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a>Learning</a>

                                        <a>News</a>

                                        <a>Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="blog-detail.html">Wait till its open</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 u-s-m-b-30">
                            <div class="bp-mini bp-mini--img u-h-100">
                                <div class="bp-mini__thumbnail">

                                    <!--====== Image Code ======-->

                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">

                                        <img class="aspect__img" src="images/blog/post-5.jpg" alt=""></a>
                                    <!--====== End - Image Code ======-->
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__publish-date">

                                                <a>

                                                    <span>25 February 2018</span></a></span></span>

                                        <span class="bp-mini__stat-wrap">

                                            <span class="bp-mini__preposition">By</span>

                                            <span class="bp-mini__author">

                                                <a href="#">Dayle</a></span></span>

                                        <span class="bp-mini__stat">

                                            <span class="bp-mini__comment">

                                                <a href="blog-detail.html"><i class="far fa-comments u-s-m-r-4"></i>

                                                    <span>8</span></a></span></span>
                                    </div>
                                    <div class="bp-mini__category">

                                        <a>Learning</a>

                                        <a>News</a>

                                        <a>Health</a>
                                    </div>

                                    <span class="bp-mini__h1">

                                        <a href="blog-detail.html">Tell me difference between smoke and
                                            vape</a></span>
                                    <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry.</p>
                                    <div class="blog-t-w">

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Travel</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Culture</a>

                                        <a class="gl-tag btn--e-transparent-hover-brand-b-2">Place</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 10 ======-->
    </div>
    <!--====== End - App Content ======-->
@endsection
