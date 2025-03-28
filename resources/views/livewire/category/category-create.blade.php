<div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>
            {{ $deskripsi }}
        </p>
    </div>
    <form wire:submit.prevent='save'>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="category_name" class="form-label">Nama Kategori</label>
                <div class="input-group">
                    <input wire:model='category_name' type="text" class="form-control" id="category_name" placeholder="Masukkan nama kategori">
                </div>
                @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="price" class="form-label">Price</label>
                <input wire:model='price' type="number" class="form-control" id="price" placeholder="10000">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
