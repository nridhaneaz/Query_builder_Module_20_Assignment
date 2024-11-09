<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;600&display=swap');
        body {
            font-family: "Oswald", sans-serif;

        }
        .product-image {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            cursor: pointer;
        }
        .product-image:hover {
            transform: scale(1.08);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-10 p-6 bg-white shadow-xl rounded-lg">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center border-b-2 pb-4">Product Details</h1>

    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10">

      
        <div class="w-full md:w-1/3">
            <a href="{{ $product->image ? asset($product->image) : asset('uploads/products/Untitled.png') }}" target="_blank">
                <img src="{{ $product->image ? asset($product->image) : asset('uploads/products/Untitled.png') }}"
                     alt="Product Image"
                     class="w-full h-auto object-cover rounded-lg shadow-md product-image">
            </a>
        </div>


        <div class="w-full md:w-2/3 mt-6 md:mt-0">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $product->name }}</h2>

            <p class="text-gray-700 mb-2"><span class="font-bold text-gray-800">Product ID:</span> {{ $product->product_id }}</p>
            <p class="text-gray-700 mb-2"><span class="font-bold text-gray-800">Price:</span> <span class="text-green-600">{{ $product->price }}৳</span></p>
            <p class="text-gray-700 mb-2"><span class="font-bold text-gray-800">Stock:</span> {{ $product->stock }}</p>
            <p class="text-gray-700 mb-2"><span class="font-bold text-gray-800">Description:</span> {{ $product->description }}</p>

            <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-5 py-2 rounded-md shadow hover:bg-blue-600 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Back to Product List
            </a>
        </div>
    </div>
</div>

</body>
</html>