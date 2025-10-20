<div class="flex flex-col h-full">
    <div class="p-4 border-b">
        <h2 class="text-xl font-bold text-blue-600">Member Area</h2>
    </div>
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('member.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-blue-50 text-gray-700 {{ request()->routeIs('member.dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
           🏠 Dashboard
        </a>
        <a href="#"
           class="block px-4 py-2 rounded hover:bg-blue-50 text-gray-700">
           👤 Profil
        </a>
        <a href="#"
           class="block px-4 py-2 rounded hover:bg-blue-50 text-gray-700">
           💬 Pesan
        </a>
        <a href="#"
           class="block px-4 py-2 rounded hover:bg-blue-50 text-gray-700">
           ⚙️ Pengaturan
        </a>
    </nav>
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('member.logout') }}">
            @csrf
            <button class="w-full text-left text-red-600 hover:underline">Logout</button>
        </form>
    </div>
</div>
