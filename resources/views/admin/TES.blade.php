<div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>
                            اسم المنتج
                        </th>
                        <th>مقاس المنتج</th>

                        <th>وصف المنتج</th>
                        <th>نوع المنتج</th>
                        <th>صورة المنتج</th>
                        <th>سعر المنتج</th>
                        <th>العمليات</th>
                    </tr>
                    @foreach ($product as $products)
                    <tr>
                        <td>{{ $products->name }}</td>
                        <td>{{ $products->size }}</td>
                        <td>{{ $products->description }}</td>
                        <td>{{ $products->category->name }}</td>
                        <td>  @if($products->image)
                                            <img src="{{ $products->image->getUrl() }}" alt="Product Image" style="max-width: 100px;">
                                        @else
                                            لا توجد صورة
                                        @endif
                                        </td>

                        <td>{{ $products->price }}</td>
                        <td>
                        <form action="{{ url('deleteProduct', $products->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
             <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProductModal{{ $products->id }}">تعديل</button>

                    </td>
                    </tr>
                    @endforeach
                </table>
                @foreach ($product as $products)
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal{{ $products->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel{{ $products->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $products->id }}">تعديل المنتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('updateProduct', $products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>اسم المنتج</label>
                        <input type="text" name="name" class="form-control" value="{{ $products->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>الشرح</label>
                        <textarea name="description" class="form-control">{{ $products->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>المقاس</label>
                        <input type="text" name="size" class="form-control" value="{{ $products->size }}">
                    </div>
                    <div class="form-group">
                        <label>السعر</label>
                        <input type="number" name="price" class="form-control" step="0.01" value="{{ $products->price }}">
                    </div>
                    <div class="form-group">
                        <label for="productType">نوع المنتج</label>
                        <select id="productType" name="category_id" class="form-control">
                            @foreach($productType as $category)
                                <option value="{{ $category->id }}" @if($products->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>الصورة الحالية</label>
                        @if($products->media()->exists())
                            <img src="{{ $products->getFirstMediaUrl() }}" alt="Product Image" style="max-width: 100px;">
                        @else
                            <p>لا توجد صورة</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>الصورة الجديدة</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
