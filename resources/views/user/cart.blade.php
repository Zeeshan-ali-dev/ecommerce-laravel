@extends('user.layouts.layout')


@section('content')
    
      <!--Body Content-->
      <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
          <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Your cart</h1></div>
          </div>
        </div>
        <!--End Page Title-->

        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
              <form action="{{route("place-order")}}" id="orderPlace" method="post" class="cart style2">
                @csrf
                <table>
                  <thead class="cart__row cart__header">
                    <tr>
                      <th colspan="2" class="text-center">Product</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-right">Total</th>
                      <th class="action">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($products): foreach($products as $p): ?>

                    <tr class="cart__row border-bottom line1 cart-flex border-top" >
                      <input type="hidden" class='cartId' name="cartId" value="{{encrypt($p->cart_id)}}">
                      <td class="cart__image-wrapper cart-flex-item">
                        <a href="#"
                          ><img
                            class="cart__image"
                            src="{{asset("images/$p->img")}}"
                            alt=""
                        /></a>
                      </td>
                      <td class="cart__meta small--text-left cart-flex-item">
                        <div class="list-view-item__title">
                          <a href="#">{{$p->name ? $p->name : 'N/A'}}</a>
                        </div>

                        {{-- <div class="cart__meta-text">
                          Color: Navy<br />Size: Small<br />
                        </div> --}}
                      </td>
                      <td class="cart__price-wrapper cart-flex-item">
                        <span class="money">£{{$p->price ? $p->price : 0}}</span>
                      </td>
                      <td
                        class="cart__update-wrapper cart-flex-item text-right"
                      >
                        <div class="cart__qty text-center">
                          <div class="qtyField">
                            <a class="qtyBtn minus" href="javascript:void(0);"
                              ><i class="icon icon-minus"></i
                            ></a>
                            <input
                              class="cart__qty-input qty"
                              type="text"
                              name="updates[]"
                              id="qty"
                              value="{{$p->quantity}}"
                              pattern="[0-9]*"
                            />
                            <a class="qtyBtn plus" href="javascript:void(0);"
                              ><i class="icon icon-plus"></i
                            ></a>
                          </div>
                        </div>
                      </td>
                      <td class="text-right small--hide cart-price">
                        <div><span class="money">£{{$p->price * $p->quantity}}</span></div>
                      </td>
                      <td class="text-center small--hide">
                        <a
                          href="#"
                          class="btn btn--secondary cart__remove"
                          title="Remove tem"
                          ><i class="icon icon anm anm-times-l"></i
                        ></a>
                      </td>
                    </tr>

                    <?php endforeach; endif; ?>
                    
                  </tbody>
                </table>

              </form>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
              <div class="solid-border">
                <div class="row">
                  <span class="col-12 col-sm-6 cart__subtotal-title"
                    ><strong>Subtotal</strong></span
                  >
                  <span
                    class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"
                    ><span class="money">£{{$grandTotal}}</span></span
                  >
                </div>
                <div class="cart__shipping">
                  Shipping &amp; taxes calculated at checkout
                </div>
                <p class="cart_tearm">
                  <label>
                    <input
                      type="checkbox"
                      name="tearm"
                      id="cartTearm"
                      class="checkbox"
                      value="tearm"
                      required=""
                    />
                    I agree with the terms and conditions</label
                  >
                </p>
                <input
                  type="submit"
                  name="checkout"
                  id="cartCheckout"
                  class="btn btn--small-wide checkout"
                  value="Place Order"
                />
                <div class="paymnet-img">
                  <img src="{{asset('user_assets/images/payment-img.jpg')}}" alt="Payment" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--End Body Content-->

      <form id="product-minus" method="post" class="d-none" action="{{route("minus-product")}}">
        @csrf
        <input type="hidden" name="cart_id" value="">
      </form>
      <form id="product-add" method="post" class="d-none" action="{{route("plus-product")}}">
        @csrf
        <input type="hidden" name="cart_id" value="">
      </form>
      <form id="product-remove" method="post" class="d-none" action="{{route("remove-product")}}">
        @csrf
        <input type="hidden" name="cart_id" value="">
      </form>
@endsection


@section('extra-scripts')
    <script>
      $(document).click(function(){


        $("body").on('click', '.qtyBtn.minus', function(){
          let cartId = $(this).parents('.cart__row').find('.cartId').val();
          console.log(cartId);
          $('#product-minus input[name=cart_id]').val(cartId);
          $('#product-minus').submit();
        })

        $("body").on('click', '.qtyBtn.plus', function(){
          let cartId = $(this).parents('.cart__row').find('.cartId').val();
          console.log(cartId);
          $('#product-add input[name=cart_id]').val(cartId);
          $('#product-add').submit();
        })

        $("body").on('click', '.cart__remove', function(){
          let cartId = $(this).parents('.cart__row').find('.cartId').val();
          console.log(cartId);
          $('#product-remove input[name=cart_id]').val(cartId);
          $('#product-remove').submit();
        })
        
        $("body").on('click', '#cartCheckout', function(){
          $('#orderPlace').submit();
        })



      })
   
    </script>
@endsection