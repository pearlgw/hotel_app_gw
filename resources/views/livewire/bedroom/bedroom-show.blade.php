<div class="">
    <a wire:navigate href="/bedroom" class="btn btn-info mb-4">
        Kembali
    </a>

    <div class="row">
        <!-- Kiri: Gambar utama dan tambahan -->
        <div class="col-md-6">
            <div class="mb-3">
                <img src="{{ $main_image_url }}" alt="Main Image" class="img-fluid rounded shadow">
            </div>

            <div class="mb-3" style="overflow-x: auto; white-space: nowrap;">
                @foreach ($image_url as $img)
                    <img src="{{ is_object($img) ? $img->image_url : $img }}" class="img-thumbnail me-2" style="height: 120px; object-fit: cover; display: inline-block;">
                @endforeach
            </div>
        </div>

        <!-- Kanan: Informasi -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Bedroom</th>
                    <td>{{ $code_bedroom }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $category_bedrooms_id }}</td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>{{ $title_bedroom }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $description }}</td>
                </tr>
                <tr>
                    <th>Ketersediaan</th>
                    <td>{{ $is_available ? 'Ada' : 'Tidak' }}</td>
                </tr>
                <tr>
                    <td colspan="2">Fasilitas</td>
                </tr>
                <tr>
                    <th>Wifi</th>
                    <td>{{ $wifi ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr>
                    <th>Elektronik</th>
                    <td>{{ $elektronik ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr>
                    <th>Kolam Renang</th>
                    <td>{{ $swimming_pool ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr>
                    <th>Gym</th>
                    <td>{{ $gym ? 'Ya' : 'Tidak' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
