<div>
    <div class="py-3 py-md-5 ">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $item)
                            @if ($item->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('collections/'.$item->product->category->slug.'/'.$item->product->slug) }}">
                                                <label class="product-name">
                                                    @if ($item->product->productImages)
                                                    <img src="{{ asset($item->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="">
                                                    @else
                                                    <img src="" style="width: 50px; height: 50px" alt="">
                                                    @endif
                                                    {{ $item->product->name }}
                                                    @if ($item->productColor)
                                                        <br/>
                                                        @if ($item->productColor->color)
                                                        <span>Color: {{ $item->productColor->color->name }}</span>   
                                                        @endif
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{ $item->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disable" wire:click="decrementQuantity({{ $item->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $item->quantity }}" class="input-quantity" />
                                                    <button type="button" wire:loading.attr="disable" wire:click="incrementQuantity({{ $item->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{ $item->product->selling_price * $item->quantity }} </label>
                                            @php
                                                $totalPrice += $item->product->selling_price * $item->quantity
                                            @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disable" wire:click="removeCartItem({{ $item->id }})" class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem({{ $item->id }})">
                                                        <i class="fa fa-trash"></i> Removing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endif
                        @empty
                            No Items In Your Cart
                        @endforelse

                                
                    </div>
                </div>
            </div>

            @if ($cart)
                <div class="row">
                    <div class="col-md-8 my-md-auto mt-3">
                        <h4>
                        <a class="btn" href="{{ url('/collections') }}"></a> 
                        </h4>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="shadow-sm bg-white p-3">
                            <h4>Total:
                                <span>${{ $totalPrice }}</span>
                            </h4>
                            <hr>
                            <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Buy Now</a>
                        </div>
                    </div>
                </div>
            @else
                
            @endif

        </div>
    </div>
</div>
