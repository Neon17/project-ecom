<div id="user-cart-modal" class="p-3 py-20 top-0 fixed left-1/3 w-1/3 min-h-screen z-50 hidden">

    <div class="p-5 w-full h-full bg-amber-50 shadow-lg">

        <div class="title text-2xl p-3 text-center flex items-center">
            <h2 class="flex-1 text-center">Cart</h2>
            <button id="close-user-cart-modal" class="hover:cursor-pointer text-gray-700">
                X
            </button>
        </div>

        @if ($carts->count() > 0)
            <table class="table-fixed border-separate p-3 w-3/4 my-10">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/6 border-r py-2">SN</th>
                        <th class="w-1/6 border-r py-2">Name</th>
                        <th class="w-1/6 border-r py-2">Price</th>
                        <th class="w-1/6 border-r py-2">Quantity</th>
                        <th class="w-1/6 border-r py-2">Description</th>
                        <th class="w-1/6 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td class="text-center p-2 px-5 border-r">1</td>
                            <td class="text-center p-2 px-5 border-r">{{ $cart->name }}</td>
                            <td class="text-center p-2 px-5 border-r">{{ $cart->price }}</td>
                            <td class="text-center p-2 px-5 border-r">{{ $cart->quantity }}</td>
                            <td class="text-center p-2 px-5 border-r">{{ substr($cart->description, 0, 20) }}</td>
                            <td class="text-center p-2 px-5 flex justify-center">
                                <a href="{{ route('users.carts.edit', ['cart' => $cart->id, 'user' => $user->id]) }}"
                                    class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">Edit</a>
                                <a href="{{ route('users.carts.show', ['cart' => $cart->id, 'user' => $user->id]) }}"
                                    class="p-2 bg-yellow-500 text-white mx-2 rounded hover:bg-yellow-700 transition-all duration-300">View</a>
                                <button
                                    class="open-delete-modal p-2 bg-red-500 text-white mx-2 rounded hover:bg-red-700 duration-300 transaction-all">Delete</button>
                                <x-ui.delete-modal action="{{ route('users.carts.destroy',['cart' => $cart->id, 'user' => $user->id]) }}" />
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        @else
            <div class="p-3 text-center pt-5 mt-5">
                <p>No carts found</p>
            </div>
        @endif



    </div>

</div>
