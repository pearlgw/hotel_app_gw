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
                <label for="name" class="form-label mt-2">Name</label>
                <input wire:model='name' type="text" class="form-control" id="name"
                    placeholder="Masukkan nama">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="no_phone" class="form-label mt-2">No Phone</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input wire:model='no_phone' type="text" class="form-control" id="no_phone" placeholder="81234567890">
                </div>
                @error('no_phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="address" class="form-label mt-2">Address</label>
                <input wire:model='address' type="text" class="form-control" id="address"
                    placeholder="Masukan alamat">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</div>
