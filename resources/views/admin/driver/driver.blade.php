<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style type="text/css">
        input[type='text']{}
        .table_deg{
            text-align: center;
            margin-top: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
        }
        th{
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
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
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
         <h1 style="color: cadetblue;text-align: center">السائقين</h1>
        
         <form action="{{ route('driver.create') }}" method="get" enctype="multipart/form-data">
          @csrf
          <input class="btn btn-primary" type="submit" value="اضافة">
        </form>
          <table style="width: 100%" class="table_deg">
            <tr>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>رقم الهاتف</th>
                <th>المدينة</th>
                <th>وقت البدء</th>
                <th>وقت الانتهاء</th>
                <th>نوع المركبة</th>
                <th>كلفة التوصيل</th>
                <th>الراتب</th>
                
                <th></th>
                <th></th>
            </tr>
            @foreach ($driver as $service)
            <tr>
                <td>
                 {{ $service->user->name }}
                </td>
                <td>
                 {{ $service->user->email }}
                </td>
                <td>
                 {{ $service->user->phone }}
                </td>
                <td>
                 {{ $service->city->name }}
                </td>
                <td>
                 {{ $service->start_jop }}
                </td>
                <td>
                 {{ $service->end_jop }}
                </td>
                <td>
                 {{ $service->vehicle }}
                </td>
                <td>
                 {{ $service->driver_cost }}
                </td>
                <td>
                 {{ $service->salary }}
                </td>
              <td>
               <form action="{{ route('driver.edit', ['id' => $service->id]) }}" method="get" enctype="multipart/form-data">
                 <input class="btn btn-primary" type="submit" value="تعديل">
               </form>
             </td>
              <td>
                <form action="{{ route('driver.delete', ['id' => $service->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input class="btn btn-primary" type="submit" value="حذف">
                </form>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
    <script>
      function handleClickImage(inputId) {
        document.getElementById(inputId).click();
      }
    </script>
  </body>
</html>
