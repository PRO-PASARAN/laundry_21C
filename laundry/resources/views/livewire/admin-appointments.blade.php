<div>
    <h2>Programările tuturor studenților</h2>

    <div>
        <label for="floor">Filtrează după etaj:</label>
        <input type="number" id="floor" wire:model="floor" min="0" max="5">
    </div>

    <h3>Programări</h3>
    <ul>
        @foreach ($appointments as $appointment)
            <li>
                Student: {{ $appointment->user->name }},
                Etaj: {{ $appointment->floor }},
                Cameră: {{ $appointment->room }},
                Ora: {{ $appointment->appointment_time }}
            </li>
        @endforeach
    </ul>
</div>
