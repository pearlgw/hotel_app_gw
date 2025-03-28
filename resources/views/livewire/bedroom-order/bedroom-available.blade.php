<div>
    @if (session('success'))
        <div class="alert alert-success" id="flash-message">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.display = 'none';
                }
            }, 3000); // 5 detik
        </script>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="flash-message">
            {{ session('error') }}
        </div>

        <script>
            setTimeout(function() {
                let flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.display = 'none';
                }
            }, 3000); // 5 detik
        </script>
    @endif

    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>

    <div class="row">
        @forelse ($bedrooms as $bedroom)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $bedroom->main_image_url }}" class="card-img-top" alt="{{ $bedroom->title_bedroom }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bedroom->title_bedroom }}</h5>
                        <p class="card-text">Kategori: {{ $bedroom->category_bedroom->category_name }}</p>
                        <p class="card-text">Harga: Rp
                            {{ number_format($bedroom->category_bedroom->price, 0, ',', '.') }} / hari</p>
                        <button wire:click="reserv({{ $bedroom->id }})" wire:confirm="mau di reservasi?"
                            class="btn btn-primary">Tambahkan ke Reservasi</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Tidak ada kamar tersedia</div>
            </div>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $bedrooms->links() }}
    </div>
</div>
