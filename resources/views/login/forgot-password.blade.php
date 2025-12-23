<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Support System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">

<div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-4">Lupa Password</h2>
    <p class="text-center text-gray-600 mb-6 text-sm">Masukkan email Anda untuk menerima link reset password.</p>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    @error('email')
        <div class="p-3 mb-4 bg-red-100 border border-red-200 text-red-700 rounded-lg text-sm">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
            Kirim Link Reset Password
        </button>
    </form>

    <p class="text-center mt-6 text-sm text-gray-600">
        Kembali ke
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Halaman Login</a>
    </p>
</div>

</body>
</html>
