@extends('layouts.app')
@section('content')
<div class="row mx-5">
    <div class="col-8">
        <ul class="list-group">
            @foreach ($orders as $order)
                <button type="button" data-target="#order-history-modal" id="{{ $order->id }}" class="modal-button list-group-item neon d-flex flex-row justify-content-between text-decoration-none text-success">
                    <div class="">
                        <strong>Order #{{ $order->id }}</strong><p>Price: {{ $order->getPrice() }}zł</p>
                    </div>
                    <div class="">
                        <p>{{ $order->created_at }}</p>
                    </div>
                </button>
            @endforeach
        </ul>
    </div>
    <div class="col-4">
        <div class="card text-center">
            <div class="card-header">Summary</div>
            <div class="card-body">
                <h5>Total orders</h5>
                <p class="lead">{{ $orders->count() }}</p>
                <hr>
                <h5>Total money spent</h5>
                <p class="lead">{{ number_format($orders->pluck('orderItems')->flatten()->pluck('cost')->sum(), 2) }}zł</p>
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="order-history-modal" tabindex="-1" aria-labelledby="order-history-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="h4">Ordered items:</div>
            <ul class="list-group detail-list">

            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.modal-button', function (e) {
            console.log(e);
            $('.detail-list').empty(); 
            $.ajax({
                type: "GET",
                url: `/catering/order/${e.target.id}`,
                success: function (response) {
                    $('.modal-title').html('Order #' + response['data']['id']);
                    response['data']['order_items'].forEach(element => {
                        console.log(element);
                        $('.detail-list').append(`<li class="list-group-item border border-secondary d-flex justify-content-between">
                            <strong>${element['dish']['name']} x${element['amount']}</strong><small>${element['price'] * element['amount']}zł</small>
                        </li>`)
                    });
                }
            });
            $('#order-history-modal').modal();
            console.log();
        });

        function closeModal(){
            $('#order-history-modal').hide();
        }
    </script>
@endsection