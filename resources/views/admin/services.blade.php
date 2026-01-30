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
            <form action="{{ url ('createService') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: center;">

        <!-- الحقل الأول -->
        <div class="form-group">
            <h4>اسم الخدمة</h4>
            <input type="text" name="name" class="form-control">
        </div>

        <!-- الحقل الثاني -->
        <div class="form-group">
            <h4>سعر الخدمة </h4>
            <input type="text" name="price" class="form-control">
        </div>



    <h4> نوع الخدمة</h4>
    <select name="type_service_id" class="form-control">
        <option value="" disabled selected>اختر  نوع الخدمة</option>
        @foreach ($type as $h) <!-- استخدام المتغير الصحيح -->
            <option value="{{ $h->id }}">{{ $h->type }}</option> <!-- عرض اسم الصالة واستخدام قيمة الـ ID -->
        @endforeach
    </select>




    <table class="table_deg">
                <tr>
                    <th>اسم الخدمة</th>
                    <th> سعر الخدمة</th>
                    <th>  نوع الخدمة  </th>
                    <th>حذف</th>
                    <th>تعديل</th>
                </tr>
                @foreach ($service as $service)
                <tr>
                    <td>{{ $service->name }}</td>

                    <td>{{ $service->price }}</td>




                @endforeach
                @foreach ($type as $t )
                    <td>{{ $t->type }}</td>
                @endforeach

            </table>
</div>




        <input class="btn btn-primary" type="submit" value="إضافة منتج" >

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
