<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $query = Appointment::with('user')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date')
            ->orderBy('slot');

        if ($user->role === 'admin') {
            if ($request->has('floor') && $request->floor !== '') {
                $query->where('floor', $request->floor);
            }
        } else {
            $query->where('floor', $user->floor);
        }

        $appointments = $query->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $user = Auth::user();
        $slots = ['08-12', '12-16', '16-20', '20-24', '00-04'];
        return view('appointments.create', [
            'slots' => $slots,
            'user_floor' => $user->floor,
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->back()->with('success', 'Programarea a fost ștearsă cu succes.');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'slot' => 'required|in:08-12,12-16,16-20,20-24,00-04',
        ]);

        // Verifică dacă slotul este deja ocupat pe etajul respectiv
        $exists = Appointment::where('date', $request->date)
            ->where('slot', $request->slot)
            ->where('floor', $user->role === 'admin' ? $request->floor : $user->floor)
            ->exists();

        if ($exists) {
            return back()->withErrors(['slot' => 'Acest slot este deja ocupat pe etajul selectat!'])->withInput();
        }

        Appointment::create([
            'user_id' => $user->id,
            'floor' => $user->role === 'admin' ? $request->floor : $user->floor,
            'date' => $request->date,
            'slot' => $request->slot,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Programare adăugată cu succes!');
    }
}
