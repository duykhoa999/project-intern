<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart_detail.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/user.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/thanhtoan.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/sweetalert.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="shortcut icon" href="dist/img/logodocument.png" type="image/png" />
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>Demon Whisky</title>
</head>

<body>
    @include('header')
    <!-- <section> -->
    @yield('content')
    <!-- </section> -->

    @include('footer')


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/search.js')}}"></script>
<script src="{{asset('frontend/js/detail.js')}}"></script>
<script src="{{asset('frontend/js/users.js')}}"></script>
<script src="{{asset('frontend/js/sweetalert.js')}}"></script>
<!-- kh??ch h??ng h???y ????n h??ng  -->
<script type="text/javascript">
    function Huydonhang(id) {
        var order_code = id;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('/huy-don-hang')}}",
            method: "POST",
            data: {
                order_id: order_code,
                _token: _token
            },
            success: function(data) {

                alert("h???y ????n h??ng th??nh c??ng")
                location.reload();
            }
        });
    }
</script>
<!-- //?????t h??ng -->

<!-- ajax b??nh lu???n -->
<script type="text/javascript">
    $(document).ready(function() {
        load_comment();

        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/load-comment')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {

                    $('#comment_show1').html(data);
                }
            });
        }
        $('.send-comment').click(function() {
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/send-comment')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    comment_name: comment_name,
                    comment_content: comment_content,
                    _token: _token
                },
                success: function(data) {

                    $('#notify_comment').html('<span class="text text-success">Th??m b??nh lu???n th??nh c??ng</span>');
                    load_comment();
                    // $('#notify_comment').fadeOut(9000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                }
            });
        });
    });
</script>
<!-- ajax gi??? h??ng -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#paypal-one").on('change', function () {
            var status_payemnt =  $('#paypal-one').val();
            if(status_payemnt == 1)
            {
                document.getElementById("paypal-button-container").style.opacity = '0';
            }
            else{
                document.getElementById("paypal-button-container").style.opacity = '1';
            }
        });
        $('.add-to-cart').click(function() {
            var id = $(this).data('id_product');
            var check = $(this).data('check');
            if(check === 0) {
                window.location.href = '/dang-nhap'                 
            }
            // alert(id);
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            // alert(cart_product_qty);
            if (parseInt(cart_product_quantity) == 0) {
                alert('S???n Ph???m t???m th???i h???t h??ng');
                location.reload();
            } else if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('L??m ??n ?????t nh??? h??n ho???c b???ng ' + cart_product_quantity);
                location.reload();
            } else {
                $.ajax({
                    url: "{{url('/add-cart-ajax')}}",
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                        cart_product_quantity: cart_product_quantity
                    },
                    success: function() {
                        swal({
                                title: "???? th??m s???n ph???m v??o gi??? h??ng",
                                text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
                                showCancelButton: true,
                                cancelButtonClass: "btn-success",
                                cancelButtonText: "Xem ti???p",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "??i ?????n gi??? h??ng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }

                });
            }


        });
    });
</script>
<script src="https://www.paypal.com/sdk/js?client-id=AdjVxoUrXV076qqWlcY0jaMQo6ICFm0rH-3rxAR2TrzZ8Bw3M_G5wmBys73F8Ohf5n-SNqI-KXF_DdwC">
    // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>
<script>
    var cart_total = document.getElementById("cart_total").value;


    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        // value: '0.1'
                        value: `${cart_total}`
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url: "{{url('/order-place')}}",
                    method: 'POST',
                    data: {
                        _token: _token,
                        data :data
                    },
                    success: function(data) {
                        console.log(data);
                        if(data.status)
                        {
                            location.reload();
                        }
                    }

                });
            });
        }
    }).render('#paypal-button-container');

    //This function displays Smart Payment Buttons on your web page.
</script>

</html>
