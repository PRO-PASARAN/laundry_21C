<div>
    <h2>Programările mele</h2>

    <form wire:submit.prevent="createAppointment">
        <div>
            <label for="floor">Etaj:</label>
            <input type="number" id="floor" wire:model="floor" min="0" max="5">
            @error('floor') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="room">Cameră:</label>
            <input type="text" id="room" wire:model="room">
            @error('room') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="appointment_time">Ora programării:</label>
            <input type="datetime-local" id="appointment_time" wire:model="appointment_time">
            @error('appointment_time') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Creează programare</button>
    </form>

    <h3>Programările existente</h3>
    <ul>
        @foreach ($appointments as $appointment)
            <li>
                Etaj: {{ $appointment->floor }}, Cameră: {{ $appointment->room }}, Ora: {{ $appointment->appointment_time }}
            </li>
        @endforeach
    </ul>
</div>
