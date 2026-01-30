
@extends('user.component.app')
@section('content')
  <!-- blog section start -->
  <div class="blog_section layout_padding">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <h1 class="blog_taital"> المطاعم </h1>
    </div>

    @foreach ($resturantAll->groupBy('city.name') as $cityName => $restaurants)
      <div class="city-section my-5 py-4 px-3 rounded shadow-sm" style="background: linear-gradient(to right, #f8f9fa, #ffffff); border-left: 5px solid #ff6347;">

        <!-- اسم المدينة -->
        <div class="text-center mb-4">
          <h3 class="fw-bold" style="color: #444;">🏙️ {{ $cityName }}</h3>
          <div style="height: 3px; width: 60px; margin: 10px auto; background-color: #ff6347; border-radius: 2px;"></div>
        </div>

        <!-- قائمة المطاعم -->
        <div class="row gy-4">
          @foreach ($restaurants as $item)
            <div class="col-md-6 col-lg-3">
              <div class="product-card p-3 rounded shadow-sm bg-white h-100 text-center">
                <div class="product-img mb-3">
                  <img 
                    src="{{ $item->image ? route('getImage', ['id' => $item->image->id, 'file_name' => $item->image->file_name]) : asset('images/default.png') }}"
                    onerror="this.src='{{ asset('images/default.png') }}'"
                    alt="{{ $item->name }}"
                    class="img-fluid rounded"
                    style="max-height: 180px; object-fit: cover;"
                  >
                </div>
                <div class="product-info">
                  <h5 class="fw-bold mb-1" style="color: #444;">{{ $item->name }}</h5>
                  <p class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> {{ $item->address }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    @endforeach

  </div>
</div>
  <!-- blog section end -->
@endsection