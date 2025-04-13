<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;

class AdminAppointments extends Component
{
    public $floor;

    public function render()
    {
        $appointments = Appointment::when($this->floor, function ($query) {
            $query->where('floor', $this->floor);
        })->get();

        return view('livewire.admin-appointments', [
            'appointments' => $appointments,
        ]);
    }
}
