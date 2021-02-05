@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> {{ $data['order']->customer_name }}.
                                <small class="float-right">Date: {{ date('d M Y', strtotime($data['order']->created_at)) }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $data['order']->customer_name }}</strong>
                                @if ($data['order']->customer_address)
                                <br>
                                {{ $data['order']->customer_address }}
                                @endif
                                @if ($data['order']->customer_phone)
                                <br>
                                Phone: {{ $data['order']->customer_phone }}
                                @endif
                                @if ($data['order']->customer_email)
                                <br>
                                Email: {{ $data['order']->customer_email }}
                                @endif
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #{{ $data['order']->id }}</b><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th><span class="sr-only">action</span></th>
                                    </tr>
                                </thead>
                                <tbody id="products_in_order">
                                    @if ($data['products']->count())
                                        @foreach ($data['products'] as $product)
                                            <tr id="product_{{ $product->orders_products_id }}_row">
                                                <td>{{ $product->category_title }}</td>
                                                <td>{{ $product->title }}</td>
                                                <td>{{ $product->total_sup_price/$product->quantity }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->total_sup_price }}</td>
                                                <td><button class="btn btn-danger" id="add_product_{{ $product->id }}" onclick="removeProduct({{ $product->orders_products_id }})"> <i class="fa fa-minus"></i> </button></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control select2" style="width: 100%;" onchange="getProducts()" id="category" required>
                                                    <option selected="selected">-- select category --</option>
                                                    @foreach ($data['categories'] as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" >
                                                <select class="form-control select2" style="width: 100%;" onchange="getPrice()" id="product_select" required>
                                                    <option selected="selected">-- select product --</option>

                                                </select>
                                            </div>
                                        </td>
                                        <td><span id="price"></span></td>
                                        <td><div class="form-group">
                                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" onkeyup="caculateSubTotal()" required>
                                        </div></td>
                                        <td><span id="sub_total"></span></td>
                                        <td> <button class="btn btn-success" id="add_product" onclick="addProduct()"> <i class="fa fa-plus"></i> </button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row d-flex justify-content-betwen">

                        <!-- /.col -->
                        <div class="col-4">
                            <p class="lead">Date : {{ date('d M Y', strtotime($data['order']->updated_at)) }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Total:</th>
                                        <td id="total_cost">{{ $data['total_cost'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid:</th>
                                        <td id="total_paied">{{ $data['total_paid'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>remain:</th>
                                        <td id="remain">{{ $data['total_cost']-$data['total_paid'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <p class="lead">Submit Payment</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Payment Amount:</th>
                                        <td id="payment_amount_td">
                                            <input type="number" class="form-control" id="payment_amount" name="payment_amount" placeholder="Payment Amount" required max="{{ $data['total_cost']-$data['total_paid'] }}" min="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Note:</th>
                                        <td id="note_td">
                                            <textarea name="note" id="note" class="form-control" rows="2" placeholder="Note" required></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button id="submit_pay" type="button" class="btn btn-success float-right" onclick="submitPay()">
                                <i class="far fa-credit-card"></i>
                                Submit Payment
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(function ($) {
        //Initialize Select2 Elements
        $('.select2').select2();

    });

    function getProducts(){
        let categorySelect = document.querySelector("#category");
        let categoryID = categorySelect.options[categorySelect.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: '/products/get_products',
            data: { category_id: categoryID, _token: '{{csrf_token()}}' },
            success: function (data) {
                let productSelect = document.querySelector('#product_select');
                data.forEach(optionP => {
                    var optionCe = document.createElement("OPTION");
                    var textValue = document.createTextNode(optionP['title']);
                    optionCe.setAttribute("value", optionP['id']);
                    optionCe.appendChild(textValue);
                    productSelect.appendChild(optionCe);
                });
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        });
    };

    function getPrice(){
        let productSelect = document.querySelector("#product_select");
        let id = productSelect.options[productSelect.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: '/products/get_price',
            data: { id: id, _token: '{{csrf_token()}}' },
            success: function (data) {
                let pricePlace = document.querySelector('#price').innerHTML = data['price'];
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });

    };

    function caculateSubTotal(){
        let quantity = document.querySelector("#qty").value;
        let price = document.querySelector("#price").innerHTML;

        let subTotal = document.querySelector("#sub_total").innerHTML = quantity * price;

    }

    function removeProduct(id) {
        $.ajax({
            type: "POST",
            url: '/products/delete_product',
            data: {
                _token: '{{csrf_token()}}',
                order_products_id: id,

            },
            success: function (data) {

                $('#product_' + id +  '_row').remove();
                document.querySelector('#remain').innerHTML = data['total_cost'] - data['total_paied'];
                document.querySelector('#total_paied').innerHTML = data['total_paied'];
                document.querySelector('#total_cost').innerHTML = data['total_cost'];
                document.querySelector('#payment_amount').setAttribute("max", data['total_cost']);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }
    function addProduct() {
        let productSel = document.querySelector('#product_select');
        let productId = productSel.options[productSel.selectedIndex].value;
        let orderId = {{ $data['order']->id }};
        let quantity = document.querySelector('#qty').value;

        $.ajax({
            type: "POST",
            url: '/products/add_product',
            data: {
                _token: '{{csrf_token()}}',
                order_id: orderId,
                product_id: productId,
                quantity: quantity
            },
            success: function (data) {

                let products_in_order = document.querySelector('#products_in_order');
                console.log(data);
                var newRow = '<tr id="product_' + data['product']['product_id'] +'_row"><td>' + data['product']['category_title'] + '</td><td>' + data['product']['title'] + '</td><td>' + data['product']['price'] + '</td><td>' + data['product']['quantity'] + '</td><td>' + data['product']['total_sup_price'] + '</td><td><button class="btn btn-danger" id="add_product_' + data['product']['product_id'] +'" onclick="removeProduct(' + data['product']['product_id'] +')"> <i class="fa fa-minus"></i> </button></td></tr>';

                document.querySelector('#qty').value = 0;
                document.querySelector('#sub_total').innerHTML = 0;

                $('#products_in_order').append(newRow);

                document.querySelector('#remain').innerHTML = data['total_cost'] - data['total_paied'];
                document.querySelector('#total_paied').innerHTML = data['total_paied'];
                document.querySelector('#total_cost').innerHTML = data['total_cost'];
                document.querySelector('#payment_amount').setAttribute("max", data['total_cost']);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }

    function submitPay() {
        let paymentAmount = document.querySelector('#payment_amount').value;
        let paymentNote = document.querySelector('#note').value;
        let orderId = {{ $data['order']->id }};

        $.ajax({
            type: "POST",
            url: '/transactions',
            data: {
                _token: '{{csrf_token()}}',
                order_id: orderId,
                payment_note: paymentNote,
                payment_amount: paymentAmount
            },
            success: function (data) {

                console.log(data);

                document.querySelector('#payment_amount').value = 0;
                document.querySelector('#note').value = '';

                document.querySelector('#remain').innerHTML = data['remain'];
                document.querySelector('#total_paied').innerHTML = data['total_paied'];
                document.querySelector('#total_cost').innerHTML = data['total_cost'];
                document.querySelector('#payment_amount').setAttribute("max", data['remain']);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }
</script>
@endsection
