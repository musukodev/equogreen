<div class="flex w-full h-full">
<!-- Left Side: Login Form -->
<div class="flex-1 basis-1/2 max-w-1/2 flex items-center justify-center p-8">
    <div class="w-full max-w-md -mt-12">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-2 text-black">Selamat datang!</h1>
            <p class="text-base text-slate-900">Masukkan data sesuai ketentuan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
            <!-- Card Header -->
            <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-200 font-medium text-sm">
                <i class="ph-fill ph-user-circle text-2xl text-black"></i>
                <span>Login</span>
            </div>

            <!-- Form -->
            <form class="p-6" wire:submit="login">
                <!-- Email Field -->
                <div class="mb-5">
                    <label class="block text-base font-normal mb-2 text-slate-900">Username</label>
                    <input
                        type="text"
                        wire:model="username"
                        class="w-full h-11 border border-slate-400 rounded-md px-3.5 font-normal text-sm placeholder-slate-400 focus:outline-none focus:border-blue-600 transition-colors @error('username') border-red-500 @enderror"
                        placeholder="Masukkan username Anda"
                        required autofocus>
                    @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <label class="block text-base font-normal mb-2 text-slate-900">Password</label>
                    <input
                        type="password"
                        wire:model="password"
                        class="w-full h-11 border border-slate-400 rounded-md px-3.5 font-normal text-sm placeholder-slate-400 focus:outline-none focus:border-blue-600 transition-colors @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password Anda"
                        required>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full h-11 bg-blue-600 text-white border-none rounded-md text-base font-medium cursor-pointer hover:bg-blue-700 transition-colors mb-6 relative">
                    <span wire:loading.remove wire:target="login">Log In</span>
                    <span wire:loading wire:target="login">Memproses...</span>
                </button>

                <!-- Register Link -->
                <div class="text-center text-sm text-slate-900">
                    Belum punya akun?
                    <a href="{{ route('registrasi') }}" class="text-blue-600 no-underline hover:underline" wire:navigate>Registrasi.</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Right Side: Image cover -->
<div class="flex-1 basis-1/2 max-w-1/2 h-full flex bg-indigo-50">
    <img src="/gambar/login.png" alt="Login Banner" class="w-full h-full object-cover">
</div>
</div>
