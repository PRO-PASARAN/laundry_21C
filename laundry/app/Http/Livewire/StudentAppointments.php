<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StudentAppointments extends Component
{
    public $floor;
    public $room;
    public $appointment_time;

    public function createAppointment()
    {
        $this->validate([
            'floor' => 'required|integer|min:0|max:5',
            'room' => 'required|string|max:10',
            'appointment_time' => 'required|date|after:now',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'floor' => $this->floor,
            'room' => $this->room,
            'appointment_time' => $this->appointment_time,
        ]);

        session()->flash('message', 'Programarea a fost creată cu succes!');
        $this->reset(['floor', 'room', 'appointment_time']);
    }

    public function render()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();

        return view('livewire.student-appointments', [
            'appointments' => $appointments,
        ]);
    }
}
