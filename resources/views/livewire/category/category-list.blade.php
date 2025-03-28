<div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>
            {{ $deskripsi }}
        </p>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Data Category</h6>
            <a wire:navigate href="/category/create" class="btn btn-sm btn-info">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code Catagory</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->code_category_bedroom }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>Rp {{ number_format($category->price, 0, ',', '.') }} </td>
                                <td>{{ $category->created_at->format('d F Y H:i:s') }}</td>
                                <td>{{ $category->updated_at->format('d F Y H:i:s') }}</td>
                                <td class="d-flex gap-2">
                                    <a wire:navigate href="/category/{{ $category->id }}/edit"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <button wire:click="delete({{ $category->id }})"
                                        wire:confirm="Are you sure delete this category ?"
                                        class="btn btn-sm btn-danger ml-2">Delete</button>
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
