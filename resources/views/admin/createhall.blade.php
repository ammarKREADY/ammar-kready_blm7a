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
            <h1 style="color: cadetblue">اضافة الصالة</h1>
            <br>
            <form action="{{ url ('createHall') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">

        <!-- الحقل الأول -->
        <div class="form-group">
            <h4>اسم الصالة</h4>
            <input type="text" name="name" class="form-control">
        </div>

        <!-- الحقل الثاني -->
        <div class="form-group">
            <h4>مكان الصالة</h4>
            <input type="text" name="palce" class="form-control">
        </div>

        <!-- الحقل الثالث -->
        <div class="form-group">
            <h4>خدمات الصالة</h4>
            <input type="text" name="services" class="form-control">
        </div>

        <!-- الحقل الرابع -->
        <div class="form-group">
            <h4>وصف الصالة</h4>
            <input type="text" name="description" class="form-control">
        </div>

        <!-- الحقل الخامس -->
        <div class="form-group">
            <h4>عدد الأشخاص</h4>
            <input type="text" name="size" class="form-control">
        </div>

        <!-- الحقل السادس -->
        <div class="form-group">
            <h4>سعر ساعة حجز الصالة</h4>
            <input type="text" name="price" class="form-control">
        </div>

        <!-- الحقل السابع -->
         <div class="form-group">
    <h4>نوع الصالة</h4>
    <select name="type_hall_id" class="form-control">
        <option value="" disabled selected>اختر نوع الصالة</option>
        @foreach ($hallTypes as $type) <!-- استخدام المتغير الصحيح -->
            <option value="{{ $type->id }}">{{ $type->type }}</option> <!-- قيمة الـ ID واسم النوع -->
        @endforeach
    </select>
</div>


        <!-- حقل رفع الصورة -->
        <div class="form-group">
            <label for="image">الصورة</label>
            <input type="file" class="form-control-file" id="image" name="image" multiple>
        </div>

    </div>

    <br><br>

    <!-- زر الإرسال -->
    <input class="btn btn-primary" type="submit" value="إضافة منتج" >

</form>



          </div>
          <div>
            <br>
            <br>
            <table class="table_deg">
                <tr>
                    <th>اسم الصالة</th>
                    <th>مكان الصالة</th>
                    <th>خدمات الصالة</th>
                    <th>وصف الصالة</th>
                    <th>عدد الصالة</th>
                    <th>سعر الصالة</th>
                    <th>نوع الصالة</th>
                    <th>صور الصالة</th>
                    <th>حذف</th>
                    <th>تعديل</th>
                </tr>
                @foreach ($halls as $hall)
                <tr>
                    <td>{{ $hall->name }}</td>

                    <td>{{ $hall->palce }}</td>

                    <td>{{ $hall->services }}</td>

                    <td>{{ $hall->description }}</td>

                    <td>{{ $hall->size }}</td>

                    <td>{{ $hall->price }}</td>

                    <td>{{ $hall->typehall->type ?? 'نوع غير محدد' }}</td>


                    <td>
                    @if ($hall->image)
                        <img src="{{ route('getImage', ['id' => $hall->image->id, 'file_name' => $hall->image->file_name]) }}" alt="{{ $hall->name }}" width="100" height="100">
                    @else
                        <img src="images/default-product-image.jpg" alt="Default Image" width="100" height="100">
                    @endif

                    </td>
                    <td>
                        <form action="{{ url('deleteHall', $hall->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
                    </td>
                     <td>
                     <a href="{{  url('edithall', $hall->id) }}"  class="btn btn-light">تعديل</a>
                    </td>
                </tr>

                @endforeach
            </table>
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
