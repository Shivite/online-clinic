<div class="form-group">
    <label>Select Time Slot </label>
    <select id="timeslot" class="form-control @error('timeslot') is-invalid @enderror" name="timeslot" required>
        @foreach($timeSlots as $timeSlot)
        <option value="{{ $timeSlot }}"> {{ $timeSlot }}</option>
        @endforeach
    </select>
</div>