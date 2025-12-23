<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Support System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 to-indigo-700 p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Daftar Akun Baru</h2>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('username') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 mb-1">Password</label>
            <input type="password" name="password" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-600 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
            Daftar
        </button>
    </form>

    <p class="text-center mt-6 text-sm text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
    </p>

</div>

</body>
</html>
