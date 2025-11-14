<x-layouts.admin>

    <div class="text-2xl p-3 ms-2">
        Dashboard
    </div>

    {{-- We have to show total number of orders completed, pending, processed, cancelled --}}
    {{-- We have to show total number of products --}}
    {{-- We have to show total number of users --}}
    {{-- We have to show total number of categories --}}
    {{-- We have to show total number of payments --}}

    <div class="stats-collection flex">
        
        <div class="p-3 max-w-60 shadow-lg bg-gray-50 m-3">
            <div class="widget-heading text-xl text-center my-3">General Stats</div>
            <h2 class="text px-2">Total Orders: 5</h2>
            <h2 class="text px-2">Orders Cancelled: 5</h2>
            <h2 class="text px-2">Total Products: 15 </h2>
            <h2 class="text px-2">Total Users: 2</h2>
            <h2 class="text px-2">Total Categories: 5</h2>
        </div>
    
        <div class="p-3 max-w-60 shadow-lg bg-gray-50 m-3">
            <div class="widget-heading text-xl text-center my-3">Order Stats</div>
            <h2 class="text px-2">Order Completed: 5</h2>
            <h2 class="text px-2">Orders Pending: 5</h2>
            <h2 class="text px-2">Orders Processed: 5</h2>
        </div>
    
        <div class="p-3 max-w-50 shadow-lg bg-gray-50 m-3">
            <div class="widget-heading text-xl text-center my-3">Payment Stats</div>
            <h2 class="text px-2">Pending: 5</h2>
            <h2 class="text px-2">Completed: 5</h2>
            <h2 class="text px-2">Failed: 5</h2>
        </div>

    </div>


    <div class="p-3 shadow-lg bg-gray-50 max-w-7xl m-3">
        <h2 class="text-2xl">Recent Orders</h2>
        <table class="table-fixed border-separate p-3 w-3/4 my-10">

            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/6 border-r py-2">SN</th>
                    <th class="w-1/6 border-r py-2">User Name</th>
                    <th class="w-1/6 border-r py-2">Address</th>
                    <th class="w-1/6 border-r py-2">Payment Status</th>
                    <th class="w-1/6 border-r py-2">Order Status</th>
                    <th class="w-1/6 py-2">Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="p-3 shadow-lg bg-gray-50 max-w-7xl m-3">

        <h2 class="text-2xl">Recent Payments</h2>
        <table class="table-fixed border-separate p-3 w-3/4 my-10">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/6 border-r py-2">SN</th>
                    <th class="w-1/6 border-r py-2">User Name</th>
                    <th class="w-1/6 border-r py-2">Payment Method</th>
                    <th class="w-1/6 border-r py-2">Transaction Code</th>
                    <th class="w-1/6 border-r py-2">Status</th>
                    <th class="w-1/6 py-2">Actions</th>
                </tr>
            </thead>

        </table>

    </div>



</x-layouts.admin>
