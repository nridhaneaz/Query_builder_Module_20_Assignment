<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Update Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    </style>
  </head>
  <body>

    <div class="py-3 bg-dark">
      <h1 class="text-white h3">Product Update Page</h1>
    </div>

    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('products.index') }}" id="btn-create" class="btn btn-lite">Back</a>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg m-3">
            <div class="card-header bg-dark">
              <h3 class="text-center text-white">Update Product</h3>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="card-body">
                <div class="mb-3">
                  <label for="product_id" class="h3">Product_id</label>
                  <input type="text" class="form-control form-control-lg @error('product_id') is-invalid @enderror" placeholder="product_id" value="{{ old('product_id', $product->name) }}" name="product_id">
                  @error('product_id')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="h3">Name</label>
                  <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name', $product->name) }}" name="name">
                  @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>


                <div class="mb-3">
                  <label for="price" class="h3">Price</label>
                  <input type="text" class="form-control form-control-lg @error('price') is-invalid @enderror" placeholder="Price" value="{{ old('price', $product->price) }}" name="price">
                  @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>


                <div class="mb-3">
                  <label for="stock" class="h3">Stock</label>
                  <input type="text" class="form-control form-control-lg" placeholder="Stock" value="{{ old('stock', $product->stock) }}" name="stock">
                </div>


                <div class="mb-3">
                  <label for="description" class="h3">Description</label>
                  <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                </div>


                <div class="mb-3">
                  <label class="h3">Image</label>
                  <input type="file" class="form-control form-control-lg" name="image">
                  @if ($product->image)
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="w-50 mt-3">
                  @else
                    <img src="{{ asset('uploads/products/Untitled.png') }}" alt="Dummy Image" style="width: 50px; height: 50px; margin-top: 15px;">
                  @endif
                </div>


                <div class="d-grid">
                  <button class="btn btn-primary btn-lg">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>