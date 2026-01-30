@extends('user.component.app')

@section('content')
<div class="container py-5" style="max-width: 900px;">

    <h2 class="mb-5 text-center fw-bold text-primary">📋 قائمة الطلبات</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(empty($orders) || count($orders) == 0)
        <div class="alert alert-warning text-center">🚨 لا يوجد طلبات في السلة حاليا.</div>
    @else
        <form action="{{ route('orders.submit') }}" method="post" class="shadow-sm p-4 rounded bg-white border">
            @csrf
            
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">📌 المنتج</th>
                        <th scope="col">💰 السعر</th>
                        <th scope="col" style="width: 120px;">🔢 الكمية</th>
                        <th scope="col" style="width: 90px;">❌ حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($orders as $index => $order)
                        @php $total += $order['price'] * $order['quantity']; @endphp
                        <tr>
                            <td class="align-middle">{{ $order['food_name'] }}</td>
                            <td class="align-middle">{{ number_format($order['price'], 2) }} $</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="orders[{{ $index }}][quantity]" 
                                    value="{{ $order['quantity'] }}" 
                                    min="1" 
                                    class="form-control text-center quantity" 
                                    data-price="{{ $order['price'] }}" 
                                    aria-label="كمية {{ $order['food_name'] }}">
                                <input type="hidden" name="orders[{{ $index }}][food_id]" value="{{ $order['food_id'] }}">
                                <input type="hidden" name="orders[{{ $index }}][food_name]" value="{{ $order['food_name'] }}">
                                <input type="hidden" name="orders[{{ $index }}][price]" value="{{ $order['price'] }}">
                            </td>
                            <td>
                                <button type="button" 
                                        class="btn btn-danger btn-sm remove-order" 
                                        data-index="{{ $index }}" 
                                        aria-label="حذف {{ $order['food_name'] }}">
                                    🗑️ حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">💵 المجموع الكلي: <span id="totalAmount">{{ number_format($total, 2) }}</span> $</h4>
                <small class="text-muted">* السعر شامل تكلفة السائق عند الاختيار</small>
            </div>

            <div class="mb-4">
                <label for="driverSelect" class="form-label fw-bold">🚗 اختر السائق</label>
                <select required id="driverSelect" name="driver_id" class="form-select" aria-required="true" aria-describedby="driverHelp">
                    <option value="" disabled selected>اختر سائقًا</option>
                    @foreach ($driver as $item)
                        <option value="{{ $item->id }}" 
                                data-driver_cost="{{ $item->driver_cost }}" 
                                data-vehicle="{{ $item->vehicle }}">
                            {{ $item->user->name }} — تكلفة: {{ number_format($item->driver_cost, 2) }} — {{ $item->vehicle }}
                        </option>
                    @endforeach
                </select>
                <div id="driverHelp" class="form-text">اختيار السائق سيضاف تكلفة التوصيل للمجموع.</div>
            </div>

            <div class="mb-4">
                <label for="phone" class="form-label fw-bold">📞 رقم الهاتف</label>
                <input required type="tel" id="phone" name="phone" class="form-control" placeholder="أدخل رقم هاتفك" pattern="[0-9+\s\-]{6,20}" aria-required="true">
                <div class="form-text">سيتم مشاركة رقم الهاتف مع السائق لتسهيل التواصل.</div>
            </div>

            <div class="mb-4">
                <label for="address" class="form-label fw-bold">🏠 العنوان</label>
                <input required type="text" id="address" name="address" class="form-control" placeholder="أدخل عنوان التوصيل">
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success btn-lg px-4">🚀 إرسال الطلبات</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">تسجيل خروج</button>
                </form>
            </div>
        </form>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // تحديث المجموع الكلي عند تغيير الكمية أو السائق
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.quantity').forEach(input => {
            let price = parseFloat(input.dataset.price);
            let quantity = parseInt(input.value) || 0;
            total += price * quantity;
        });

        // إضافة تكلفة السائق إن وجدت
        const driverSelect = document.getElementById('driverSelect');
        const selectedOption = driverSelect.options[driverSelect.selectedIndex];
        if(selectedOption && selectedOption.dataset.driver_cost) {
            total += parseFloat(selectedOption.dataset.driver_cost);
        }

        document.getElementById('totalAmount').textContent = total.toFixed(2);
    }

    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', updateTotal);
    });

    document.getElementById('driverSelect').addEventListener('change', updateTotal);

    // حذف عنصر من الطلبات عبر AJAX
    document.querySelectorAll('.remove-order').forEach(button => {
        button.addEventListener('click', function () {
            const index = this.dataset.index;
            fetch("{{ route('orders.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ index })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            })
            .catch(console.error);
        });
    });
});
</script>
@endsection
