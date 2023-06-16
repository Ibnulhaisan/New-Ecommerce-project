$(document).ready(function (){

    loadCart();
    loadWishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart()
    {
        $.ajax({
            method:"GET",
            url:"/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.Count);
            },
        })
    }

    function loadWishlist()
    {
        $.ajax({
            method:"GET",
            url:"/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.Count);
            },
        })
    }

    $('.addToCartBtn').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method:"POST",
            url:"/add-to-cart",
            dataType: 'json',
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                swal(response.status);
                loadCart();
            },
        })
    });

    $('.addToWishlist').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method:"POST",
            url:"/add-to-wishlist",
            dataType: 'json',
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                swal(response.status);
                loadWishlist();
            },
        })
    });


    // $('.increment-btn').click(function (e){
        $(document).on('click','.increment-btn',function (e) {
        e.preventDefault();

        // var inc_value = $('.qty-input').val();
        var $inc_value = $(this).siblings('.qty-input');
        var value = parseInt($inc_value.val(),10);
        value = isNaN(value) ? 0 : value;
        if (value < 10)
        {
            value++;
            // $('.qty-input').val(value);
            $inc_value.val(value);
        }
    });

    // $('.decrement-btn').click(function (e){
        $(document).on('click','.decrement-btn',function (e) {
        e.preventDefault();

        // var dec_value = $('.qty-input').val();
        var $dec_value = $(this).siblings('.qty-input');
        var value = parseInt($dec_value.val(),10);
        value = isNaN(value)? 0 : value;
        if (value > 1)
        {
            value--;
            // $('.qty-input').val(value);
            $dec_value.val(value);
        }
    });

    // $('.delete-cart-item').click(function (e){
    $(document).on('click','.delete-cart-item',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var  prod_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method:"POST",
            url:"delete-cart-item",
            dataType: 'json',
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                loadCart();
                $('.cartitems').load(location.href + " .cartitems");
               swal("",response.status,"success");

            },
        })
    });

    // $('.remove-wishlist-item').click(function (e){
    $(document).on('click','.remove-wishlist-item',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var  prod_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method:"POST",
            url:"delete-wishlist-item",
            dataType: 'json',
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // window.location.reload();
                loadWishlist();
                $('.wishlistitems').load(location.href + " .wishlistitems");
               swal("",response.status,"success");
                loadWishlist();
            },
        })
    });

    // $('.changeQuantity').click(function (e) {
    $(document).on('click','.changeQuantity',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var  prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var  qty = $(this).closest('.product_data').find('.qty-input').val();
       var data = {
          'prod_id' : prod_id,
          'prod_qty' : qty,
        }

        $.ajax({
            method:"POST",
            url:"update-cart",
            dataType: 'json',
            data: data,
            success: function (response) {
                // window.location.reload();
                $('.cartitems').load(location.href + " .cartitems");
                // swal("",response.status,"success");
                // alert(response);
            },
        })

    })

});
