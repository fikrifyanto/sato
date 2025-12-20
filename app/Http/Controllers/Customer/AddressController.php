<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertAddressRequest;
use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(UpsertAddressRequest $request): RedirectResponse
    {
        $customer = $request->user();

        $customer->addresses()->create(
            array_merge($request->validated(), [
                'customer_id' => $customer->id,
            ])
        );

        return redirect()->route('customer.settings')->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function update(UpsertAddressRequest $request, Address $address): RedirectResponse
    {
        $this->ensureOwnership($request->user()->id, $address);

        $address->update($request->validated());

        return redirect()->route('customer.settings')->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(Request $request, Address $address): RedirectResponse
    {
        $this->ensureOwnership($request->user()->id, $address);

        $address->delete();

        return redirect()->route('customer.settings')->with('success', 'Alamat berhasil dihapus.');
    }

    private function ensureOwnership(int $customerId, Address $address): void
    {
        if ($address->customer_id !== $customerId) {
            abort(403);
        }
    }
}
