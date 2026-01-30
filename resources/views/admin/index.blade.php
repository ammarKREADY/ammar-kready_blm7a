<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة الطلبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    @include('admin.css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .table-container {
            margin: 40px auto;
            padding: 20px;
            width: 95%;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        h4 {
            margin-bottom: 20px;
            color: #343a40;
            text-align: center;
            font-weight: 700;
        }

        table.table_deg {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            text-align: center;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
        }

        table.table_deg thead {
            background-color: #343a40;
            color: #ffffff;
        }

        table.table_deg thead th {
            padding: 14px 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table.table_deg tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.3s ease;
        }

        table.table_deg tbody tr:hover {
            background-color: #f9f9f9;
        }

        table.table_deg td {
            padding: 14px 12px;
            color: #444;
            vertical-align: middle;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 14px;
            color: #555;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
        }

        .status {
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 15px;
            display: inline-block;
            font-size: 13px;
            color: #fff;
        }

        .status.waiting_acceptance {
            background-color: #ffc107;
        }

        .status.on_way {
            background-color: #17a2b8;
        }

        .status.completed {
            background-color: #28a745;
        }

        .status.cancelled {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="table-container">
            <h4>قائمة الطلبات</h4>
            <table class="table_deg">
                <thead>
                    <tr>
                        <th>الزبون</th>
                        <th>السائق</th>
                        <th>العنوان</th>
                        <th>المطلوب</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->driver->user->name ?? 'غير محدد' }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                <div class="order-items">
                                    @foreach ($order->content as $item)
                                        <div class="order-item">
                                            <span>{{ $item->food->name }}</span>
                                            <span>× {{ $item->quantity }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ number_format($order->total_price, 2) }} ر.س</td>
                            <td>
                                <span class="status {{ strtolower(str_replace(' ', '_', $order->status)) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="color: #888;">لا توجد طلبات حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- سكريبتات -->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
</body>
</html>
