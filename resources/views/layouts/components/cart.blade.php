<li class="nav-item dropdown d-flex align-items-center">
    <a id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-dark btn btn-warning dropdown-toggle">
        <i class="fas fa-shopping-cart">
            <div class="ml-1 badge badge-pill badge-success" id="cart-size">
                {{ Auth::user()->getCart()->dishes->count() }}
            </div>
        </i>
    </a>    
    <div class="dropdown-menu dropdown-menu-right border border-success" aria-labelledby="cartDropdown">
        <ul class="list-group" id="cart-list">
            {{-- @foreach (Auth::user()->getCart()->dishes as $dish)
                <li class="list-group-item d-flex justify-content-between cart-item">
                    <div class="col-6">{{ $dish->name }}&nbsp;&nbsp;&nbsp;</div>
                    <div class="col-2">x{{ $dish->pivot->amount }}pcs.</div>
                    <div class="col-3">{{ $dish->pivot->amount * $dish->price }}zł</div>
                    <div class="col-1 delete-item" style="cursor: pointer;" data-url={{ route('cart.delete', $dish->id) }}><i class="fas fa-times-circle text-warning"></i></div>
                </li>    
            @endforeach --}}
            <li class="list-group-item bg-info text-dark text-center">
                <div class="col-12"><p class="m-0">Price: <strong class="cart-price">{{ Auth::user()->getCart()->getPrice() }}zł</strong></p></div>
                
            </li>
            <li class="list-group-item text-center">
                <div class="btn-group">
                    @if (Auth::user()->getCart()->dishes->count() > 0)
                    <a href="{{ route('order.create', Auth::user()->getCart()->id) }}" class="btn btn-info">Order</a>
                    @endif
                    <a href="{{ route('cart.clear') }}" class="btn btn-success">Clear</a>
                </div>
            </li>
        </ul>
    </div>                
</li>

@push('scripts')
    <script>
        function createElementFromHTML(htmlString) {
            var div = document.createElement('div');
            div.innerHTML = htmlString.trim();

            return div.firstChild; 
        }

        function deleteDish(){
            fetch(this)
                .then(function (){
                    reloadCart();
                });
        }

        function addDishToList(dish){
            element = createElementFromHTML(`
                <li class="list-group-item d-flex justify-content-between cart-item">
                    <div class="col-6">${dish['name']}&nbsp;&nbsp;&nbsp;</div>
                    <div class="col-2">x${dish['pivot']['amount']}pcs.</div>
                    <div class="col-3">${(dish['pivot']['amount'] * parseFloat(dish['price']).toFixed(2))}zł</div>
                    <div class="col-1 delete-item" style="cursor: pointer;" data-url="/cart/deleteItem/${dish['id']}"><i class="fas fa-times-circle text-warning"></i></div>
                </li>    
                `);
                // console.log(element.children[3]);
            element.children[3].onclick=deleteDish.bind(element.children[3].dataset.url);
            $('#cart-list').prepend(element);
        }


        function setCartSize(size){
            $('#cart-size').text(size)
        }

        function getCartItems(){
            fetch('/cart/getItems')
                .then(response => response.json())
                .then(function (cart){
                    setCartSize(cart['data']['dishes'].length)
                    cart['data']['dishes'].forEach(element => {
                        addDishToList(element);
                    });
                });
        }
        
        function setCartPrice(){
            fetch('/cart/getPrice')
                .then(response => response.json())
                .then(function(price){   
                    $('.cart-price').text(price.toFixed(2) + 'zł');           
                })
        }

        function clearCart(){
            $('.cart-item').remove();
        }

        function reloadCart(){
            clearCart();
            getCartItems();
            setCartPrice();
        }

        $(document).ready(function(){
            getCartItems();
            $('.add-to-cart').click(function (e) { 
                e.preventDefault();
                fetch(this.dataset.url)
                .then(function(){
                    $('.cart-item').remove();
                    reloadCart();
                })
            });
        });
    </script>   
@endpush