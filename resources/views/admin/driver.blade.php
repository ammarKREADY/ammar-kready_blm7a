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
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
        }

        .page-header {
            padding: 25px 0;
            text-align: center;
        }

        .table-container {
            padding: 15px;
            margin: auto;
            max-width: 1000px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        .table thead {
            background-color: #198754;
            color: white;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        .btn {
            padding: 8px 16px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-select {
            padding: 8px;
            font-size: 14px;
        }

        .status-label {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
        }

        .status-waiting { background: #ffc107; color: black; }
        .status-on-way { background: #0dcaf0; color: white; }
        .status-complete { background: #198754; color: white; }
        .status-cancel { background: #dc3545; color: white; }

        @media (max-width: 768px) {
            h1 { font-size: 22px; }
            .btn, .form-select { font-size: 12px; }
            .table-container { padding: 10px; }
        }
    </style>
</head>
<body>
    @include('admin.header')

    <div class="page-content container">
        <div class="page-header">
            <h1 class="text-success">🚚 قائمة الطلبات الخاصة بك</h1>
        </div>

        <div class="table-container">
            @if(session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>👤 اسم العميل</th>
                        <th>📍 العنوان</th>
                        <th>📞 رقم الهاتف</th>
                        <th>🧾 الطلبات</th>
                        <th>💵 الإجمالي</th>
                        <th>🚦 الحالة</th>
                        <th>⚙️ الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone ?? 'غير متوفر' }}</td>
                            <td class="text-start">
                                @foreach($order->content as $item)
                                    <div>🍽️ {{ $item->food->name }} — <strong>{{ $item->quantity }}</strong></div>
                                @endforeach
                            </td>
                            <td>{{ number_format($order->total_price, 2) }} ر.س</td>
                            <td>
                                @if($order->status === 'waiting_acceptance')
                                    <span class="status-label status-waiting">بانتظار القبول</span>
                                @elseif($order->status === 'on_way')
                                    <span class="status-label status-on-way">في الطريق</span>
                                @elseif($order->status === 'confirm')
                                    <span class="status-label status-complete">تم التوصيل</span>
                                @elseif($order->status === 'cancel')
                                    <span class="status-label status-cancel">ملغي</span>
                                @else
                                    {{ ucfirst($order->status) }}
                                @endif
                            </td>
                            <td>
                                @if($order->status === 'waiting_acceptance')
                                    <form action="{{ route('driver.orders.accept', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">✅ قبول الطلب</button>
                                    </form>
                                @else
                                    <form action="{{ route('driver.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select mb-2" required>
                                            <option value="on_way" @if($order->status == 'on_way') selected @endif>🚗 في الطريق</option>
                                            <option value="confirm" @if($order->status == 'confirm') selected @endif>✅ تم التوصيل</option>
                                            <option value="cancel" @if($order->status == 'cancel') selected @endif>❌ ملغي</option>
                                        </select>
                                        <button type="submit" class="btn btn-success">💾 تحديث</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">لا توجد طلبات حالياً 📭</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>