@extends('front.layout.layout')
@section('content')
    <div class="app-content">

        <!--====== Section 1 ======-->
        <div class="u-s-p-y-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        @include('front.products.filters')
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="shop-p">
                            <div class="shop-p__toolbar u-s-m-b-30">
                                <div class="shop-p__meta-wrap u-s-m-b-60">

                                    <span class="shop-p__meta-text-1">FOUND 18 RESULTS</span>
                                    <div class="shop-p__meta-text-2">

                                        <span>Related Searches:</span>

                                        <a class="gl-tag btn--e-brand-shadow" href="#">men's clothing</a>

                                        <a class="gl-tag btn--e-brand-shadow" href="#">mobiles & tablets</a>

                                        <a class="gl-tag btn--e-brand-shadow" href="#">books & audible</a>
                                    </div>
                                </div>
                                <div class="shop-p__tool-style">
                                    <div class="tool-style__group u-s-m-b-8">

                                        <span class="js-shop-grid-target">Grid</span>

                                        <span class="js-shop-list-target is-active">List</span>
                                    </div>
                                    <form>
                                        <div class="tool-style__form-wrap">
                                            <div class="u-s-m-b-8"><select class="select-box select-box--transparent-b-2">
                                                    <option>Show: 8</option>
                                                    <option selected>Show: 12</option>
                                                    <option>Show: 16</option>
                                                    <option>Show: 28</option>
                                                </select></div>
                                            <div class="u-s-m-b-8"><select class="select-box select-box--transparent-b-2">
                                                    <option selected>Sort By: Newest Items</option>
                                                    <option>Sort By: Latest Items</option>
                                                    <option>Sort By: Best Selling</option>
                                                    <option>Sort By: Best Rating</option>
                                                    <option>Sort By: Lowest Price</option>
                                                    <option>Sort By: Highest Price</option>
                                                </select></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="shop-p__collection">
                                <div class="row is-list-active">
                                    @include('front.products.ajax_products_lising')
                                </div>
                            </div>
                            <div class="u-s-p-y-60">

                                <!--====== Pagination ======-->
                                <ul class="shop-p__pagination">
                                    <li class="is-active">

                                        <a href="shop-list-left.html">1</a>
                                    </li>
                                    <li>

                                        <a href="shop-list-left.html">2</a>
                                    </li>
                                    <li>

                                        <a href="shop-list-left.html">3</a>
                                    </li>
                                    <li>

                                        <a href="shop-list-left.html">4</a>
                                    </li>
                                    <li>

                                        <a class="fas fa-angle-right" href="shop-list-left.html"></a>
                                    </li>
                                </ul>
                                <!--====== End - Pagination ======-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section 1 ======-->
    </div>
@endsection
