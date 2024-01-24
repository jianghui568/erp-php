

<table class="table table-bordered">
    <thead>
    <tr>
        <th>SKU</th>
        <th>库存</th>
        <th>进价</th>
        <th>售价</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model->sku as $sku)
        <tr>
            <td>{{$sku->sku}}</td>
            <td>{{$sku->stock}}</td>
            <td>{{$sku->purchase_price}}</td>
            <td>{{$sku->retail_price}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<style>
    /* custom.css */

    /* 表格样式 */
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table-custom th,
    .table-custom td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table-custom th {
        background-color: #f2f2f2;
    }

    /* 鼠标悬停样式 */
    .table-custom tbody tr:hover {
        background-color: #f5f5f5;
    }

</style>
