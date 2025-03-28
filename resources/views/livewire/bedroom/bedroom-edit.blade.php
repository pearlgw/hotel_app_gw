<div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>

    <form wire:submit.prevent='update'>
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="mb-3 col-md-6">
                <label class="form-label">Kategori Bedroom</label>
                <select wire:model="category_bedrooms_id" class="form-control">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->category_name }} | Rp {{ number_format($category->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('category_bedrooms_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <label class="form-label mt-2">Judul Bedroom</label>
                <input wire:model='title_bedroom' type="text" class="form-control"
                    placeholder="Masukkan nama bedroom">
                @error('title_bedroom')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <label class="form-label mt-2">Deskripsi</label>
                <input wire:model='description' type="text" class="form-control" placeholder="Masukkan deskripsi">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Kolom Kanan --}}
            <div class="mb-3 col-md-6">
                <label class="form-label">Main Image</label>
                <input type="file" wire:model="main_image_url" class="form-control">
                @error('main_image_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                {{-- Tampilkan preview untuk gambar baru yang diupload --}}
                @if (is_object($main_image_url))
                    <div class="mt-2">
                        <img src="{{ $main_image_url->temporaryUrl() }}" class="img-thumbnail" width="250">
                    </div>
                    {{-- Tampilkan gambar lama jika tidak ada upload baru --}}
                @elseif ($oldmain_image_url)
                    <div class="mt-2">
                        <img src="{{ $oldmain_image_url }}" class="img-thumbnail" width="250">
                    </div>
                @endif

            </div>
        </div>

        {{-- Tambah Gambar Pendukung --}}
        <div class="mb-4">
            <label class="form-label fw-bold">Tambahkan Gambar Pendukung</label>
            <div class="row">
                <div class="col-md-6">
                    @foreach ($image_url as $index => $url)
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="file" wire:model="image_url.{{ $index }}" class="form-control"
                                    accept="image/*">
                                <button type="button" class="btn btn-outline-danger ml-2"
                                    wire:click="removeImage({{ $index }})">Hapus</button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-info btn-sm" wire:click="addImage">
                        + Tambah Gambar
                    </button>

                    {{-- OLD IMAGES PREVIEW --}}
                    <div class="mt-3 d-flex gap-2 flex-nowrap overflow-auto p-2 border rounded" style="white-space: nowrap;">
                        @foreach ($old_images as $img)
                            <div class="position-relative mr-2" style="width: 120px; height: 120px; flex: 0 0 auto;">
                                <img src="{{ $img['image_url'] }}" alt="Gambar lama" class="rounded w-100 h-100"
                                    style="object-fit: cover;">
                                <button type="button" wire:click="deleteOldImage({{ $img['id'] }})"
                                    wire:confirm="Are you sure delete this image ?"
                                    class="btn btn-sm btn-danger position-absolute"
                                    style="top: 5px; right: 5px; padding: 2px 6px; font-size: 14px; line-height: 1;">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>

                    @error('image_url.*')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    @if (count($image_url) > 0)
                        <div class="d-flex overflow-auto gap-3 p-2 border rounded" style="white-space: nowrap;">
                            @foreach ($image_url as $index => $url)
                                @if (isset($image_url[$index]) && is_object($image_url[$index]))
                                    <div style="flex: 0 0 auto;">
                                        <img src="{{ $image_url[$index]->temporaryUrl() }}" class="img-thumbnail"
                                            style="height: 200px; object-fit: contain;"
                                            alt="Preview {{ $index + 1 }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Fasilitas --}}
        <label class="form-label fw-bold">Fasilitas</label>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label class="form-label">Wifi</label>
                <select wire:model="wifi" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('wifi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label class="form-label">Elektronik</label>
                <select wire:model="elektronik" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('elektronik')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label class="form-label">Kolam Renang</label>
                <select wire:model="swimming_pool" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('swimming_pool')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-3">
                <label class="form-label">Gym</label>
                <select wire:model="gym" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('gym')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Tombol Update --}}
        <button type="submit" class="btn btn-success">Update</button>
        <a wire:navigate href="/bedroom" class="btn btn-secondary">Kembali</a>
    </form>
</div>
