@extends('layouts.front')

@section('title')
   Checkout
@endsection

@section('main-content position-relative max-height-vh-100 h-100 border-radius-lg')
{{--    <div class="py-3 mb-4 shadow-sm bg-warning border-top">--}}
{{--        <div class="container">--}}
{{--            <h6 class="mb-0">--}}
{{--                <a href="{{ url('/') }}">--}}
{{--                    Home--}}
{{--                </a> /--}}
{{--                <a href="{{ url('checkout') }}">--}}
{{--                    Checkout--}}
{{--                </a>--}}
{{--            </h6>--}}
{{--        </div>--}}
{{--    </div>--}}

   <div class="container mt-3">
       <form action="{{ url('place-order') }}" method="POST">
           @csrf
       <div class="row">
           <div class="col-md-7">
               <div class="card">
                   <div class="card-body">
                       <h6>Basic Details</h6>
                       <hr>
                       <div class="row checkout-form">
                           <div class="col-md-6">
                               <label for="">First Name</label>
                               <input type="text" required class="form-control firstname" value="{{ Auth::user()->name }}" name="fname" placeholder="Enter First Name">
                               <span id="fname_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6">
                               <label for="">Last Name</label>
                               <input type="text" required class="form-control lastname" value="{{ Auth::user()->lname }}" name="lname" placeholder="Enter Last Name">
                               <span id="lname_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">Email</label>
                               <input type="text" required class="form-control email" value="{{ Auth::user()->email }}" name="email" placeholder="Enter Email">
                               <span id="email_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">Phone Number</label>
                               <input type="text" required class="form-control phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Enter Phone Number">
                               <span id="phone_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">Address 1</label>
                               <input type="text" required class="form-control address1" value="{{ Auth::user()->address1 }}" name="address1" placeholder="Enter Address 1">
                               <span id="address1_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">Address 2</label>
                               <input type="text" required class="form-control address2"  value="{{ Auth::user()->address2 }}"  name="address2" placeholder="Enter Address 2">
                               <span id="address2_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">City</label>
                               <input type="text" required class="form-control city"  value="{{ Auth::user()->city }}" name="city" placeholder="Enter City">
                               <span id="city_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">State</label>
                               <input type="text" required class="form-control state"  value="{{ Auth::user()->state }}"  name="state" placeholder="Enter State">
                               <span id="state_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">Country</label>
                               <input type="text" required class="form-control country"  value="{{ Auth::user()->country }}" name="country" placeholder="Enter Country">
                               <span id="country_error" class="text-danger"></span>
                           </div>
                           <div class="col-md-6 mt-3">
                               <label for="">PinCode</label>
                               <input type="text" required class="form-control pincode"  value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Enter PinCode">
                               <span id="pincode_error" class="text-danger"></span>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-md-5">
               <div class="card">
                   <div class="card-body">
                       Order Details
                       <hr>
                       @if($cartitems->count() > 0)
                       <table class="table table-striped table-bordered">
                           <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Qty</th>
                                  <th>Price</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $total=0; ?>
                           @foreach($cartitems as $item)
                                      <tr>
                                          <?php $total += $item->products->selling_price *  $item->prod_qty ; ?>
                                          <td> {{ $item->products->name }}</td>
                                          <td> {{ $item->prod_qty }}</td>
                                          <td> {{ $item->products->selling_price }}</td>
                                    </tr>
                           @endforeach
                           </tbody>
                       </table>
                       <h6 class="px-2"> Grand total <span class="float-end">Rs {{ $total }}</span> </h6>
                       <hr>
                       <input type="hidden" name="payment_mode" value="COD">
                       <button type="submit" class="btn btn-success float-end w-100">Place Order | COD</button>
                       <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
                       <div id="paypal-button-container" ></div>
                       @else
                       <h4 class="text-center">No products in cart</h4>
                       @endif
                   </div>
               </div>
           </div>
       </div>
       </form>
   </div>

@endsection

@section('scripts')
{{--    <script src="https://www.paypal.com/sdk/js?client-id=AdFZ2CexCmd1IALIUXxw9wgu4rZMTlmDSbI6p4LxyJUNo3lzc7F8QksssJThEbgsoCpN4R7GDCpAXoJb"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=AdFZ2CexCmd1IALIUXxw9wgu4rZMTlmDSbI6p4LxyJUNo3lzc7F8QksssJThEbgsoCpN4R7GDCpAXoJb"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js">


        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
        </head>
        <body>
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script src="https://www.paypal.com/sdk/js?client-id=AdFZ2CexCmd1IALIUXxw9wgu4rZMTlmDSbI6p4LxyJUNo3lzc7F8QksssJThEbgsoCpN4R7GDCpAXoJb&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            // Order is created on the server and the order id is returned
            createOrder() {
                return fetch("/my-server/create-paypal-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    // use the "body" param to optionally pass additional order information
                    // like product skus and quantities
                    body: JSON.stringify({
                        cart: [
                            {
                                name: 'Mobile',
                                sku: 'ABC123',
                                quantity: 1,
                            },
                        ],
                    }),
                })
                    .then((response) => response.json())
                    .then((order) => order.id);
            },
            // Finalize the transaction on the server after payer approval
            onApprove(data) {
                return fetch("/my-server/capture-paypal-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                })
                    .then((response) => response.json())
                    .then((orderData) => {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                        var firstname = $('.firstname').val();
                        var lastname = $('.lastname').val();
                        var email = $('.email').val();
                        var phone = $('.phone').val();
                        var address1 = $('.address1').val();
                        var address2 = $('.address2').val();
                        var city = $('.city').val();
                        var state = $('.state').val();
                        var country = $('.country').val();
                        var pincode = $('.pincode').val();

                        $.ajax({
                            method:"POST",
                            url:"/place-order",
                            dataType: 'json',
                            data: {
                                'firstname' : firstname,
                                'lastname' : lastname,
                                'email' : email,
                                'phone' : phone,
                                'address1' : address1,
                                'address2' : address2,
                                'city' : city,
                                'state' : state,
                                'country' : country,
                                'pincode' : pincode,
                                'payment_mode':"paid by Paypal",
                                'payment_id': transaction.id,
                            },
                            success: function (response) {
                                swal(response.status)
                                window.location.href = "/my-orders";
                            },
                        })

                    });
            }
        }).render('#paypal-button-container');
    </script>

    </html>

@endsection
