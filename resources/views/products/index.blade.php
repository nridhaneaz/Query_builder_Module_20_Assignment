<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.all.min.js" integrity="sha512-m4zOGknNg3h+mK09EizkXi9Nf7B3zwsN9ow+YkYIPZoA6iX2vSzLezg4FnW0Q6Z1CPaJdwgUFQ3WSAUC4E/5Hg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .description-column {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            position: relative;
        }
        .description-column:hover::after {
            content: attr(data-full-description);
            position: absolute;
            background-color: rgba(190, 28, 28, 0.8);
            color: #eee6e6;
            padding: 10px;
            border-radius: 5px;
            top: 100%;
            left: 0;
            white-space: normal;
            width: 300px;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="py-3 bg-blue-800 shadow-lg">
        <h1 class="text-white text-2xl font-bold text-center">Products</h1>
    </div>

    <div class="container mx-auto py-4">
        @if(Session::has('success'))
            <script>
                $(document).ready(function() {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif
        @if(Session::has('delete'))
            <script>
                $(document).ready(function() {
                    toastr.success("{{ session('delete') }}");
                });
            </script>
        @endif

        <div class="flex justify-center mt-4">
            <form action="{{ route('products.index') }}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Search products..."
                       class="border border-gray-300 p-2 rounded-l" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white px-4 rounded-r hover:bg-blue-600">Search</button>
            </form>
        </div>


        <div class="flex justify-center mt-5 space-x-2">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row items-center mb-3">
                <select name="sort" class="form-select p-2 border border-gray-300 rounded-md md:mr-2 mb-2 md:mb-0">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">
                    Filter
                </button>
            </form>

        </div>

        <div class="flex justify-center mt-8">
            <div class="w-full max-w-5xl">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-blue-800 p-4 flex justify-between items-center">
                        <h3 class="text-white text-xl">Product List</h3>
                        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            <i class="fa fa-plus mr-2"></i> Add New Product
                        </a>
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="min-w-full border border--200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-200 px-4 py-2">ID</th>
                                    <th class="border border-gray-200 px-4 py-2">Product ID</th>
                                    <th class="border border-gray-200 px-4 py-2">Image</th>
                                    <th class="border border-gray-200 px-4 py-2">Name</th>
                                    <th class="border border-gray-200 px-4 py-2">Price</th>
                                    <th class="border border-gray-200 px-4 py-2">Stock</th>
                                    <th class="border border-gray-200 px-4 py-2">Description</th>
                                    <th class="border border-gray-200 px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->isNotEmpty())
                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $product->id }}</td>
                                        <td class="border px-4 py-2">{{ $product->product_id }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                <img src="{{ $product->image ? asset($product->image) : 'https://via.placeholder.com/150' }}" alt="Product Image" class="w-12 h-12 rounded shadow-md">
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:underline">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2">{{ $product->price }}৳</td>
                                        <td class="border px-4 py-2">{{ $product->stock }}</td>
                                        <td class="border px-4 py-2 description-column" data-full-description="{{ $product->description }}">
                                            {{ Str::limit($product->description, 20) }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 text-white py-1 px-2 rounded hover:bg-blue-600" title="Update">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <form id="delete-product-form{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button onclick="confirmation(event, {{ $product->id }})" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center py-4">No products available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmation(ev, id) {
            ev.preventDefault();
            var form = document.getElementById('delete-product-form' + id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>


</body>
</html>