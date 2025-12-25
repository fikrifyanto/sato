@extends('customer.layouts.app')

@section('content')
<div class="min-h-screen pt-4">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            @if(session('success'))
                <div id="floating-success-alert" class="pointer-events-none fixed right-6 top-6 z-50">
                    <div class="pointer-events-auto flex items-start justify-between rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-lg" role="alert">
                        <div class="flex items-start gap-3">
                            <span class="inline-flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-semibold">Berhasil</p>
                                <p class="mt-1 text-emerald-700">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" class="ml-4 text-emerald-500 transition hover:text-emerald-600" onclick="this.closest('[role=\'alert\']').remove()">
                            <span class="sr-only">Tutup notifikasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M5.22 5.22a.75.75 0 011.06 0L10 8.94l3.72-3.72a.75.75 0 111.06 1.06L11.06 10l3.72 3.72a.75.75 0 11-1.06 1.06L10 11.06l-3.72 3.72a.75.75 0 11-1.06-1.06L8.94 10 5.22 6.28a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            @php
                $pictureUrl = $user->picture
                    ? asset('storage/' . $user->picture)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
                $addressTypes = [
                    'home' => 'Rumah',
                    'shelter' => 'Shelter',
                    'office' => 'Kantor',
                    'other' => 'Lainnya',
                ];
                $birthdayValue = old('birthday');
                if ($birthdayValue === null) {
                    $birthdayAttribute = $user->birthday;
                    if ($birthdayAttribute instanceof \Illuminate\Support\Carbon) {
                        $birthdayValue = $birthdayAttribute->format('Y-m-d');
                    } elseif (is_string($birthdayAttribute)) {
                        $birthdayValue = $birthdayAttribute;
                    } else {
                        $birthdayValue = '';
                    }
                }
            @endphp
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
                                    <img
                                        src="{{ $pictureUrl }}"
                                        alt="Foto Profil"
                                        class="w-32 h-32 mx-auto rounded-lg object-cover border mb-4"
                                        id="picture-preview"
                                    >
                                    <div>
                                        <label for="picture-input" class="cursor-pointer inline-block bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-semibold py-2 px-4 rounded-lg transition">
                                            Pilih Foto
                                        </label>
                                        <input type="file" name="picture" id="picture-input" class="hidden" accept="image/*" form="profile-form">
                                        <p class="text-xs text-gray-500 mt-2">Maksimum 10 MB</p>
                                        <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG</p>
                                        @error('picture')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <button type="button" onclick="document.getElementById('password-modal').classList.remove('hidden')" class="w-full text-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-semibold py-2.5 px-4 rounded-lg">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <h3 class="text-base font-bold text-gray-800 mb-6">Ubah Biodata Diri</h3>

                                <form id="profile-form" action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Nama</label>
                                        <div class="md:col-span-2">
                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ old('name', $user->name) }}"
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
                                                name="birthday"
                                                value="{{ $birthdayValue }}"
                                                class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                            >
                                            @error('birthday')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-3 gap-4 items-start">
                                        <label class="text-gray-700 text-sm font-semibold pt-2">Jenis Kelamin</label>
                                        <div class="md:col-span-2">
                                            <div class="flex space-x-4">
                                                <label class="flex items-center text-sm">
                                                    <input type="radio" name="gender" value="male" {{ old('gender', $user->gender) === 'male' ? 'checked' : '' }} class="mr-2 text-orange-500 focus:ring-orange-400">
                                                    <span>Pria</span>
                                                </label>
                                                <label class="flex items-center text-sm">
                                                    <input type="radio" name="gender" value="female" {{ old('gender', $user->gender) === 'female' ? 'checked' : '' }} class="mr-2 text-orange-500 focus:ring-orange-400">
                                                    <span>Wanita</span>
                                                </label>
                                            </div>
                                            @error('gender')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
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
                                                    value="{{ old('email', $user->email) }}"
                                                    class="flex-1 px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                                    required
                                                >
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
                                                    value="{{ old('phone', $user->phone) }}"
                                                    class="flex-1 px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                                                >
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
                            @forelse($addresses as $address)
                                @php
                                    $addressPayload = [
                                        'id' => $address->id,
                                        'type' => $address->type,
                                        'label' => $address->label,
                                        'province' => $address->province,
                                        'city' => $address->city,
                                        'district' => $address->district,
                                        'postcode' => $address->postcode,
                                        'detail' => $address->detail,
                                        'notes' => $address->notes,
                                    ];
                                    $typeLabel = $addressTypes[$address->type] ?? ucfirst($address->type);
                                @endphp
                                <div
                                    class="bg-white border border-gray-200 rounded-lg p-5 relative"
                                    data-address-id="{{ $address->id }}"
                                    data-address='@json($addressPayload)'
                                    data-update-url="{{ route('addresses.update', $address) }}"
                                >
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            @if($address->label)
                                                <h4 class="text-sm font-bold text-gray-800 mb-1">{{ $address->label }}</h4>
                                            @endif
                                            <p class="text-xs font-semibold text-orange-600 uppercase tracking-wide">{{ $typeLabel }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-4 space-y-1">
                                        @if($address->detail)
                                            <p class="text-sm text-gray-700">{{ $address->detail }}</p>
                                        @endif
                                        <p class="text-sm text-gray-700">
                                            {{ $address->district }}, {{ $address->city }}, {{ $address->province }} {{ $address->postcode }}
                                        </p>
                                        @if($address->notes)
                                            <p class="text-xs text-gray-500">Catatan: {{ $address->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button type="button" onclick="openEditAddressModal({{ $address->id }})" class="text-orange-600 hover:text-orange-700 font-semibold">Ubah Alamat</button>
                                        <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 font-semibold" onclick="return confirm('Hapus alamat ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <p>Belum ada alamat tersimpan</p>
                                </div>
                            @endforelse
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
        <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password Lama</label>
                <input type="password" name="current_password" id="modal-current-password" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                @error('current_password', 'password')
                    <p id="current-password-server-error" class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password Baru</label>
                <input type="password" name="password" id="modal-password" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                @error('password', 'password')
                    <p id="password-server-error" class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="modal-password-confirmation" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                <p id="modal-password-match-message" class="mt-1 text-xs hidden"></p>
                @error('password_confirmation', 'password')
                    <p id="password-confirmation-server-error" class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
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
            <form id="address-form" action="{{ route('addresses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div id="address-form-method-container"></div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jenis Alamat <span class="text-red-500">*</span></label>
                    <select name="type" id="address-type" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                        <option value="">Pilih Jenis Alamat</option>
                        @foreach($addressTypes as $typeValue => $typeName)
                            <option value="{{ $typeValue }}">{{ $typeName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Label Alamat</label>
                    <input type="text" name="label" id="address-label" placeholder="Contoh: Rumah, Kantor" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Detail Alamat</label>
                    <textarea name="detail" id="address-detail" rows="3" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Provinsi <span class="text-red-500">*</span></label>
                        <select name="province" id="address-province" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                        <select name="city" id="address-city" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kecamatan <span class="text-red-500">*</span></label>
                        <select name="district" id="address-district" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Kode Pos <span class="text-red-500">*</span></label>
                        <input type="text" name="postcode" id="address-postcode" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Catatan</label>
                    <textarea name="notes" id="address-notes" rows="2" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"></textarea>
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
    const regionsData = @json($regions);
    const normalizedRegions = Array.isArray(regionsData) ? regionsData : [];

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    const pictureInput = document.getElementById('picture-input');
    const picturePreview = document.getElementById('picture-preview');
    const passwordModalElement = document.getElementById('password-modal');
    const shouldOpenPasswordModal = @json($errors->password->any());
    const currentPasswordInput = document.getElementById('modal-current-password');
    const passwordInput = document.getElementById('modal-password');
    const passwordConfirmationInput = document.getElementById('modal-password-confirmation');
    const passwordMatchMessage = document.getElementById('modal-password-match-message');
    const currentPasswordServerError = document.getElementById('current-password-server-error');
    const passwordServerError = document.getElementById('password-server-error');
    const passwordConfirmationServerError = document.getElementById('password-confirmation-server-error');

    const addressModal = document.getElementById('address-modal');
    const addressForm = document.getElementById('address-form');
    const methodContainer = document.getElementById('address-form-method-container');
    const floatingAlert = document.getElementById('floating-success-alert');
    if (floatingAlert) {
        setTimeout(() => {
            floatingAlert.remove();
        }, 4000);
    }

    if (shouldOpenPasswordModal && passwordModalElement) {
        passwordModalElement.classList.remove('hidden');
    }

    const resetConfirmationVisualState = () => {
        if (!passwordConfirmationInput || !passwordMatchMessage) {
            return;
        }

        passwordMatchMessage.textContent = '';
        passwordMatchMessage.classList.add('hidden');
        passwordMatchMessage.classList.remove('text-red-600', 'text-green-600');
        passwordConfirmationInput.classList.remove('border-red-500', 'border-green-500');
        passwordConfirmationInput.classList.add('border-gray-300');
    };

    const updatePasswordMatchFeedback = () => {
        if (!passwordInput || !passwordConfirmationInput || !passwordMatchMessage) {
            return;
        }

        passwordServerError?.classList.add('hidden');
        passwordConfirmationServerError?.classList.add('hidden');

        const passwordValue = passwordInput.value;
        const confirmationValue = passwordConfirmationInput.value;

        if (confirmationValue.length === 0) {
            resetConfirmationVisualState();
            return;
        }

        passwordMatchMessage.classList.remove('hidden');
        passwordConfirmationInput.classList.remove('border-gray-300');

        if (passwordValue === confirmationValue) {
            passwordMatchMessage.textContent = 'Password cocok';
            passwordMatchMessage.classList.remove('text-red-600');
            passwordMatchMessage.classList.add('text-green-600');
            passwordConfirmationInput.classList.remove('border-red-500');
            passwordConfirmationInput.classList.add('border-green-500');
        } else {
            passwordMatchMessage.textContent = 'Password tidak cocok';
            passwordMatchMessage.classList.remove('text-green-600');
            passwordMatchMessage.classList.add('text-red-600');
            passwordConfirmationInput.classList.remove('border-green-500');
            passwordConfirmationInput.classList.add('border-red-500');
        }
    };

    currentPasswordInput?.addEventListener('input', () => {
        currentPasswordServerError?.classList.add('hidden');
    });

    passwordInput?.addEventListener('input', () => {
        passwordServerError?.classList.add('hidden');
        updatePasswordMatchFeedback();
    });

    passwordConfirmationInput?.addEventListener('input', () => {
        passwordConfirmationServerError?.classList.add('hidden');
        updatePasswordMatchFeedback();
    });

    const provinceSelect = document.getElementById('address-province');
    const citySelect = document.getElementById('address-city');
    const districtSelect = document.getElementById('address-district');
    const typeSelect = document.getElementById('address-type');
    const labelInput = document.getElementById('address-label');
    const detailInput = document.getElementById('address-detail');
    const postcodeInput = document.getElementById('address-postcode');
    const notesInput = document.getElementById('address-notes');
    const storeAddressUrl = '{{ route('addresses.store') }}';

    function handleTabClick(event) {
        const target = event.currentTarget;

        tabButtons.forEach(btn => {
            btn.classList.remove('active', 'text-orange-500', 'border-b-2', 'border-orange-500');
            btn.classList.add('text-gray-600');
        });

        target.classList.add('active', 'text-orange-500', 'border-b-2', 'border-orange-500');
        target.classList.remove('text-gray-600');

        const selectedTab = `${target.dataset.tab}-tab`;

        tabContents.forEach(content => {
            content.classList.toggle('hidden', content.id !== selectedTab);
        });
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', handleTabClick);
    });

    if (pictureInput) {
        pictureInput.addEventListener('change', event => {
            const [file] = event.target.files;

            if (file && picturePreview) {
                const reader = new FileReader();
                reader.onload = loadEvent => {
                    picturePreview.src = loadEvent.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function populateProvinces(selected = '') {
        if (!provinceSelect) {
            return;
        }

        provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

        normalizedRegions.forEach(province => {
            const option = document.createElement('option');
            option.value = province.code;
            option.textContent = province.name;
            provinceSelect.appendChild(option);
        });

        if (selected) {
            provinceSelect.value = selected;
        }
    }

    function populateCities(provinceCode, selected = '') {
        if (!citySelect || !districtSelect) {
            return;
        }

        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (!provinceCode) {
            return;
        }

        const province = normalizedRegions.find(item => item.code === provinceCode);

        if (!province || !Array.isArray(province.cities)) {
            return;
        }

        province.cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.code;
            option.textContent = city.name;
            citySelect.appendChild(option);
        });

        if (selected) {
            citySelect.value = selected;
        }
    }

    function populateDistricts(provinceCode, cityCode, selected = '') {
        if (!districtSelect) {
            return;
        }

        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (!provinceCode || !cityCode) {
            return;
        }

        const province = normalizedRegions.find(item => item.code === provinceCode);
        const city = province?.cities?.find(item => item.code === cityCode);

        if (!city || !Array.isArray(city.districts)) {
            return;
        }

        city.districts.forEach(district => {
            const option = document.createElement('option');
            option.value = district.code;
            option.textContent = district.name;
            districtSelect.appendChild(option);
        });

        if (selected) {
            districtSelect.value = selected;
        }
    }

    provinceSelect?.addEventListener('change', () => {
        populateCities(provinceSelect.value);
    });

    citySelect?.addEventListener('change', () => {
        populateDistricts(provinceSelect.value, citySelect.value);
    });

    function openAddAddressModal() {
        if (!addressForm || !addressModal) {
            return;
        }

        addressForm.reset();
        methodContainer.innerHTML = '';
        addressForm.action = storeAddressUrl;

        populateProvinces();
        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        document.getElementById('address-modal-title').textContent = 'Tambah Alamat Baru';
        addressModal.classList.remove('hidden');
    }

    function openEditAddressModal(addressId) {
        if (!addressForm || !addressModal) {
            return;
        }

        const card = document.querySelector(`[data-address-id="${addressId}"]`);

        if (!card) {
            return;
        }

        let payload = null;

        try {
            payload = card.dataset.address ? JSON.parse(card.dataset.address) : null;
        } catch (error) {
            payload = null;
        }

        if (!payload) {
            return;
        }

        addressForm.action = card.dataset.updateUrl;
        methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('address-modal-title').textContent = 'Ubah Alamat';

        populateProvinces(payload.province ?? '');
        populateCities(payload.province ?? '', payload.city ?? '');
        populateDistricts(payload.province ?? '', payload.city ?? '', payload.district ?? '');

        typeSelect.value = payload.type ?? '';
        labelInput.value = payload.label ?? '';
        detailInput.value = payload.detail ?? '';
        postcodeInput.value = payload.postcode ?? '';
        notesInput.value = payload.notes ?? '';

        addressModal.classList.remove('hidden');
    }

    function closeAddressModal() {
        if (addressModal) {
            addressModal.classList.add('hidden');
        }
    }

    window.openAddAddressModal = openAddAddressModal;
    window.openEditAddressModal = openEditAddressModal;
    window.closeAddressModal = closeAddressModal;

    populateProvinces();
</script>
@endsection
