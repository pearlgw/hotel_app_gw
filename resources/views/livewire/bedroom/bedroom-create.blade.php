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
                <label for="category_bedrooms_id" class="form-label">Kategori Bedroom</label>
                <div class="input-group">
                    <select wire:model="category_bedrooms_id" class="form-control" id="category_bedrooms_id">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }} | Rp
                                {{ number_format($category->price, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_bedrooms_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <label for="title_bedroom" class="form-label mt-2">Title Bedroom</label>
                <div class="input-group">
                    <input wire:model='title_bedroom' type="text" class="form-control" id="title_bedroom"
                        placeholder="Masukkan nama kategori">
                </div>
                @error('title_bedroom')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <label for="description" class="form-label mt-2">Description</label>
                <input wire:model='description' type="text" class="form-control" id="description"
                    placeholder="Masukan deskripsi">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="mb-3 col-md-6">
                <label for="main_image_url" class="form-label">Main Image</label>
                <input type="file" wire:model="main_image_url" class="form-control" id="main_image_url">
                @error('main_image_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                @if ($main_image_url)
                    <div class="mt-2">
                        <img src="{{ $main_image_url->temporaryUrl() }}" class="img-thumbnail" width="250">
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Tambahkan Gambar Pendukung</label>

            <div class="row">
                {{-- Kolom Kiri: Input File --}}
                <div class="col-md-6">
                    @foreach ($image_url as $index => $url)
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="file" wire:model="image_url.{{ $index }}" class="form-control"
                                    accept="image/*">
                                <button type="button" class="btn btn-outline-danger ml-2"
                                    wire:click="removeImage({{ $index }})">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-info btn-sm" wire:click="addImage">
                        + Tambah Gambar
                    </button>

                    @error('image_url.*')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kolom Kanan: Preview Gambar --}}
                <div class="col-md-6">
                    @if (count($image_url) > 0)
                        <div class="d-flex overflow-auto gap-3 p-2 border rounded" style="white-space: nowrap;">
                            @foreach ($image_url as $index => $url)
                                @if (isset($image_url[$index]) && $image_url[$index])
                                    <div style="flex: 0 0 auto;">
                                        <img src="{{ $image_url[$index]->temporaryUrl() }}" class="img-thumbnail"
                                            style="height: 200px; object-fit: contain;" alt="Preview Gambar {{ $index + 1 }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <label class="form-label fw-bold">Fasilitas</label>
        <div class="row">
            {{-- WIFI --}}
            <div class="mb-3 col-md-3">
                <label class="form-label">Wifi</label>
                <div class="input-group">
                    <select wire:model="wifi" class="form-control">
                        <option value="">Pilih</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                @error('wifi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Elektronik --}}
            <div class="mb-3 col-md-3">
                <label class="form-label">Elektronik</label>
                <div class="input-group">
                    <select wire:model="elektronik" class="form-control">
                        <option value="">Pilih</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                @error('elektronik')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Swimming Pool --}}
            <div class="mb-3 col-md-3">
                <label class="form-label">Swimming Pool</label>
                <div class="input-group">
                    <select wire:model="swimming_pool" class="form-control">
                        <option value="">Pilih</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                @error('swimming_pool')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Gym --}}
            <div class="mb-3 col-md-3">
                <label class="form-label">Gym</label>
                <div class="input-group">
                    <select wire:model="gym" class="form-control">
                        <option value="">Pilih</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                @error('gym')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</div>
