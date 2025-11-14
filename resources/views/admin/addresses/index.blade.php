<x-layouts.admin>

    <div class="title text-2xl p-3">
        Addresses
    </div>

    {{-- Table Design --}}
    <table class="table-fixed border-separate p-3 w-3/4 my-10">
        <thead class="bg-gray-200">
            <tr>
                <th class="w-1/6 border-r py-2">SN</th>
                <th class="w-1/6 border-r py-2">Country</th>
                <th class="w-1/6 border-r py-2">City</th>
                <th class="w-1/6 border-r py-2">State</th>
                <th class="w-1/6 border-r py-2">User</th>
                <th class="w-1/6 py-2">Street Address 1</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center p-2 px-5 border-r">1</td>
                <td class="text-center p-2 px-5 border-r">Nepal</td>
                <td class="text-center p-2 px-5 border-r">Hemja</td>
                <td class="text-center p-2 px-5 border-r">4</td>
                <td class="text-center p-2 px-5 border-r">Shyam Gautam</td>
                <td class="text-center p-2 px-5 flex justify-center">
                    Street 2
                </td>
            </tr>
            <tr>
                <td class="text-center p-2 px-5 border-r">2</td>
                <td class="text-center p-2 px-5 border-r">Nepal</td>
                 <td class="text-center p-2 px-5 border-r">Tudikhel</td>
                  <td class="text-center p-2 px-5 border-r">3</td>
                <td class="text-center p-2 px-5 border-r">Ramesh Pandey</td>
                <td class="text-center p-2 px-5 flex justify-center">
                  Street 3
                </td>
            </tr>

        </tbody>

    </table>



</x-layouts.admin>
