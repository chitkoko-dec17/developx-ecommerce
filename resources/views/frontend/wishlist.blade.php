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
                      <li class="active">Wishlist</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- Li's Breadcrumb Area End Here -->
      <!--Wishlist Area Strat-->
      <div class="wishlist-area pt-60 pb-60">
          <div class="container">
              <div class="row">
                  <div class="col-12">
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
                  </div>
                  <div class="col-12">
                    @if(Cart::instance('wishlist')->count() > 0)
                      <form action="#">
                          <div class="table-content table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th class="li-product-remove">remove</th>
                                          <th class="li-product-thumbnail">images</th>
                                          <th class="cart-product-name">Product</th>
                                          <th class="li-product-price">Unit Price</th>
                                          <th class="li-product-stock-status">Stock Status</th>
                                          <!-- <th class="li-product-add-cart">add to cart</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach(Cart::instance('wishlist')->content() as $item)
                                      <tr>
                                          <td class="li-product-remove"><a class="wishlist_dele_id" data-toggle="modal" data-target="#deleteModal" data-attr="{{ route('wishlist.destroy', $item->rowId) }}" href="javascript:void(0)"><i class="fa fa-times"></i></a></td>
                                          <td class="li-product-thumbnail"><a href="{{ route('detail', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" class="img-thumbnail" width="120" alt="{{$item->model->name}}"></a></td>
                                          <td class="li-product-name"><a href="{{ route('detail', $item->model->slug) }}">{{$item->model->name}}</a></td>
                                          <td class="li-product-price"><span class="amount">${{$item->model->price}}</span></td>
                                          <td class="li-product-stock-status"><span class="in-stock">in stock</span></td>
                                          <!-- <td class="li-product-add-cart"><a href="#">add to cart</a></td> -->
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </form>
                    @endif
                  </div>
              </div>
          </div>
      </div>
      <!--Wishlist Area End-->
      @include('frontend/layouts/footer')
      @include('frontend/layouts/product-quick-view')
  </div>

<!-- Delete Modal Box -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Delete Product from Wishlist</h5>
            </div>
            <div class="modal-body">
              <form action="" id="delete-pro" method="post">
                @csrf
                @method('DELETE')
                <div class="row" style="margin-left:8px;">
                    <p>Are you sure you want to delete?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button id="delete-it" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
