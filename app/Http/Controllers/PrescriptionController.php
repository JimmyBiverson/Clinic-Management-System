<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function dispense(Request $request, Prescription $prescription)
    {
        $prescription->update([
            'status' => $prescription->status === 'Dispensed' ? 'Pending' : 'Dispensed',
            'dispensed_at' => $prescription->status === 'Dispensed' ? null : now(),
            'dispensed_by' => $prescription->status === 'Dispensed' ? null : auth()->id(),
        ]);

        return back()->with('success', 'Prescription updated.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return back()->with('success', 'Prescription line removed.');
    }
}
