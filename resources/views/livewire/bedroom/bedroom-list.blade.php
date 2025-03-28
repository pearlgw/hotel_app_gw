<div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>
            {{ $deskripsi }}
        </p>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Data Bedroom</h6>
            <a wire:navigate href="/bedroom/create" class="btn btn-sm btn-info">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Catagory Bedroom</th>
                            <th>Code Bedroom</th>
                            <th>Image</th>
                            <th>Available</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bedrooms as $bedroom)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bedroom->category_bedroom->category_name }}</td>
                                <td>{{ $bedroom->code_bedroom }}</td>
                                <td>
                                    <img src="{{ $bedroom->main_image_url }}" alt="Main Image" width="300" />
                                </td>
                                <td>{{ $bedroom->is_available ? 'Tidak Tersedia' : 'Tersedia' }}</td>
                                <td>{{ $bedroom->title_bedroom }}</td>
                                <td>{{ \Illuminate\Support\Str::words($bedroom->description, 4, '...') }}</td>
                                <td>{{ $bedroom->created_at->format('d F Y H:i:s') }}</td>
                                <td>{{ $bedroom->updated_at->format('d F Y H:i:s') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a wire:navigate href="/bedroom/{{ $bedroom->id }}/edit"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <button wire:click="delete({{ $bedroom->id }})"
                                            wire:confirm="Are you sure delete this bedroom ?"
                                            class="btn btn-sm btn-danger ml-2">Delete</button>
                                        <a wire:navigate href="/bedroom/{{ $bedroom->id }}"
                                            class="btn btn-sm btn-primary ml-2">Show</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data masih kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="mt-4">
                    {{ $hotels->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
