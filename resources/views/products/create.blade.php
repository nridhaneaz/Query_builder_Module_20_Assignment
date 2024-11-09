<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
      #btn-create {
        background: rgb(0, 0, 0);
        color: white;
        margin-right: 10px;
      }
      #btn-create:hover {
        background: transparent;
        border: solid 0.5px black;
        color: rgb(0, 0, 0);
      }

      body{
        font-family: 'Poppins', sans-serif;
      }
    </style>
  </head>
  <body >

    <div class="py-3 bg-blue-800">
        <h1 class="text-white text-lg font-semibold text-center">Product Create Page</h1>
    </div>

    <div class="container mx-auto px-4">
        <div class="flex justify-center mt-4">

            <div class="w-full md:w-10/12 flex justify-end">
                <a href="{{ route('products.index') }}" id="btn-create" class="px-4 py-2 border border-transparent rounded">Back</a>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-full md:w-10/12">
                    <div class="bg-white shadow-lg rounded-lg m-3">
                            <div class="bg-blue-800 rounded-t-lg">
                                <h2 class="ml-1 text-white text-lg font-bold py-3 " >Create Product</h2>
                            </div>

                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="p-6">
                                @csrf
                                <div class="mb-4">
                                    <label for="product_id" class="block text-lg font-medium">Product_id</label>
                                    <input type="text" class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg @error('product_id') border-red-500 @enderror" placeholder="product_id" value="{{ old('product_id') }}" name="product_id">
                                    @error('product_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="block text-lg font-medium">Name</label>
                                    <input type="text" class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg @error('name') border-red-500 @enderror" placeholder="Name" value="{{ old('name') }}" name="name">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="Price" class="block text-lg font-medium">Price</label>
                                    <input type="text" class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg @error('price') border-red-500 @enderror" placeholder="Price" value="{{ old('price') }}" name="price">
                                    @error('price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="Stock" class="block text-lg font-medium">Stock</label>
                                    <input type="text" class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Stock" value="{{ old('stock') }}" name="stock">
                                </div>

                                <div class="mb-4">
                                    <label for="Description" class="block text-lg font-medium">Description</label>
                                    <textarea name="description" class="form-textarea mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-lg font-medium">Image</label>
                                    <input type="file" class="form-input mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg" name="image">
                                </div>

                                <div class="flex justify-center ">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-20 rounded-lg text-lg ">Create</button>
                                </div>
                            </form>
                    </div>
            </div>
        </div>
    </div>

  </body>
</html>