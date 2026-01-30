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
            <h1 style="color: cadetblue">اضافة نوع الصالة</h1>
            <br>
            <form action="{{ url ('createTypeHall') }}" method="post">
                @csrf
                <div>
                    <h4>اسم نوع الصالة</h4>
                    <input type="text" name="type" >
                    <br>
                    <br>
                    <input class="btn btn-primary" type="submit" value="إضافة منتج" >

                </div>

            </form>


          </div>
          <div>
            <br>
            <br>
            <table class="table_deg">
                <tr>
                    <th>اسم نوع الصالة</th>
                    <th>حذف</th>
                    <th>تعديل</th>
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{ $data->type }}</td>
                    <td>
                        <form action="{{ url('deleteTypeHall', $data->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
                    </td>
                     <td>
                      <form action="{{ url('updateTypeHall', $data->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="text" name="type" value="{{ $data->type }}" required>
                        <button type="submit" class="">تعديل</button>
                        </form>
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
