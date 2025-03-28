<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        // 🔢 Ambil user terakhir dengan prefix 'ORD'
        $prefix = 'ORD';
        $lastUser = User::withTrashed()
            ->where('code_user', 'like', "$prefix%")
            ->orderBy('code_user', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastUser && preg_match('/\d+$/', $lastUser->code_user, $matches)) {
            $lastNumber = (int) $matches[0];
        }

        $codeUser = $prefix . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // 🧑‍💻 Simpan user baru
        $user = User::create([
            'code_user' => $codeUser,
            'name' => $request->name,
            'email' => $request->email . '@gmail.com',
            'password' => Hash::make($request->password),
            'no_phone' => '+62 ' . $request->no_phone,
            'address' => $request->address,
        ]);

        // 🔐 Event dan role
        event(new Registered($user));
        $user->assignRole('order');
        Auth::login($user);

        return redirect()->route('login');
    }
}
