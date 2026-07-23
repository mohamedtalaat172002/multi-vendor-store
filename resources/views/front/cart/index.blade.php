@php
    use App\Helpers\Currency;
@endphp

<x-front-layout title="Cart">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="lni lni-home"></i> Home
                                </a>
                            </li>
                            <li><a href="#">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">

                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12"></div>

                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>

                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>

                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>

                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>

                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>

                @php
                    $total = 0;
                @endphp

                @forelse ($cart as $item)

                    @php
                        $subtotal = $item->quantity * $item->product->price;
                        $total += $subtotal;
                    @endphp

                    <div class="cart-single-list" id="{{ $item->id }}">
                        <div class="row align-items-center">

                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    <img src="{{ $item->product->image_url }}" alt="">
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name">
                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                        {{ $item->product->name }}
                                    </a>
                                </h5>

                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>

                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input type="number" class="form-control item-quantity" min="1"
                                        data-id="{{ $item->id }}" data-price="{{ $item->product->price }}"
                                        value="{{ $item->quantity }}">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-12">
                                <p class="item-subtotal" data-id="{{ $item->id }}">{{ Currency::format($subtotal) }}</p>
                            </div>

                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ Currency::format(0) }}</p>
                            </div>

                            <div class="col-lg-1 col-md-2 col-12">
                                <a href="javascript:void(0)" class="remove-item" data-id="{{ $item->id }}">
                                    <i class="lni lni-close"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                @empty

                    <div class="text-center py-5">
                        <h4>Your cart is empty.</h4>
                    </div>

                @endforelse

            </div>

            <div class="row">
                <div class="col-12">

                    <div class="total-amount">
                        <div class="row">

                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#">
                                            <input type="text" name="coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>
                                            Cart Subtotal
                                            <span id="cart-total">{{ Currency::format($total) }}</span>
                                        </li>

                                        <li>
                                            Shipping
                                            <span>Free</span>
                                        </li>

                                        <li>
                                            You Save
                                            <span>{{ Currency::format(0) }}</span>
                                        </li>

                                        <li class="last">
                                            You Pay
                                            <span id="cart-total-pay">{{ Currency::format($total) }}</span>
                                        </li>
                                    </ul>

                                    <div class="button">
                                        <a href="{{ route('checkout.create') }}" class="btn">Checkout</a>
                                        <a href="{{ route('home') }}" class="btn btn-alt">
                                            Continue Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush

</x-front-layout>