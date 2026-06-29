<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nusantara Air</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full antialiased text-gray-900 bg-slate-100">

    <div class="flex min-h-screen">
        
        <div class="relative flex-1 hidden w-0 lg:block bg-slate-900">
            <img class="absolute inset-0 object-cover w-full h-full opacity-85 select-none pointer-events-none" 
                 src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2074&auto=format&fit=cover" 
                 alt="Nusantara Air Aircraft">
            
            <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-blue-950/70 to-transparent flex flex-col justify-between p-16">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-amber-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L6 12Zm0 0h7.5" />
                        </svg>
                    </div>
                    <div><span class="text-xl font-extrabold tracking-wider text-white">Nusantara <span class="text-amber-400">Air</span></span></div>
                </div>

                <div class="max-w-xl mb-12">
                    <h1 class="text-5xl font-extrabold text-white tracking-tight leading-tight mb-5">JELAJAHI DUNIA.</h1>
                    <p class="text-2xl font-semibold text-slate-100 mb-3 tracking-wide">Sistem Pemesanan Tiket Pesawat Digital Nusantara Air.</p>
                    <p class="text-base text-slate-300 leading-relaxed font-light max-w-lg">Ubah proses pemesanan manual menjadi pengalaman digital yang cepat, aman, dan mudah.</p>
                </div>

                <div class="flex justify-between items-center text-xs text-slate-400 border-t border-white/10 pt-5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Powered by Laravel Herd</span>
                    </div>
                    <p>&copy; 2026 Nusantara Air Team. All Rights Reserved.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-28 bg-slate-50 border-l border-slate-200">
            <div class="w-full max-w-md mx-auto lg:w-[420px]">
                <div class="bg-white p-10 rounded-3xl shadow-2xl shadow-slate-200/80 border border-slate-100/80">
                    
                    <div class="mb-6 p-3.5 rounded-xl bg-emerald-50 text-sm text-emerald-700 font-medium border border-emerald-100 flex items-center gap-2.5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-emerald-600 shrink-0">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.14-.1l3.75-5.25Z" clip-rule="evenodd" />
                        </svg>
                        <span>Selamat Datang Kembali!</span>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-extrabold tracking-tight text-gray-900 uppercase">Masuk Ke Akun Anda.</h2>
                    </div>

                    <form action="{{ route('login.proses') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Anda</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" required placeholder="nama@email.com" value="{{ old('email') }}"
                                       class="block w-full rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror pl-11 pr-4 py-3.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm transition-all">
                            </div>
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 font-semibold">⚠ {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                            <input id="password" name="password" type="password" required placeholder="Masukkan kata sandi"
                                   class="block w-full rounded-xl border border-gray-300 px-4 py-3.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm transition-all">
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Masuk Sebagai</label>
                            <select id="role" name="role" required class="block w-full rounded-xl border border-gray-300 px-4 py-3.5 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm transition-all">
                                <option value="user">Pelanggan / Customer</option>
                                <option value="admin">Admin / Staf Loket</option>
                            </select>
                        </div>

                        <div class="pt-2">
    <button type="submit" class="flex justify-center w-full px-5 py-4 text-sm font-bold text-white uppercase transition-all bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 cursor-pointer">
       Login
    </button>
</div>

<div class="mt-6 text-center">
    <p class="text-sm text-gray-600">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-all underline">
            Daftar di sini
        </a>
    </p>
</div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</body>
</html>