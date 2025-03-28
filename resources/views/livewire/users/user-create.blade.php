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
                <label for="role" class="form-label">Pilih Role</label>
                <select wire:model='role' class="form-control" id="role">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="order">Order</option>
                </select>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <input hidden wire:model='code_user' type="text" class="form-control" id="code_user">

            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Name</label>
                <input wire:model='name' type="text" class="form-control" id="name" placeholder="Masukan nama">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input wire:model='email' type="text" class="form-control" id="email" placeholder="Masukkan email tanpa @gmail.com">
                    <span class="input-group-text">@gmail.com</span>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input wire:model='password' type="password" class="form-control" id="password" placeholder="***">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="no_phone" class="form-label">No Phone</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input wire:model='no_phone' type="text" class="form-control" id="no_phone" placeholder="81234567890">
                </div>
                @error('no_phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input wire:model='address' type="text" class="form-control" id="address" placeholder="Masukan alamat">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
