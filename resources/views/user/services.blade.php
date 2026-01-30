
@extends('user.component.app')
@section('content')
     <!-- services section start -->
  <div class="services_section layout_padding">
  <div class="container">
   @foreach ($category as $item)
  <div class="category-section my-5 py-4 px-3 rounded shadow-sm" style="background: linear-gradient(to right, #f8f9fa, #ffffff); border-left: 5px solid #ff6347;">
    <div class="text-center mb-4">
      <h2 class="fw-bold" style="color: #333;">🍽️ {{ $item->name }}</h2>
      <div style="height: 4px; width: 60px; margin: 10px auto; background-color: #ff6347; border-radius: 2px;"></div>
    </div>

    <div class="row gy-4">
      @foreach ($item->food as $element)
        <div class="col-md-6 col-lg-3">
          <div class="product-card">
            <div class="product-img">
              <img src="{{ route('getImage', ['id' => $element->image->id, 'file_name' => $element->image->file_name]) }}" alt="{{ $element->name }}">
            </div>
            <div class="product-info">
              <h4 class="product-title">{{ $element->name }}</h4>
              <p class="product-price">${{ $element->price }}</p>
              <p class="product-desc">{{ Str::limit($element->description, 50) }}</p>

              @auth
                @php
                  $orders = session('orders', []);
                  $added = collect($orders)->contains('food_id', $element->id);
                @endphp

                <form class="orderForm">
                  @csrf
                  <input type="hidden" name="food_id" value="{{ $element->id }}">
                  <input type="hidden" name="food_name" value="{{ $element->name }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="price" value="{{ $element->price }}">

                  <button 
                    class="add-to-order"
                    type="button"
                    {{ $added ? 'disabled' : '' }}
                  >
                    {{ $added ? '✔ تمت الإضافة' : ' + ' }}
                  </button>
                </form>
              @endauth
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endforeach

  </div>
</div>

  <!-- services section end -->
@endsection