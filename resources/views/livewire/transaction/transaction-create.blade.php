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
                <label for="order_id" class="form-label">Order</label>
                <div class="input-group">
                    <select wire:model="order_id" class="form-control" id="order_id">
                        <option value="">Pilih Order</option>
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('order_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="mt-3">
                    <label class="form-label">Uang Pembayaran</label>
                    <input type="number" wire:model.live="uang_pembayaran" class="form-control"
                        placeholder="Masukkan nominal pembayaran">
                    <button type="submit" class="btn btn-info btn-sm mt-2">
                        Save
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Total Harga</label>
                <input type="text" class="form-control mb-3" wire:model="total_price" readonly>

                <label class="form-label">Uang Kembalian</label>
                <input type="text" class="form-control" wire:model="uang_kembalian" readonly>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Tambahkan Bedroom</label>

            <div class="row">
                <div class="col-md-12">
                    @foreach ($detail_transactions as $index => $detail)
                        <div class="row align-items-end mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Kamar</label>
                                <select wire:model.live="detail_transactions.{{ $index }}.bedrooms_id"
                                    class="form-control">
                                    <option value="">Pilih Kamar</option>
                                    @foreach ($bedrooms as $bedroom)
                                        <option value="{{ $bedroom->id }}">
                                            {{ $bedroom->title_bedroom }} | Rp
                                            {{ number_format($bedroom->category_bedroom->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Check In</label>
                                <input type="datetime-local"
                                    wire:model.live="detail_transactions.{{ $index }}.check_in"
                                    class="form-control" />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Durasi</label>
                                <input type="number"
                                    wire:model.live="detail_transactions.{{ $index }}.duration"
                                    class="form-control" />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Check Out</label>
                                <input type="datetime-local"
                                    wire:model="detail_transactions.{{ $index }}.check_out" class="form-control"
                                    disabled />
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Sub Total</label>
                                <input type="text"
                                    wire:model="detail_transactions.{{ $index }}.total_price_per_room"
                                    class="form-control" disabled />
                            </div>
                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-outline-danger mt-4"
                                    wire:click="removeDetail({{ $index }})">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-info btn-sm mt-2" wire:click="addTransaction">
                        + Tambah Bedroom
                    </button>

                    @error('detail_transactions.*')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>
