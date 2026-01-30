<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        input[type='text']{

        }
        .table_deg{
            text-align: center;
            margin-top: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
        }
        th{
            background-color: skyblue;
            padding: 15px;
            font-size:20px;
            font-weight:bold;
            color: white;
        }
        td{
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
        .form-control {
    color: white; /* تحديد لون الخط الأبيض */
    background-color: #333; /* اختياري: تعديل لون الخلفية ليكون غامقاً لتتناسب مع النص الأبيض */
}

    </style>



  </head>
  <body>
    <!---header--->
    @include('admin.header')
    <!---endheader---->
    <!---sidebar-->
    @include('admin.sidebar')
    <!---endside-->
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h1>تعديل الصالة</h1>

            <div class="iputs">
                <h3>اسم الصالة {{ $edit->name }}</h3>

            </div>
            <form action="{{ url('updateHall', $edit->id) }}" method="POST">
                @csrf
                @method('POST')
                <input  class="form-control" name="name" placeholder="ادخل اسم الصالة الجديد" value="{{ $edit->name }}">
                <input  class="form-control" name="palce" placeholder="ادخل موقع الصالة الجديد" value="{{ $edit->palce }}">
                <input class="form-control" name="description" placeholder="ادخل وصف الصالة الجديد" value="{{ $edit->description }}">
                <input class="form-control" name="price" placeholder="ادخل سعر الصالة الجديد" value="{{ $edit->price }}">
                <input class="form-control" name="services" placeholder="ادخل خدمات الصالة الجديد" value="{{ $edit->services }}">
                <input class="form-control" name="size" placeholder="ادخل حجم الصالة الجديد" value="{{ $edit->size }}">
                <div class="form-group">
    <!-- عرض الصورة إذا كانت موجودة -->
    @if ($edit->image)
        <label>الصورة الحالية:</label>
        <img src="{{ route('getImage', ['id' => $edit->image->id, 'file_name' => $edit->image->file_name]) }}" alt="{{ $edit->name }}" width="100" height="100" style="display: block; margin-bottom: 10px;">
    @else
        <label>الصورة الافتراضية:</label>
        <img src="images/default-product-image.jpg" alt="Default Image" width="100" height="100" style="display: block; margin-bottom: 10px;">
    @endif

    <!-- حقل رفع الملفات -->
    <label for="image[]">اختر صورة جديدة:</label>
    <input type="file" class="form-control-file" id="image[]" name="image[]" multiple>
</div>
                <div class="form-group">
            <label for="type_hall_id">نوع الصالة:</label>
            <select name="type_hall_id" class="form-control" required>
                <option value="" disabled selected>اختر نوع الصالة</option>
                @foreach ($typehalls as $type)
                    <option value="{{ $type->id }}" {{ $edit->type_hall_id == $type->id ? 'selected' : '' }}>
                        {{ $type->type }} <!-- قيمة النوع التي يتم عرضها في الخيار -->
                    </option>
                @endforeach
            </select>
        </div>
                <button type="submit" class="btn btn-danger">تعديل</button>
            </form>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>
