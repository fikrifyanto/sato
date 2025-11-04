@extends('customer.layouts.app')

@section('content')
<div class="min-h-screen pt-4">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="flex border-b overflow-x-auto">
                    <button class="tab-button active px-5 py-3 text-sm font-semibold text-orange-500 border-b-2 border-orange-500 whitespace-nowrap" data-tab="biodata">
                        Biodata Diri
                    </button>
                    <button class="tab-button px-5 py-3 text-sm font-semibold text-gray-600 hover:text-orange-500 whitespace-nowrap" data-tab="address">
                        Daftar Alamat
                    </button>
                </div>

                <div class="p-6">
                    <div id="biodata-tab" class="tab-content">
                        <div class="grid md:grid-cols-3 gap-8">
                            <div class="md:col-span-1 space-y-6">
                                <div class="text-center">
                                    <h3 class="text-base font-bold text-gray-800 mb-4">Ubah Foto Profil</h3>
                                    <img 
                                        src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                                        alt="Avatar"
                                        class="w-32 h-32 mx-auto rounded-lg object-cover border mb-4"
                                        id="avatar-preview"
                                    >
                                    <form action="#" method="POST" enctype="multipart/form-data" id="avatar-form">
                                        @csrf
                                        <label for="avatar-input" class="cursor-pointer inline-block bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-semibold py-2 px-4 rounded-lg transition">
                                            Pilih Foto
                                        </label>
                                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
                                        <p class="text-xs text-gray-500 mt-2">Maksimum 10 MB</p>
                                        <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG</p>
                                    </form>
                                </div>
                                <div>
                                    <button type="button" onclick="document.getElementById('password-modal').classList.remove('hidden')" class="w-full text-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-semibold py-2.5 px-4 rounded-lg">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <h3 class="text-base font-bold text-gray-800 mb-6">Ubah Biodata Diri</h3>
                                
                                @if(session('success'))
                                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-3 mb-4 text-sm">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="#" method="POST" class="space-y-5">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Nama</label>
                                        <div class="md:col-span-2">
                                            <input 
                                                type="text" 
                                                name="name" 
                                                value="{{ old('name', Auth::user()->name) }}"
                                                class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                                required
                                            >
                                            @error('name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Tanggal Lahir</label>
                                        <div class="md:col-span-2">
                                            <input 
                                                type="date" 
                                                name="birth_date" 
                                                value="{{ old('birth_date', Auth::user()->birth_date) }}"
                                                class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                            >
                                            @error('birth_date')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Jenis Kelamin</label>
                                        <div class="md:col-span-2">
                                            <div class="flex space-x-4">
                                                <label class="flex items-center text-sm">
                                                    <input type="radio" name="gender" value="Pria" {{ old('gender', Auth::user()->gender) == 'Pria' ? 'checked' : '' }} class="mr-2 text-orange-500 focus:ring-orange-400">
                                                    <span>Pria</span>
                                                </label>
                                                <label class="flex items-center text-sm">
                                                    <input type="radio" name="gender" value="Wanita" {{ old('gender', Auth::user()->gender) == 'Wanita' ? 'checked' : '' }} class="mr-2 text-orange-500 focus:ring-orange-400">
                                                    <span>Wanita</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <h4 class="text-base font-bold text-gray-800 mb-4">Ubah Kontak</h4>
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Email</label>
                                        <div class="md:col-span-2">
                                            <div class="flex items-center space-x-2">
                                                <input 
                                                    type="email" 
                                                    name="email" 
                                                    value="{{ old('email', Auth::user()->email) }}"
                                                    class="flex-1 px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                                    required
                                                >
                                                <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded whitespace-nowrap">Terverifikasi</span>
                                            </div>
                                            @error('email')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Nomor HP</label>
                                        <div class="md:col-span-2">
                                            <div class="flex items-center space-x-2">
                                                <input 
                                                    type="text" 
                                                    name="phone" 
                                                    value="{{ old('phone', Auth::user()->phone) }}"
                                                    class="flex-1 px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                                >
                                                <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded whitespace-nowrap">Terverifikasi</span>
                                            </div>
                                            @error('phone')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" class="px-5 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                            Batal
                                        </button>
                                        <button type="submit" class="px-5 py-2 text-sm bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-semibold">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="address-tab" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-base font-bold text-gray-800">Daftar Alamat</h3>
                            <button type="button" onclick="openAddAddressModal()" class="px-4 py-2 text-sm bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-semibold">
                                + Tambah Alamat Baru
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-white border-2 border-orange-500 rounded-lg p-5 relative">
                                <span class="absolute top-3 right-3 bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-semibold">Alamat Utama</span>
                                <div class="mb-3">
                                    <div class="flex items-start justify-between pr-24">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800 mb-1">M FAISAL AKBAR</h4>
                                            <p class="text-xs text-gray-600 mb-1">628986788877</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-700" id="address-1">
                                        <span class="address-full">Jl. Kenangan</span>
                                    </p>
                                </div>
                                <div class="flex items-center space-x-4 text-sm">
                                    <button type="button" onclick="openEditAddressModal(2)" class="text-orange-600 hover:text-orange-700 font-semibold">Ubah Alamat</button>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg p-5 relative">
                                <div class="mb-3">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-800 mb-1">Kantor</h4>
                                            <p class="text-sm font-semibold text-gray-800 mb-1">M Faisal Akbar</p>
                                            <p class="text-xs text-gray-600 mb-1">628986788877</p>
                                        </div>
                                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-700" id="address-2">
                                        <span class="address-full">Jl. Soekarno Hatta</span>
                                    </p>
                                </div>
                                <div class="flex items-center space-x-4 text-sm">
                                    <button type="button" onclick="openEditAddressModal(2)" class="text-orange-600 hover:text-orange-700 font-semibold">Ubah Alamat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="password-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 relative z-10">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Ubah Password</h3>
            <button type="button" onclick="document.getElementById('password-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password Lama</label>
                <input type="password" name="current_password" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password Baru</label>
                <input type="password" name="password" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
            </div>
            <div class="flex space-x-3 pt-2">
                <button type="button" onclick="document.getElementById('password-modal').classList.add('hidden')" class="flex-1 px-4 py-2 text-sm border rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 text-sm bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="address-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full relative z-10 shadow-xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold" id="address-modal-title">Tambah Alamat Baru</h3>
                <button type="button" onclick="closeAddressModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Label Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="label" placeholder="Contoh: Rumah, Kantor" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                    <input type="text" name="recipient_name" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Nomor HP <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="4" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Provinsi <span class="text-red-500">*</span></label>
                        <select name="province" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Provinsi</option>
                            <option value="jawa-timur">Jawa Timur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                        <select name="city" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Kota</option>
                            <option value="malang">Malang</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kecamatan <span class="text-red-500">*</span></label>
                        <select name="district" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kode Pos <span class="text-red-500">*</span></label>
                        <input type="text" name="postal_code" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_primary" id="is_primary" class="mr-2">
                    <label for="is_primary" class="text-sm text-gray-700">Jadikan alamat utama</label>
                </div>
                <div class="flex space-x-3 pt-2">
                    <button type="button" onclick="closeAddressModal()" class="flex-1 px-4 py-2 text-sm border rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 text-sm bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active', 'text-orange-500', 'border-b-2', 'border-orange-500');
                btn.classList.add('text-gray-600');
            });
            
            this.classList.add('active', 'text-orange-500', 'border-b-2', 'border-orange-500');
            this.classList.remove('text-gray-600');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            const tabId = this.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.remove('hidden');
        });
    });

    document.getElementById('avatar-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
            document.getElementById('avatar-form').submit();
        }
    });

    function openAddAddressModal() {
        document.getElementById('address-modal-title').textContent = 'Tambah Alamat Baru';
        document.getElementById('address-modal').classList.remove('hidden');
    }

    function openEditAddressModal(addressId) {
        document.getElementById('address-modal-title').textContent = 'Ubah Alamat';
        document.getElementById('address-modal').classList.remove('hidden');
    }

    function closeAddressModal() {
        document.getElementById('address-modal').classList.add('hidden');
    }
</script>
@endsection
