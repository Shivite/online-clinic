<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4 mb-2 label-heading">
            <i class="fas fa-medkit info"> FOOD </i>
        </h5><br>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Desire For Food</label>
            <input id="desire_food" type="text" class="form-control @error('desire_food') is-invalid @enderror"
                name="desire_food"
                value="{{(isset($patient->analysisThird->desire_food)) ? $patient->analysisThird->desire_food: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Which food makes you greedy?</label>
            <input id="greedy_food" type="text" class="form-control @error('greedy_food') is-invalid @enderror"
                name="greedy_food"
                value="{{(isset($patient->analysisThird->greedy_food)) ? $patient->analysisThird->greedy_food: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Ideal Food</label>
            <input id="ideal_food" type="text" class="form-control @error('ideal_food') is-invalid @enderror"
                name="ideal_food"
                value="{{(isset($patient->analysisThird->ideal_food)) ? $patient->analysisThird->ideal_food: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Which food is intolerable to you?</label>
            <input id="donot_tolerate_food" type="text"
                class="form-control @error('donot_tolerate_food') is-invalid @enderror" name="donot_tolerate_food"
                value="{{(isset($patient->analysisThird->donot_tolerate_food)) ? $patient->analysisThird->donot_tolerate_food: '' }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Which season result in increase of our symptoms?</label>
            <select id="season_increase" class="form-control @error('season_increase') is-invalid @enderror"
                name="season_increase">
                <option
                    {{ (isset($patient->analysisThird->season_increase) && $patient->analysisThird->season_increase == 'winter') ? 'selected': '' }}
                    value="winter">Winter</option>
                <option
                    {{ (isset($patient->analysisThird->season_increase) && $patient->analysisThird->season_increase == 'summer') ? 'selected': '' }}
                    value="summer">Summer</option>
                <option
                    {{ (isset($patient->analysisThird->season_increase) && $patient->analysisThird->season_increase == 'autumn') ? 'selected': '' }}
                    value="autumn">Autumn</option>
                <option
                    {{ (isset($patient->analysisThird->season_increase) && $patient->analysisThird->season_increase == 'spring') ? 'selected': '' }}
                    value="spring">Spring</option>
                <option
                    {{ (isset($patient->analysisThird->season_increase) && $patient->analysisThird->season_increase == 'rainy') ? 'selected': '' }}
                    value="rainy">Rainya</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Which season do you like most ?</label>
            <select id="season_like" class="form-control @error('season_like') is-invalid @enderror" name="season_like">
                <option
                    {{ (isset($patient->analysisThird->season_like) && $patient->analysisThird->season_like == 'winter') ? 'selected': '' }}
                    value="winter">Winter</option>
                <option
                    {{ (isset($patient->analysisThird->season_like) && $patient->analysisThird->season_like == 'summer') ? 'selected': '' }}
                    value="summer">Summer</option>
                <option
                    {{ (isset($patient->analysisThird->season_like) && $patient->analysisThird->season_like == 'autumn') ? 'selected': '' }}
                    value="autumn">Autumn</option>
                <option
                    {{ (isset($patient->analysisThird->season_like) && $patient->analysisThird->season_like == 'spring') ? 'selected': '' }}
                    value="spring">Spring</option>
                <option
                    {{ (isset($patient->analysisThird->season_like) && $patient->analysisThird->season_like == 'rainy') ? 'selected': '' }}
                    value="rainy">Rainya</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Choice Of Cloths</label>
            <select id="cloth_choice" class="form-control @error('cloth_choice') is-invalid @enderror"
                name="cloth_choice">
                <option
                    {{ (isset($patient->analysisThird->cloth_choice) && $patient->analysisThird->cloth_choice == 'tight') ? 'selected': '' }}
                    value="tight">Tight</option>
                <option
                    {{ (isset($patient->analysisThird->cloth_choice) && $patient->analysisThird->cloth_choice == 'loose') ? 'selected': '' }}
                    value="loose">Loose</option>
                <option
                    {{ (isset($patient->analysisThird->cloth_choice) && $patient->analysisThird->cloth_choice == 'medium') ? 'selected': '' }}
                    value="medium">Medium</option>

            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Do You Feel Inflamanation</label>
            <select id="inflamanation" class="form-control @error('inflamanation') is-invalid @enderror"
                name="inflamanation">
                <option
                    {{ (isset($patient->analysisThird->inflamanation) && $patient->analysisThird->inflamanation == 'full') ? 'selected': '' }}
                    value="full">Full Body</option>
                <option
                    {{ (isset($patient->analysisThird->inflamanation) && $patient->analysisThird->inflamanation == 'particular') ? 'selected': '' }}
                    value="paticular">Particular</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="Mention the part where you feel inflamanation"
                name="men_inflamanation">{{ (isset($patient->analysisThird->men_inflamanation) ? $patient->analysisThird->men_inflamanation : '')}}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Do you prefer covring yourself with a bedsheet during sleep in the summer season?</label>
            <select id="bedsheet" class="form-control @error('bedsheet') is-invalid @enderror" name="bedsheet">
                <option
                    {{ (isset($patient->analysisThird->bedsheet) && $patient->analysisThird->bedsheet == 'yes') ? 'selected': '' }}
                    value="yes">Yes</option>
                <option
                    {{ (isset($patient->analysisThird->bedsheet) && $patient->analysisThird->bedsheet == 'no') ? 'selected': '' }}
                    value="no">No</option>
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4 mb-2 label-heading">
            <i class="fas fa-medkit info"> Modality Of Physical Symptoms </i>
        </h5><br>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>When The Symtoms Of Physical Symptoms Increase/Decrease</label>
            <select id="periodic_symptoms" class="form-control @error('periodic_symptoms') is-invalid @enderror"
                name="periodic_symptoms">
                <option
                    {{ (isset($patient->analysisThird->periodic_symptoms) && $patient->analysisThird->periodic_symptoms == 'week') ? 'selected': '' }}
                    value="week">Weekly</option>
                <option
                    {{ (isset($patient->analysisThird->periodic_symptoms) && $patient->analysisThird->periodic_symptoms == 'month') ? 'selected': '' }}
                    value="month">Monthly</option>
                <option
                    {{ (isset($patient->analysisThird->periodic_symptoms) && $patient->analysisThird->periodic_symptoms == 'year') ? 'selected': '' }}
                    value="year">Yearly</option>
                <option
                    {{ (isset($patient->analysisThird->periodic_symptoms) && $patient->analysisThird->periodic_symptoms == 'anyseason') ? 'selected': '' }}
                    value="anyseason">Any Season</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does the disease increase during full moon or new moon?</label>
            <select id="moon" class="form-control @error('moon') is-invalid @enderror" name="moon">
                <option
                    {{ (isset($patient->analysisThird->moon) && $patient->analysisThird->moon == 'full') ? 'selected': '' }}
                    value="full">The Full Moon</option>
                <option
                    {{ (isset($patient->analysisThird->moon) && $patient->analysisThird->moon == 'new') ? 'selected': '' }}
                    value="new">The New Moon</option>
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease under the sunlight?</label>
            <input id="sun" type="text" class="form-control @error('sun') is-invalid @enderror" name="sun"
                value="{{(isset($patient->analysisThird->sun)) ? $patient->analysisThird->sun: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease While Thunder Strom</label>
            <input id="thunderstrom" type="text" class="form-control @error('thunderstrom') is-invalid @enderror"
                name="thunderstrom"
                value="{{(isset($patient->analysisThird->thunderstrom)) ? $patient->analysisThird->thunderstrom: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease near the See Side Area</label>
            <input id="seeside_area" type="text" class="form-control @error('seeside_area') is-invalid @enderror"
                name="seeside_area"
                value="{{(isset($patient->analysisThird->seeside_area)) ? $patient->analysisThird->seeside_area: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease while reading</label>
            <input id="while_reading" type="text" class="form-control @error('while_reading') is-invalid @enderror"
                name="while_reading"
                value="{{(isset($patient->analysisThird->while_reading)) ? $patient->analysisThird->while_reading: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease while writing</label>
            <input id="while_writing" type="text" class="form-control @error('while_writing') is-invalid @enderror"
                name="while_writing"
                value="{{(isset($patient->analysisThird->while_writing)) ? $patient->analysisThird->while_writing: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your Disease Increase Or Decrease while thinking</label>
            <input id="while_thinking" type="text" class="form-control @error('while_thinking') is-invalid @enderror"
                name="while_thinking"
                value="{{(isset($patient->analysisThird->while_thinking)) ? $patient->analysisThird->while_thinking: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease while listening?</label>
            <input id="while_listening" type="text" class="form-control @error('while_listening') is-invalid @enderror"
                name="while_listening"
                value="{{(isset($patient->analysisThird->while_listening)) ? $patient->analysisThird->while_listening: '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Does your symptoms increase or decrease while practicing?</label>
            <input id="while_practicing" type="text"
                class="form-control @error('while_practicing') is-invalid @enderror" name="while_practicing"
                value="{{(isset($patient->analysisThird->while_practicing)) ? $patient->analysisThird->while_practicing: '' }}">
        </div>
    </div>
</div>