@extends('layout')

@section('content')
<div class="table-responsive">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:40%">Product</th>
                <th style="width:20%">Price</th>
                <th style="width:15%">Quantity</th>
                <th style="width:20%" class="text-center">Subtotal</th>
                <th style="width:5%"></th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total+=$details['price'] * $details['quantity'] @endphp
                    <tr data-id ="{{ $id }}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{asset('img')}}/{{ $details['photo'] }}" width="80" height="80" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h6 class="nomargin">{{$details['product_name'] }}</h6>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{$details['price']}}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align:right;"><h4><strong>Total ${{ $total }}</strong></h4></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:right;">
                    <form action="/session" method="POST">
                        <a href="{{ url('/') }}" class="btn btn-secondary">Continue Shopping</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="btn btn-success" type="submit">Checkout</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    
    $(".cart_update").change(function (e) {
        e.preventDefault();
    
        var ele = $(this);
    
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
    
    $(".cart_remove").click(function (e) {
        e.preventDefault();
    
        var ele = $(this);
    
        if(confirm("Do you really want to remove?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    
</script>
@endsection
