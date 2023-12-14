@extends('frontendLayout')

@section('layoutContent')
  <!-- Begin Body Wrapper -->
  <div class="body-wrapper">
      @include('frontend/layouts/menu')
      <!-- Begin Li's Breadcrumb Area -->
      <div class="breadcrumb-area">
          <div class="container">
              <div class="breadcrumb-content">
                  <ul>
                      <li><a href="/">Home</a></li>
                      <li class="active">Shopping Cart</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->
      {{-- success error msg start --}}
      @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{session()->get('success_message')}}
        </div>
      @endif

      @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
      @endif
      {{-- success error msg end --}}
      <hr>

      <!--Shopping Cart Area Strat-->
      <div class="Shopping-cart-area pt-60 pb-60">
          <div class="container">
              <div class="row">
                  @if(Cart::count() > 0)
                  <div class="col-12">
                      <form action="{{route('cart.update',1)}}" method="POST">
                        @csrf
                        @method('PUT')
                          <div class="table-content table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th class="li-product-remove">remove</th>
                                          <th class="li-product-thumbnail">images</th>
                                          <th class="cart-product-name">Product</th>
                                          <th class="li-product-price">Unit Price</th>
                                          <th class="li-product-quantity">Quantity</th>
                                          <th class="li-product-subtotal">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach(Cart::content() as $item)
                                      <tr>
                                          <td class="li-product-remove">
                                            <input type="hidden" name="cart_item_ids[]" value="{{$item->rowId}}">
                                            <a class="data_dele_id" data-toggle="modal" data-target="#deleteModal" data-attr="{{ route('cart.destroy', $item->rowId) }}" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                          </td>
                                          <td class="li-product-thumbnail"><a href="{{ route('detail', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" class="img-thumbnail" width="120" alt="{{$item->model->name}}"></a></td>
                                          <td class="li-product-name"><a href="{{ route('detail', $item->model->slug) }}">{{$item->model->name}}</a></td>
                                          <td class="li-product-price"><span class="amount">{{$item->model->price}}</span></td>
                                          <td class="quantity">
                                              <label>Quantity</label>
                                              <div class="cart-plus-minus">
                                                  <input class="cart-plus-minus-box" name="cart_qty[]" value="{{$item->qty}}" type="text">
                                                  <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                  <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                              </div>
                                          </td>
                                          <td class="product-subtotal"><span class="amount">{{$item->model->price * $item->qty}}</span></td>
                                      </tr>
                                      @endforeach

                                  </tbody>
                              </table>
                          </div>
                          <div class="row">
                              <div class="col-12">
                                  <div class="coupon-all">
                                      <!-- <div class="coupon">
                                          <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                          <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                      </div> -->
                                      <div class="coupon2">
                                          <input class="button" name="update_cart" value="Update cart" type="submit">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-5 ml-auto">
                                  <div class="cart-page-total">
                                      <h2>Cart totals</h2>
                                      <ul>
                                          <li>Subtotal <span>{{Cart::subtotal()}}</span></li>
                                          <li>Total <span>{{Cart::total()}}</span></li>
                                      </ul>
                                      <a href="{{route('checkout.index')}}">Proceed to checkout</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
                  @else
                  <div class="col-12">
                    <div class="alert alert-info">
                      No product have in your cart yet!
                    </div>
                  </div>
                  @endif
              </div>
          </div>
      </div>
      <!--Shopping Cart Area End-->
      @include('frontend/layouts/footer')
  </div>


<!-- Delete Modal Box -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Delete Product from Cart</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
              <form action="" id="delete-inv" method="post">
                @csrf
                @method('DELETE')
                <div class="row" style="margin-left:8px;">
                    <p>Are you sure you want to delete?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="delete-it" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script type="text/javascript">

  $(document).on('click', '.data_dele_id', function() {
        $('#deleteModal').modal('show');
        let href = $(this).attr('data-attr');
        $('#delete-inv').attr('action', href);
    });
</script>
@endsection