<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Nusantara Air</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full antialiased text-gray-900 bg-slate-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl border border-slate-100">
        
        <div>
            <div class="flex justify-center text-blue-600 mb-4">
                <div class="p-3 bg-blue-50 rounded-2xl border border-blue-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-amber-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L6 12Zm0 0h7.5" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-gray-900 tracking-tight uppercase">
                Daftar Akun Baru
            </h2>
            <p class="mt-3 text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-all underline">
                    Masuk di sini
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register.proses') }}" method="POST">
            @csrf
            
            <input type="hidden" name="role" value="user">

            <div class="rounded-md space-y-5">
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap Anda</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input id="name" name="name" type="text" required placeholder="Masukkan nama lengkap" value="{{ old('name') }}"
                               class="block w-full rounded-xl border @error('name') border-red-500 @else border-gray-300 @enderror pl-11 pr-4 py-3.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm transition-all">
                    </div>
                    @error('name') 
                        <p class="mt-2 text-xs text-red-600 font-semibold">⚠ {{ $message }}</p> 
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Aktif</label>
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
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi (Minimal 6 Karakter)</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required placeholder="Buat kata sandi akun"
                               class="block w-full rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror pl-11 pr-4 py-3.5 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm transition-all">
                    </div>
                    @error('password') 
                        <p class="mt-2 text-xs text-red-600 font-semibold">⚠ {{ $message }}</p> 
                    @enderror
                </div>

            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg shadow-blue-500/20 uppercase cursor-pointer tracking-wider">
                    Daftar Akun
                </button>
            </div>
        </form>
        
    </div>

</body>
</html>