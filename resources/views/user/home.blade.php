@extends('user.component.app')
@section('content')
 <!-- banner section start --> 
 <div class="banner_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="banner_img"><img src="images/banner-img.png"></div>
                  </div>
                  <div class="carousel-item">
                     <div class="banner_img"><img src="images/banner-img.png"></div>
                  </div>
                  <div class="carousel-item">
                     <div class="banner_img"><img src="images/banner-img.png"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <h1 class="banner_taital"  style="display: flex;justify-content: end"> اطلب الأن </h1>
            <p class="banner_text" style="display: flex;justify-content: end">اختر طعامك المفضل وابدء الطلب الان </p>
            <!-- select box section start -->
            <div class="container">
               <div class="select_box_section">
                  <form action="{{ route('home') }}" method="get" enctype="multipart/form-data">
                     <div class="select_box_main">
                         <div class="row">
                             {{-- تحديد المدينة --}}
                             <div class="col-md-4 select-outline">
                                 <select id="citySelect" name="city_id" class="mdb-select md-form md-outline colorful-select dropdown-primary" onchange="updateRestaurants(this.value)">
                                     @foreach ($city as $item)
                                         <option value="{{ $item->id }}" {{ request('city_id', $city[0]->id) == $item->id ? 'selected' : '' }}>
                                             {{ $item->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                 
                             {{-- اختيار المطعم --}}
                             <div class="col-md-4 select-outline">
                                 <select id="restaurantSelect" name="resturant_id" class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                     <option value="" disabled selected>المطاعم</option>
                                     @foreach ($resturantAll as $item)
                                         <option value="{{ $item->id }}" data-city="{{ $item->city_id }}" {{ request('resturant_id') == $item->id ? 'selected' : '' }}>
                                             {{ $item->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                 
                             {{-- اختيار الفئة (الطعام) --}}
                             <div class="col-md-4 select-outline">
                                 <select name="category_id" class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                     <option value="" disabled selected>تصنيف الطعام</option>
                                     @foreach ($categoryAll as $item)
                                         <option value="{{ $item->id }}" {{ request('category_id') == $item->id ? 'selected' : '' }}>
                                             {{ $item->name }}
                                         </option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                     </div>
                 
                     <div class="search_btn">
                         <button style="padding: 10px;color: white;background: red" type="submit">ابحث الأن</button>
                     </div>
                 </form>
                 
                 <script>
                     function updateRestaurants(selectedCityId) {
                         let restaurantSelect = document.getElementById("restaurantSelect");
                         let options = restaurantSelect.getElementsByTagName("option");
                 
                         for (let i = 0; i < options.length; i++) {
                             let cityId = options[i].getAttribute("data-city");
                             if (cityId == selectedCityId || options[i].value === "") {
                                 options[i].style.display = "block";
                             } else {
                                 options[i].style.display = "none";
                             }
                         }
                     }
                 
                     // تحديث القائمة عند تحميل الصفحة
                     document.addEventListener("DOMContentLoaded", function() {
                         let selectedCityId = document.getElementById("citySelect").value;
                         updateRestaurants(selectedCityId);
                     });
                 </script>
                 
               </div>
            </div>
            <!-- select box section end -->
         </div>
      </div>
   </div>
</div>
<!-- banner section end -->
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
  <!-- about section start -->
  <div class="about_section">
     <div class="container">
        <div class="row">
           <div class="col-md-6">
              <div class="about_img"><img src="images/about-img.png"></div>
           </div>
           <div class="col-md-6">
              <div class="about_taital_main">
                 <div class="about_taital">من نحن</div>
                 <p class="about_text">نحن منصة مبتكرة تهدف إلى تقديم تجربة فريدة ومريحة للمستخدم، من خلال توفير خدمات عالية الجودة ومحتوى غني يلبي تطلعات الجميع. نؤمن بأهمية البساطة والاحتراف، ونعمل باستمرار على تحسين خدماتنا لتناسب احتياجاتك اليومية. رؤيتنا أن نكون الخيار الأول لكل من يبحث عن الجودة والموثوقية في عالم التقنية والخدمات الرقمية. </p>
                 <div class="readmore_bt"><a href="about">المزيد</a></div>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!-- about section end -->
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

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.add-to-order').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('.orderForm');
            let formData = new FormData(form);
            let button = this;

            fetch("{{ route('add.to.session') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.textContent = "✔ تمت الاضافة";
                    button.disabled = true;
                } else {
                    alert("حدث خطأ أثناء الإضافة.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("تعذر تنفيذ الطلب.");
            });
        });
    });
});
</script>
@endsection
