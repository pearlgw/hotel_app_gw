{{-- <div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>

    <form wire:submit.prevent='save'>
        <div class="row">
            @foreach ($details as $index => $detail)
                <div class="mb-3 col-md-6">
                    <label for="bedrooms_id_{{ $index }}" class="form-label">Pilih Kamar</label>
                    <div class="input-group">
                        <select wire:model="details.{{ $index }}.bedrooms_id" class="form-control"
                            id="bedrooms_id_{{ $index }}">
                            <option value="">Pilih Kamar</option>
                            @foreach ($bedrooms as $bedroom)
                                <option value="{{ $bedroom->id }}">{{ $bedroom->title_bedroom }} | Rp
                                    {{ number_format($bedroom->category_bedroom->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="check_in_{{ $index }}" class="form-label mt-2">Check In</label>
                    <input wire:model="details.{{ $index }}.check_in" type="datetime-local" class="form-control"
                        id="check_in_{{ $index }}">

                    <label for="duration_{{ $index }}" class="form-label mt-2">Durasi</label>
                    <input wire:model="details.{{ $index }}.duration" type="number" class="form-control"
                        id="duration_{{ $index }}" placeholder="0">

                    @if ($index > 0)
                        <button type="button" class="btn btn-danger mt-2"
                            wire:click="removeDetail({{ $index }})">Hapus Kamar</button>
                    @endif
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary" wire:click="addDetail">Tambah Kamar</button>
        <button type="submit" class="btn btn-info">Submit Reservasi</button>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Id</th>
                <th>Bedroom</th>
                <th>Check In</th>
                <th>Durasi</th>
                <th>Check Out</th>
                <th>Total Price / Room</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                @foreach ($reservation->detail_reservation as $detail)
                    <tr>
                        <td>{{ $loop->parent->iteration }}</td>
                        <td>{{ $detail->bedroom->title_bedroom }}</td>
                        <td>{{ $detail->check_in }}</td>
                        <td>{{ $detail->duration }}</td>
                        <td>{{ $detail->check_out }}</td>
                        <td>Rp {{ number_format($detail->total_price_per_room, 0, ',', '.') }}</td>
                        <td>
                            <button wire:click="delete({{ $detail->id }})"
                                wire:confirm="Are you sure delete this data ?"
                                class="btn btn-sm btn-danger ml-2">Delete</button>
                            <button wire:click="fix({{ $detail->id }})"
                                wire:confirm="Are you sure certain this data ?"
                                class="btn btn-sm btn-success ml-2">Fix</button>
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5">Tidak ada reservasi yang ditemukan.</td>
                </tr>
            @endforelse
            @if ($totalAllPrice > 0)
                <tr>
                    <td colspan="5" class="text-right font-semibold">Total Semua</td>
                    <td colspan="2" class="font-bold text-green-600">
                        Rp {{ number_format($totalAllPrice, 0, ',', '.') }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div> --}}
