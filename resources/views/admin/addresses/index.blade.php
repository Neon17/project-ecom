<x-layouts.admin>

    <div class="title text-2xl p-3">
        Addresses
    </div>

    @if (!$addresses->isEmpty())
        <table class="min-w-full my-10">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/6 py-2">SN</th>
                    <th class="w-1/6 py-2">Country</th>
                    <th class="w-1/6 py-2">City</th>
                    <th class="w-1/6 py-2">State</th>
                    <th class="w-1/6 py-2">User</th>
                    <th class="w-1/6 py-2">Street Address 1</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($addresses as $address)
                    <tr class="table-row hover:bg-gray-300 transition-colors">
                        <td class="text-center p-2 px-5">{{$loop->iteration}}</td>
                        <td class="text-center p-2 px-5">{{$address->country}}</td>
                        <td class="text-center p-2 px-5">{{$address->city}}</td>
                        <td class="text-center p-2 px-5">{{$address->state}}</td>
                        <td class="text-center p-2 px-5">{{$address->user->name}}</td>
                        <td class="text-center p-2 px-5 flex justify-center">
                            {{$address->street_address_1}}
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @else
        <div class="p-3 text-center my-5 text-xl">
            No address found
        </div>
    @endif



</x-layouts.admin>
