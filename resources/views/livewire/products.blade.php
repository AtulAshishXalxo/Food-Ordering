<div class="container card p-4 shadow p-3 mb-5 bg-white rounded">
    
    <form action="{{ route('orders.store') }}" method="POST">
    @csrf
    
    <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
            Customer name
            <input type="text" name="customer_name" class="form-control"
                   value="{{ old('customer_name') }}" required>
            @if($errors->has('customer_name'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_name') }}
                </em>
            @endif
        </div>

        <div class="form-group mt-3 {{ $errors->has('customer_email') ? 'has-error' : '' }}">
            Customer email
            <input type="email" name="customer_email" class="form-control"
                   value="{{ old('customer_email') }}">
            @if($errors->has('customer_email'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_email') }}
                </em>
            @endif
        </div>

        <div class="container card p-3 mt-3 shadow-sm p-3 mb-5 bg-white rounded">
            
            <strong>Products</strong>
            <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col "><b class="">Product</b> </th>
                            <th scope="col"><b class="">Quantity</b> </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderProducts as $index => $orderProduct)
                        <tr>
                        
                            <td>
                                <select name="orderProducts[{{$index}}][product_id]"
                                        wire:model="orderProducts.{{$index}}.product_id"
                                        class="form-control">
                                    <option value="">-- choose product --</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} (${{ number_format($product->price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            
                                 <input type="number"
                                       name="orderProducts[{{$index}}][quantity]"
                                       class="form-control"
                                       wire:model="orderProducts.{{$index}}.quantity"
                                       value="{{$orderProduct['quantity']}}" />

                            </td>
                            <td>
                            
                            <a href="#" wire:click.prevent="removeProduct({{$index}})">Delete</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table> 
                
                <div>
                    <button class="btn btn-sm btn-secondary" wire:click.prevent="addProduct">+ more products</button>
                </div>
        </div>

        <div class="mt-2">
            <button type="submit" name="submit" class="btn btn-primary">save product</button>
        </div>
                
    </form>
</div>
