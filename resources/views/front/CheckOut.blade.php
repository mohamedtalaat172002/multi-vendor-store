@php
    use App\Helpers\Currency;
@endphp

<x-front-layout title="Checkout">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Checkout</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <section class="checkout-wrapper section">
        <div class="container">

            {{-- Session / validation errors --}}
            @if (session('error'))
                <div class="alert alert-danger mb-4">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row justify-content-center">

                {{-- ===== Left: checkout steps form ===== --}}
                <div class="col-lg-8">
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf

                        <div class="checkout-steps-form-style-1">
                            <ul id="accordionExample">

                                {{-- ---- Step 1: Billing details ---- --}}
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseBilling"
                                        aria-expanded="true" aria-controls="collapseBilling">
                                        <i class="lni lni-user me-2"></i> Billing Details
                                    </h6>

                                    <section class="checkout-steps-form-content collapse show" id="collapseBilling"
                                        data-bs-parent="#accordionExample">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][first_name]">First Name</label>
                                                    <x-form.input name="addr[billing][first_name]"
                                                        placeholder="First Name" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][last_name]">Last Name</label>
                                                    <x-form.input name="addr[billing][last_name]"
                                                        placeholder="Last Name" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][email]">Email Address</label>
                                                    <x-form.input name="addr[billing][email]" type="email"
                                                        placeholder="Email Address" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][phone_number]">Phone Number</label>
                                                    <x-form.input name="addr[billing][phone_number]" type="tel"
                                                        placeholder="Phone Number" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][street_address]">Street Address</label>
                                                    <x-form.input name="addr[billing][street_address]"
                                                        placeholder="Street Address" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][city]">City</label>
                                                    <x-form.input name="addr[billing][city]" placeholder="City" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][postal_code]">Post Code</label>
                                                    <x-form.input name="addr[billing][postal_code]"
                                                        placeholder="Post Code" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][state]">Region / State</label>
                                                    <x-form.input name="addr[billing][state]" placeholder="State" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[billing][country]">Country</label>
                                                    <select name="addr[billing][country]" id="addr[billing][country]"
                                                        class="form-control @error('addr.billing.country') is-invalid @enderror">
                                                        <option value="">— Select Country —</option>
                                                        <option value="US" {{ old('addr.billing.country') === 'US' ? 'selected' : '' }}>United States</option>
                                                        <option value="GB" {{ old('addr.billing.country') === 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                                        <option value="CA" {{ old('addr.billing.country') === 'CA' ? 'selected' : '' }}>Canada</option>
                                                        <option value="AU" {{ old('addr.billing.country') === 'AU' ? 'selected' : '' }}>Australia</option>
                                                        <option value="DE" {{ old('addr.billing.country') === 'DE' ? 'selected' : '' }}>Germany</option>
                                                        <option value="FR" {{ old('addr.billing.country') === 'FR' ? 'selected' : '' }}>France</option>
                                                        <option value="SA" {{ old('addr.billing.country') === 'SA' ? 'selected' : '' }}>Saudi Arabia</option>
                                                        <option value="AE" {{ old('addr.billing.country') === 'AE' ? 'selected' : '' }}>UAE</option>
                                                        <option value="EG" {{ old('addr.billing.country') === 'EG' ? 'selected' : '' }}>Egypt</option>
                                                        <option value="TR" {{ old('addr.billing.country') === 'TR' ? 'selected' : '' }}>Turkey</option>
                                                    </select>
                                                    @error('addr.billing.country')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" id="same-address" name="same_address"
                                                        value="1">
                                                    <label for="same-address"><span></span></label>
                                                    <p>My shipping and billing address are the same.</p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseShipping" aria-expanded="false"
                                                        aria-controls="collapseShipping">
                                                        Next Step <i class="lni lni-chevron-right ms-1"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                </li>

                                {{-- ---- Step 2: Shipping address ---- --}}
                                <li id="shipping-step">
                                    <h6 class="title collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseShipping" aria-expanded="false"
                                        aria-controls="collapseShipping">
                                        <i class="lni lni-delivery me-2"></i> Shipping Address
                                    </h6>

                                    <section class="checkout-steps-form-content collapse" id="collapseShipping"
                                        data-bs-parent="#accordionExample">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][first_name]">First Name</label>
                                                    <x-form.input name="addr[shipping][first_name]"
                                                        placeholder="First Name" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][last_name]">Last Name</label>
                                                    <x-form.input name="addr[shipping][last_name]"
                                                        placeholder="Last Name" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][email]">Email Address</label>
                                                    <x-form.input name="addr[shipping][email]" type="email"
                                                        placeholder="Email Address" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][phone_number]">Phone Number</label>
                                                    <x-form.input name="addr[shipping][phone_number]" type="tel"
                                                        placeholder="Phone Number" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][street_address]">Street Address</label>
                                                    <x-form.input name="addr[shipping][street_address]"
                                                        placeholder="Street Address" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][city]">City</label>
                                                    <x-form.input name="addr[shipping][city]" placeholder="City" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][postal_code]">Post Code</label>
                                                    <x-form.input name="addr[shipping][postal_code]"
                                                        placeholder="Post Code" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][state]">Region / State</label>
                                                    <x-form.input name="addr[shipping][state]" placeholder="State" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label for="addr[shipping][country]">Country</label>
                                                    <select name="addr[shipping][country]" id="addr[shipping][country]"
                                                        class="form-control @error('addr.shipping.country') is-invalid @enderror">
                                                        <option value="">— Select Country —</option>
                                                        <option value="US" {{ old('addr.shipping.country') === 'US' ? 'selected' : '' }}>United States</option>
                                                        <option value="GB" {{ old('addr.shipping.country') === 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                                        <option value="CA" {{ old('addr.shipping.country') === 'CA' ? 'selected' : '' }}>Canada</option>
                                                        <option value="AU" {{ old('addr.shipping.country') === 'AU' ? 'selected' : '' }}>Australia</option>
                                                        <option value="DE" {{ old('addr.shipping.country') === 'DE' ? 'selected' : '' }}>Germany</option>
                                                        <option value="FR" {{ old('addr.shipping.country') === 'FR' ? 'selected' : '' }}>France</option>
                                                        <option value="SA" {{ old('addr.shipping.country') === 'SA' ? 'selected' : '' }}>Saudi Arabia</option>
                                                        <option value="AE" {{ old('addr.shipping.country') === 'AE' ? 'selected' : '' }}>UAE</option>
                                                        <option value="EG" {{ old('addr.shipping.country') === 'EG' ? 'selected' : '' }}>Egypt</option>
                                                        <option value="TR" {{ old('addr.shipping.country') === 'TR' ? 'selected' : '' }}>Turkey</option>
                                                    </select>
                                                    @error('addr.shipping.country')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Delivery option --}}
                                            <div class="col-md-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="heading-6 font-weight-400 payment-title">
                                                        Select Delivery Option
                                                    </h6>
                                                    <div class="payment-option-wrapper">

                                                        <div class="single-payment-option">
                                                            <input type="radio" name="delivery_option" value="standard"
                                                                id="delivery-standard" checked>
                                                            <label for="delivery-standard">
                                                                <i class="lni lni-delivery" style="font-size:24px;"></i>
                                                                <p>Standard Shipping</p>
                                                                <span class="price">Free</span>
                                                            </label>
                                                        </div>

                                                        <div class="single-payment-option">
                                                            <input type="radio" name="delivery_option" value="express"
                                                                id="delivery-express">
                                                            <label for="delivery-express">
                                                                <i class="lni lni-plane" style="font-size:24px;"></i>
                                                                <p>Express Shipping</p>
                                                                <span class="price">$9.99</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseBilling" aria-expanded="false">
                                                        <i class="lni lni-chevron-left me-1"></i> Previous
                                                    </button>
                                                    <button type="button" class="btn btn-alt" data-bs-toggle="collapse"
                                                        data-bs-target="#collapsePayment" aria-expanded="false">
                                                        Next Step <i class="lni lni-chevron-right ms-1"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                </li>

                                {{-- ---- Step 3: Payment ---- --}}
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePayment" aria-expanded="false"
                                        aria-controls="collapsePayment">
                                        <i class="lni lni-credit-cards me-2"></i> Payment
                                    </h6>

                                    <section class="checkout-steps-form-content collapse" id="collapsePayment"
                                        data-bs-parent="#accordionExample">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="payment-title">Select Payment Method</h6>
                                                    <div class="payment-option-wrapper">

                                                        <div class="single-payment-option">
                                                            <input type="radio" name="payment_method" value="cod"
                                                                id="pay-cod" checked>
                                                            <label for="pay-cod">
                                                                <i class="lni lni-money-location"
                                                                    style="font-size:24px;"></i>
                                                                <p>Cash on Delivery</p>
                                                            </label>
                                                        </div>

                                                        <div class="single-payment-option">
                                                            <input type="radio" name="payment_method" value="card"
                                                                id="pay-card">
                                                            <label for="pay-card">
                                                                <i class="lni lni-credit-cards"
                                                                    style="font-size:24px;"></i>
                                                                <p>Credit / Debit Card</p>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="checkout-payment-form">
                                                    <div class="row g-3">
                                                        <div class="col-md-12">
                                                            <div class="single-form form-default">
                                                                <label>Name on Card</label>
                                                                <x-form.input name="card_name"
                                                                    placeholder="Name on Card" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-form form-default">
                                                                <label>Card Number</label>
                                                                <x-form.input name="card_number"
                                                                    placeholder="•••• •••• •••• ••••" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-form form-default">
                                                                <label>Expiry Date</label>
                                                                <x-form.input name="card_expiry"
                                                                    placeholder="MM / YY" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-form form-default">
                                                                <label>CVV</label>
                                                                <x-form.input name="card_cvv" placeholder="•••" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button type="button" class="btn" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseShipping" aria-expanded="false">
                                                        <i class="lni lni-chevron-left me-1"></i> Previous
                                                    </button>
                                                    <button href="{{ route('checkout.store') }}" type="submit"
                                                        class="btn">
                                                        <i class="lni lni-lock-alt me-1"></i> Place Order
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                </li>

                            </ul>
                        </div>
                    </form>
                </div>

                {{-- ===== Right: order summary sidebar ===== --}}
                <div class="col-lg-4">
                    <div class="checkout-sidebar">

                        {{-- Coupon --}}
                        <div class="checkout-sidebar-coupon">
                            <p>Apply a coupon to get a discount!</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" class="form-control" placeholder="Coupon Code">
                                    </div>
                                    <div class="button">
                                        <button type="button" class="btn">Apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Order items --}}
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">Order Summary</h5>

                            <ul class="list-unstyled mb-3">
                                @foreach ($cart->get() as $item)
                                    <li class="d-flex justify-content-between align-items-center py-2"
                                        style="border-bottom: 1px solid #eee;">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                style="width:48px;height:48px;object-fit:cover;border-radius:4px;">
                                            <div>
                                                <p class="mb-0" style="font-size:13px;font-weight:600;">
                                                    {{ $item->product->name }}
                                                </p>
                                                <p class="mb-0 text-muted" style="font-size:12px;">
                                                    Qty: {{ $item->quantity }}
                                                </p>
                                            </div>
                                        </div>
                                        <span style="font-weight:600;">
                                            {{ Currency::format($item->product->price * $item->quantity) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">Subtotal:</p>
                                    <p class="price">{{ Currency::format($cart->total()) }}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">Shipping:</p>
                                    <p class="price">Free</p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">Discount:</p>
                                    <p class="price">{{ Currency::format(0) }}</p>
                                </div>
                            </div>

                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Total:</p>
                                    <p class="price">{{ Currency::format($cart->total()) }}</p>
                                </div>
                            </div>

                            <div class="price-table-btn button mt-3">
                                <a href="{{ route('cart.index') }}" class="btn btn-alt w-100">
                                    <i class="lni lni-cart me-1"></i> Edit Cart
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Mirror billing → shipping when "same address" is checked
            document.getElementById('same-address').addEventListener('change', function () {
                const fields = ['first_name', 'last_name', 'email', 'phone_number',
                    'street_address', 'city', 'postal_code', 'state', 'country'];
                if (this.checked) {
                    fields.forEach(function (field) {
                        var src = document.querySelector('[name="addr[billing][' + field + ']"]');
                        var dst = document.querySelector('[name="addr[shipping][' + field + ']"]');
                        if (src && dst) dst.value = src.value;
                    });
                }
            });

            // Show/hide card fields based on payment method selection
            document.querySelectorAll('[name="payment_method"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    var cardFields = document.querySelector('.checkout-payment-form');
                    cardFields.style.display = (this.value === 'card') ? 'block' : 'none';
                });
            });
            // Hide card fields by default (COD selected)
            document.querySelector('.checkout-payment-form').style.display = 'none';
        </script>
    @endpush

</x-front-layout>