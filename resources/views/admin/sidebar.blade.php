<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ asset('/admincss/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Ammar Kready</h1>
            <p>admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
    <li ><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>الصفحة الرئيسية </a></li>
    <li><a href="{{ url('admin/category') }}"> <i class="icon-home"></i> التصنيفات</a></li>
    <li><a href="{{ url('admin/restaurant') }}"> <i class="icon-grid"></i>المطاعم </a></li>
    <li><a href="{{ url('admin/driver') }}"><i class="icon-grid"></i>السائقين </a></li>
    <li><a href="{{ url('admin/city') }}"><i class="icon-grid"></i>المدن</a></li>
    <li><a href="{{ url('admin/food') }}"><i class="icon-grid"></i>الاطعمة</a></li>
</ul>


        </ul>

      </nav>
