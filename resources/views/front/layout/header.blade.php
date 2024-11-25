<?php
use App\Models\Category;

$categories = Category::getCategories();
?>
<!--====== Main Header ======-->
<header class="header--style-1">
    <nav class="primary-nav primary-nav-wrapper--border">
        <div class="container">
            <div class="primary-nav">
                <a class="main-logo" href="/">
                    <img src="{{ asset('front/images/logo/s_logo_2.png') }}" alt="" class="img-fluid" width="180"
                        height="60">
                </a>
                <form class="main-form">
                    <label for="main-search"></label>
                    <input class="input-text input-text--border-radius input-text--style-1" type="text"
                        id="main-search" placeholder="Search">
                    <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                </form>

                <div class="menu-init" id="navigation">
                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cogs"
                        type="button"></button>
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                                <a><i class="far fa-user-circle"></i></a>
                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    <li>
                                        <a href="dashboard.html"><i class="fas fa-user-circle u-s-m-r-6"></i>
                                            <span>Account</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="signup.html"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                            <span>Signup</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="signin.html"><i class="fas fa-lock u-s-m-r-6"></i>
                                            <span>Signin</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="signup.html"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                            <span>Signout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Settings">
                                <a><i class="fas fa-user-cog"></i></a>
                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    <li class="has-dropdown has-dropdown--ul-right-100">
                                        <a>Language<i class="fas fa-angle-down u-s-m-l-6"></i></a>
                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:120px">
                                            <li>
                                                <a class="u-c-brand">ENGLISH</a>
                                            </li>
                                            <li>
                                                <a>ARABIC</a>
                                            </li>
                                            <li>
                                                <a>FRANCAIS</a>
                                            </li>
                                            <li>
                                                <a>ESPANOL</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-right-100">
                                        <a>Currency<i class="fas fa-angle-down u-s-m-l-6"></i></a>
                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:225px">
                                            <li>
                                                <a class="u-c-brand">$ - US DOLLAR</a>
                                            </li>
                                            <li>
                                                <a>£ - BRITISH POUND STERLING</a>
                                            </li>
                                            <li>
                                                <a>€ - EURO</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Contact">
                                <a href="tel:+0900901904"><i class="fas fa-phone-volume"></i></a>
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Mail">
                                <a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="secondary-nav-wrapper">
        <div class="container">
            <div class="secondary-nav">
                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation2">
                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cog"
                        type="button"></button>
                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                            <li>
                                <a href="shop-side-version-2.html">NEW ARRIVALS</a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="has-dropdown">
                                    <a href="{{ url($category['url']) }}">
                                        {{ $category['category_name'] }}
                                        <i
                                            @if (count($category['sub_categories']) > 0) class="fas fa-angle-down u-s-m-l-6" @endif></i>
                                    </a>
                                    @if (count($category['sub_categories']) > 0)
                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            @foreach ($category['sub_categories'] as $sub_category)
                                                <li class="has-dropdown has-dropdown--ul-left-100">
                                                    <a href="{{ url($sub_category['url']) }}">{{ $sub_category['category_name'] }}<i
                                                            class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>
                                                    @if (count($sub_category['sub_categories']) > 0)
                                                        <span class="js-menu-toggle"></span>
                                                        <ul style="width:200px">
                                                            @foreach ($sub_category['sub_categories'] as $sub_sub_category)
                                                                <li>
                                                                    <a
                                                                        href="{{ url($sub_sub_category['url']) }}">{{ $sub_sub_category['category_name'] }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            <li class="has-dropdown">

                                <a>PAGES<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <ul style="width:170px">
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Home<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Product Details<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="product-detail.html">Product Details</a>
                                            </li>
                                            <li>

                                                <a href="product-detail-variable.html">Product Details Variable</a>
                                            </li>
                                            <li>

                                                <a href="product-detail-affiliate.html">Product Details Affiliate</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Shop Grid Layout<i
                                                class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="shop-grid-left.html">Shop Grid Left Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="shop-grid-right.html">Shop Grid Right Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="shop-grid-full.html">Shop Grid Full Width</a>
                                            </li>
                                            <li>

                                                <a href="shop-side-version-2.html">Shop Side Version 2</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li class="has-dropdown has-dropdown--ul-left-100">

                                        <a>Shop List Layout<i
                                                class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                        <!--====== Dropdown ======-->

                                        <span class="js-menu-toggle"></span>
                                        <ul style="width:200px">
                                            <li>

                                                <a href="shop-list-left.html">Shop List Left Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="shop-list-right.html">Shop List Right Sidebar</a>
                                            </li>
                                            <li>

                                                <a href="shop-list-full.html">Shop List Full Width</a>
                                            </li>
                                        </ul>
                                        <!--====== End - Dropdown ======-->
                                    </li>
                                    <li>

                                        <a href="cart.html">Cart</a>
                                    </li>
                                    <li>

                                        <a href="wishlist.html">Wishlist</a>
                                    </li>
                                    <li>

                                        <a href="checkout.html">Checkout</a>
                                    </li>
                                    <li>

                                        <a href="faq.html">FAQ</a>
                                    </li>
                                    <li>

                                        <a href="about.html">About us</a>
                                    </li>
                                    <li>

                                        <a href="contact.html">Contact</a>
                                    </li>
                                    <li>

                                        <a href="404.html">404</a>
                                    </li>
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->


                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation3">

                    <button
                        class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop"
                        type="button"></button>

                    <span class="total-item-round">2</span>

                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">

                        <span class="ah-close">✕ Close</span>

                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li>

                                <a href="index.html"><i class="fas fa-home u-c-brand"></i></a>
                            </li>
                            <li>

                                <a href="wishlist.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li class="has-dropdown">

                                <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>

                                    <span class="total-item-round">2</span></a>

                                <!--====== Dropdown ======-->

                                <span class="js-menu-toggle"></span>
                                <div class="mini-cart">

                                    <!--====== Mini Product Container ======-->
                                    <div class="mini-product-container gl-scroll u-s-m-b-15">

                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="product-detail.html">

                                                        <img class="u-img-fluid"
                                                            src="images/product/electronic/product3.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="shop-side-version-2.html">Electronics</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="product-detail.html">Yellow Wireless
                                                            Headphone</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="product-detail.html">

                                                        <img class="u-img-fluid"
                                                            src="images/product/electronic/product18.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="shop-side-version-2.html">Electronics</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="product-detail.html">Nikon DSLR Camera 4k</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="product-detail.html">

                                                        <img class="u-img-fluid"
                                                            src="images/product/women/product8.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="shop-side-version-2.html">Women Clothing</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="product-detail.html">New Dress D Nice
                                                            Elegant</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->


                                        <!--====== Card for mini cart ======-->
                                        <div class="card-mini-product">
                                            <div class="mini-product">
                                                <div class="mini-product__image-wrapper">

                                                    <a class="mini-product__link" href="product-detail.html">

                                                        <img class="u-img-fluid" src="images/product/men/product8.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="mini-product__info-wrapper">

                                                    <span class="mini-product__category">

                                                        <a href="shop-side-version-2.html">Men Clothing</a></span>

                                                    <span class="mini-product__name">

                                                        <a href="product-detail.html">New Fashion D Nice
                                                            Elegant</a></span>

                                                    <span class="mini-product__quantity">1 x</span>

                                                    <span class="mini-product__price">$8</span>
                                                </div>
                                            </div>

                                            <a class="mini-product__delete-link far fa-trash-alt"></a>
                                        </div>
                                        <!--====== End - Card for mini cart ======-->
                                    </div>
                                    <!--====== End - Mini Product Container ======-->


                                    <!--====== Mini Product Statistics ======-->
                                    <div class="mini-product-stat">
                                        <div class="mini-total">

                                            <span class="subtotal-text">SUBTOTAL</span>

                                            <span class="subtotal-value">$16</span>
                                        </div>
                                        <div class="mini-action">

                                            <a class="mini-link btn--e-brand-b-2" href="checkout.html">PROCEED TO
                                                CHECKOUT</a>

                                            <a class="mini-link btn--e-transparent-secondary-b-2"
                                                href="cart.html">VIEW CART</a>
                                        </div>
                                    </div>
                                    <!--====== End - Mini Product Statistics ======-->
                                </div>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Secondary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 2 ======-->
</header>
<!--====== End - Main Header ======-->
