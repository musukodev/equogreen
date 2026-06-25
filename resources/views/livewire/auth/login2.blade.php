<div class="flex h-full w-full">
    <!-- Left Side: Login Form -->
    <div class="max-w-1/2 flex flex-1 basis-1/2 items-center justify-center p-8">
        <div class="-mt-12 w-full max-w-md">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="mb-2 text-2xl font-bold text-black">Selamat datang!</h1>
                <p class="text-base text-slate-900">Masukkan data sesuai ketentuan</p>
            </div>

            <!-- Login Card -->
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <!-- Card Header -->
                <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-4 text-sm font-medium">
                    <i class="ph-fill ph-user-circle text-2xl text-black"></i>
                    <span>Login</span>
                </div>

                <!-- Form -->
                <form class="p-6" wire:submit="login">
                    <!-- Email Field -->
                    <div class="mb-5">
                        <label class="mb-2 block text-base font-normal text-slate-900">Username</label>
                        <input type="text" wire:model="username"
                            class="@error('username') border-red-500 @enderror h-11 w-full rounded-md border border-slate-400 px-3.5 text-sm font-normal placeholder-slate-400 transition-colors focus:border-blue-600 focus:outline-none"
                            placeholder="Masukkan username Anda" required autofocus>
                        @error('username')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-5">
                        <label class="mb-2 block text-base font-normal text-slate-900">Password</label>
                        <input type="password" wire:model="password"
                            class="@error('password') border-red-500 @enderror h-11 w-full rounded-md border border-slate-400 px-3.5 text-sm font-normal placeholder-slate-400 transition-colors focus:border-blue-600 focus:outline-none"
                            placeholder="Masukkan password Anda" required>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="relative mb-6 h-11 w-full cursor-pointer rounded-md border-none bg-blue-600 text-base font-medium text-white transition-colors hover:bg-blue-700">
                        <span wire:loading.remove wire:target="login">Log In</span>
                        <span wire:loading wire:target="login">Memproses...</span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center text-sm text-slate-900">
                        Belum punya akun?
                        <a href="{{ route('registrasi') }}" class="text-blue-600 no-underline hover:underline"
                            wire:navigate>Registrasi.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Side: Image cover -->
    <div class="max-w-1/2 flex h-full flex-1 basis-1/2 bg-indigo-50">
        <img src="/gambar/login.png" alt="Login Banner" class="h-full w-full object-cover">
    </div>
</div>
