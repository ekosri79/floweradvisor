@extends('layouts.app2')


@section('main-content')

 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/image/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{route('home')}}">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt=0;$subtotal=0;$tdiscount=0;$gtotal=0;?>
                            @foreach ($items as $item)

                            <tr>
                                <td class="shoping__cart__item">
                                    <img style="width:80px;height:auto" src="{{asset('assets/image/product/'.$item->prod_pic)}}" alt="">
                                    <h5>{{$item->prod_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <input type="hidden" value="{{$item->price}}" name="hi_price_{{$cnt}}" id="hi_price_{{$cnt}}">
                                    IDR {{App\Helpers\GFunc::numFormat($item->price)}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty2">
                                            <input type="text" id="txt_qty_{{$cnt}}" name="txt_qty_{{$cnt}}" data-token="{{$item->token}}" data-index="{{$cnt}}" value="{{$item->qty}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    <input type="hidden" value="{{$item->price*$item->qty}}" name="hi_total_{{$cnt}}" id="hi_total_{{$cnt}}">
                                    IDR <span id="span_total_{{$cnt}}">{{App\Helpers\GFunc::numFormat($item->price*$item->qty)}}</span>
                                    <?php $subtotal = $subtotal+$item->price*$item->qty;?>
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="#" onClick="delCart('{{$item->token}}');return false;"><span class="icon_close"></span></a>
                                </td>
                            </tr>
                            <?php $cnt++?>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{route('home')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                   <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>-->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal (IDR)<span id="span_subtotal">{{App\Helpers\GFunc::numFormat($subtotal)}}</span></li>
                        <li style="color:#f00">Discount (IDR)<span>{{App\Helpers\GFunc::numFormat($tdiscount)}}</span></li>
                     
                        <li>Total <span>{{App\Helpers\GFunc::numFormat($subtotal-$tdiscount)}}</span></li>
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection


@push('scripts')
<script>
let subtotal=0;
let tdiscount=0;
let gtotal = 0;

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function delCart(token){
        $.ajax({
			url: '{{ route("cart.del") }}',
			type: 'post',
			async: true,
			data: { 

					token:token,
				  },
					success: function(response){
					
				}
		}).done(function(response){
            console.log('Response:'+response.status);
            if(response.status=='ok'){
                location.href="{{route('cart.index')}}";
            }
			//$(targetx).attr("data-content",response);
			//$(targetx).popover('show');
		});
        
    }

$(function () {
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                    }
                });

    function recalCulate(){
        @for ($i=0;$i<$cnt;$i++)
            var price = parseFloat($('#hi_price_{{$i}}').val());
            var qty = parseInt($('#txt_qty_{{$i}}').val());
            $("#span_total_{{$i}}").html(formatNumber(qty*price));
            subtotal=subtotal+(qty*price);
        @endfor
       $("#span_subtotal").html(formatNumber(subtotal));
    }


    function updateCart(token,qty){
        $.ajax({
			url: '{{ route("cart.update") }}',
			type: 'post',
			async: true,
			data: { 

					token:token,
                    qty:qty,
				  },
					success: function(response){
					
				}
		}).done(function(response){
            console.log('Response:'+response.status);
			//$(targetx).attr("data-content",response);
			//$(targetx).popover('show');
		});
        
    }

    

  
    var proQty = $('.pro-qty2');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function (event) {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find('input').val(newVal);

        var targetx=$button.parent().find('input').attr('data-index');
        var tokenx=$button.parent().find('input').attr('data-token');
        updateCart(tokenx,newVal);
	//	var idx = $(targetx).attr('data-index');
        //console.log(tokenx);
        recalCulate();
    });

      



});    
</script>
@endpush