<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Medical Record</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }
        h2 { font-size: 16px; margin: 30px 0 10px; }
        h3 { font-size: 14px; margin: 20px 0 8px; }
    </style>
</head>
<body>

<div class="text-center mb-3">
    <h4>Pruderich Veterinary Clinic</h4>
    <p>Purok - 3, Dologon, Maramag, Bukidnon | +63 917 620 0620</p>
</div>
<hr>
<div class="row gx-1 gy-1">
    <div class="col-12">
        <table class="mb-0">
            <tr><td>Subject: {{ $record->subject }}</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table>
            @php
                $doctor = '';
                if (!is_null($record->doctorID)) {
                    $doctor = \App\Models\Doctor::getName($record->doctorID);
                }
            @endphp
            <tr><td>Veterinarian: Dr. {{ $doctor ?? '' }}</td></tr>
            <tr><td>Owner: {{ $owner->client_name }}</td></tr>
            <tr><td>Owner Contact No.: {{ $owner->client_no }}</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table>
            <tr><td>Date Created:  {{ \Carbon\Carbon::parse($record->record_date)->format('F d, Y h:i A') }}</td></tr>
            <tr><td>Status: {{ $record->status == 0 ? 'Ongoing' : ($record->status == 1 ? 'Completed' : 'Archived') }}</td></tr>
        </table>
    </div>
</div>

<h2>Pet Information</h2>
<div class="row gy-1 gx-1">
    <div class="col-6">
        <table class="mb-0">
            <tr><td>Pet Name</td><td>{{ $pet->pet_name }}</td></tr>
            <tr><td>Pet Type</td><td>{{ $pet->pet_type }}</td></tr>
            <tr><td>Breed</td><td>{{ $pet->pet_breed }}</td></tr>
            <tr><td>Color</td><td>{{ $pet->pet_color }}</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table class="mb-0">
            <tr><td>Birthdate</td><td> {{ \Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y') }}</td></tr>
            <tr><td>Spayed/Neutered</td><td> {{ $pet->neutered === null ? 'No Record' : ($pet->neutered == 1 ? 'Yes' : 'No') }}</td></tr>
            <tr><td>Vaccinated with Anti-Rabies?</td><td> {{ $pet->vaccinated_anti_rabies === null ? 'No Record' : ($pet->vaccinated_anti_rabies == 1 ? 'Yes' : 'No') }}</td></tr>
            <tr><td>Vaccination Date</td><td>{{ $pet->anti_rabies_vaccination_date ? \Carbon\Carbon::parse($pet->anti_rabies_vaccination_date)->format('F j, Y') : 'No Record' }}</td></tr>
        </table>
    </div>
    <div class="col-12">
        <h3>Medical Info</h3>
        <table>
            <tr><td>Medical Condition</td><td>{{ $pet->pet_condition != null ? $pet->pet_condition : 'No Conditions Recorded' }}</td></tr>
            <tr><td>Allergies</td><td>{{ $pet->food_allergies != null ? $pet->food_allergies : 'No Allergies Recorded' }}</td></tr>
            <tr><td>Aggression History</td><td>{{ $pet->history_of_aggression != null ? $pet->history_of_aggression : 'No History of Aggression Identified' }}</td></tr>
        </table>
    </div>
</div>
<hr>
<h2>Chief Complaint</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    {!! $record->complaint !!}
</div>

<h2>Examination</h2>
<table>
    @php
        $bodyCondition = isset($examination->body_condition) 
            ? json_decode($examination->body_condition, true) 
            : [];
        $generalAppearance = isset($examination->general_appearance) 
            ? json_decode($examination->general_appearance, true) 
            : [];
        $skinCoatCondition = isset($examination->skin_coat_condition)
            ? json_decode($examination->skin_coat_condition, true)
            : [];
        $eyesEarsNoseThroat = isset($examination->eyes_ears_nose_throat)
            ? json_decode($examination->eyes_ears_nose_throat, true)
            : [];
        $mouthTeeth = isset($examination->mouth_teeth)
            ? json_decode($examination->mouth_teeth, true)
            : [];
        $lymphNodes = isset($examination->lymph_nodes)
            ? json_decode($examination->lymph_nodes, true)
            : [];
        $cardiovascularSystem = isset($examination->cardiovascular_system)
            ? json_decode($examination->cardiovascular_system, true)
            : [];
            $respiratorySystem = isset($examination->respiratory_system)
        ? json_decode($examination->respiratory_system, true)
        : [];
        $digestiveSystem = isset($examination->digestive_system)
            ? json_decode($examination->digestive_system, true)
            : [];

        $musculoskeletalSystem = isset($examination->musculoskeletal_system)
            ? json_decode($examination->musculoskeletal_system, true)
            : [];

        $neurologicalSystem = isset($examination->neurological_system)
            ? json_decode($examination->neurological_system, true)
            : [];
    @endphp
    <tr><td>Temp</td><td>{{ $examination->temperature ?? '' }}°C</td></tr>
    <tr><td>Heart Rate</td><td>{{ $examination->heart_rate ?? '' }} bpm</td></tr>
    <tr><td>Resp. Rate</td><td>{{ $examination->respiration_rate ?? '' }} breaths/min</td></tr>
    <tr><td>Weight</td><td>{{ $examination->weight ?? '' }} kg</td></tr>
    <tr><td>Length</td><td>{{ $examination->length ?? '' }} cm</td></tr>
    <tr><td>Height</td><td>{{ $examination->height ?? '' }} cm</td></tr>
    <tr><td>Body Condition</td><td> {{ isset($bodyCondition['underweight']) && $bodyCondition['underweight'] == 'on' ? '☑' : '☐' }} Underweight {{ isset($bodyCondition['normal']) && $bodyCondition['normal'] == 'on' ? '☑' : '☐' }} Normal {{ isset($bodyCondition['overweight']) && $bodyCondition['overweight'] == 'on' ? '☑' : '☐' }} Overweight</td></tr>
    <tr><td>Appearance</td><td>{{ isset($generalAppearance['active']) && $generalAppearance['active'] == 'on' ? '☑' : '☐' }} Active {{ isset($generalAppearance['lethargic']) && $generalAppearance['lethargic'] == 'on' ? '☑' : '☐' }} Lethargic {{ isset($generalAppearance['unresponsive']) && $generalAppearance['unresponsive'] == 'on' ? '☑' : '☐' }} Unresponsive {{ isset($generalAppearance['aggressive']) && $generalAppearance['aggressive'] == 'on' ? '☑' : '☐' }} Aggressive</td></tr>
    <tr>
        <td>Skin & Coat</td>
        <td>
            {{ isset($skinCoatCondition['healthy']) && $skinCoatCondition['healthy'] == 'on' ? '☑' : '☐' }} Healthy
            {{ isset($skinCoatCondition['dry']) && $skinCoatCondition['dry'] == 'on' ? '☑' : '☐' }} Dry
            {{ isset($skinCoatCondition['flaky']) && $skinCoatCondition['flaky'] == 'on' ? '☑' : '☐' }} Flaky
            {{ isset($skinCoatCondition['hairLoss']) && $skinCoatCondition['hairLoss'] == 'on' ? '☑' : '☐' }} Hair Loss
            {{ isset($skinCoatCondition['parasites']) && $skinCoatCondition['parasites'] == 'on' ? '☑' : '☐' }} Parasites Present
        </td>
    </tr>
    <tr>
        <td>Eyes, Ears, Nose, & Throat</td>
        <td>
            {{ isset($eyesEarsNoseThroat['clear']) && $eyesEarsNoseThroat['clear'] == 'on' ? '☑' : '☐' }} Clear
            {{ isset($eyesEarsNoseThroat['discharge']) && $eyesEarsNoseThroat['discharge'] == 'on' ? '☑' : '☐' }} Discharge
            {{ isset($eyesEarsNoseThroat['redness']) && $eyesEarsNoseThroat['redness'] == 'on' ? '☑' : '☐' }} Redness
            {{ isset($eyesEarsNoseThroat['swelling']) && $eyesEarsNoseThroat['swelling'] == 'on' ? '☑' : '☐' }} Swelling
        </td>
    </tr>
    
    <tr>
        <td>Mouth & Teeth</td>
        <td>
            {{ isset($mouthTeeth['healthy']) && $mouthTeeth['healthy'] == 'on' ? '☑' : '☐' }} Healthy
            {{ isset($mouthTeeth['tartar']) && $mouthTeeth['tartar'] == 'on' ? '☑' : '☐' }} Tartar
            {{ isset($mouthTeeth['gingivitis']) && $mouthTeeth['gingivitis'] == 'on' ? '☑' : '☐' }} Gingivitis
            {{ isset($mouthTeeth['missingTeeth']) && $mouthTeeth['missingTeeth'] == 'on' ? '☑' : '☐' }} Missing Teeth
        </td>
    </tr>
    <tr>
        <td>Lymph Nodes</td>
        <td>
            {{ isset($lymphNodes['normal']) && $lymphNodes['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($lymphNodes['swollen']) && $lymphNodes['swollen'] == 'on' ? '☑' : '☐' }} Swollen
            {{ isset($lymphNodes['enlarged']) && $lymphNodes['enlarged'] == 'on' ? '☑' : '☐' }} Enlarged
        </td>
    </tr>
    
    <tr>
        <td>Cardiovascular System</td>
        <td>
            {{ isset($cardiovascularSystem['normal']) && $cardiovascularSystem['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($cardiovascularSystem['murmurs']) && $cardiovascularSystem['murmurs'] == 'on' ? '☑' : '☐' }} Murmurs
            {{ isset($cardiovascularSystem['irregularBeat']) && $cardiovascularSystem['irregularBeat'] == 'on' ? '☑' : '☐' }} Irregular Heartbeat
        </td>
    </tr>
    <tr>
        <td>Respiratory System</td>
        <td>
            {{ isset($respiratorySystem['normal']) && $respiratorySystem['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($respiratorySystem['wheezing']) && $respiratorySystem['wheezing'] == 'on' ? '☑' : '☐' }} Wheezing
            {{ isset($respiratorySystem['coughing']) && $respiratorySystem['coughing'] == 'on' ? '☑' : '☐' }} Coughing
            {{ isset($respiratorySystem['laboredBreathing']) && $respiratorySystem['laboredBreathing'] == 'on' ? '☑' : '☐' }} Labored Breathing
        </td>
    </tr>

    <tr>
        <td>Digestive System</td>
        <td>
            {{ isset($digestiveSystem['normal']) && $digestiveSystem['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($digestiveSystem['bloating']) && $digestiveSystem['bloating'] == 'on' ? '☑' : '☐' }} Bloating
            {{ isset($digestiveSystem['vomiting']) && $digestiveSystem['vomiting'] == 'on' ? '☑' : '☐' }} Vomiting
            {{ isset($digestiveSystem['diarrhea']) && $digestiveSystem['diarrhea'] == 'on' ? '☑' : '☐' }} Diarrhea
        </td>
    </tr>

    <tr>
        <td>Musculoskeletal System</td>
        <td>
            {{ isset($musculoskeletalSystem['normal']) && $musculoskeletalSystem['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($musculoskeletalSystem['limping']) && $musculoskeletalSystem['limping'] == 'on' ? '☑' : '☐' }} Limping
            {{ isset($musculoskeletalSystem['jointPain']) && $musculoskeletalSystem['jointPain'] == 'on' ? '☑' : '☐' }} Joint Pain
            {{ isset($musculoskeletalSystem['muscleAtrophy']) && $musculoskeletalSystem['muscleAtrophy'] == 'on' ? '☑' : '☐' }} Muscle Atrophy
        </td>
    </tr>

    <tr>
        <td>Neurological System</td>
        <td>
            {{ isset($neurologicalSystem['normal']) && $neurologicalSystem['normal'] == 'on' ? '☑' : '☐' }} Normal
            {{ isset($neurologicalSystem['seizures']) && $neurologicalSystem['seizures'] == 'on' ? '☑' : '☐' }} Seizures
            {{ isset($neurologicalSystem['weakness']) && $neurologicalSystem['weakness'] == 'on' ? '☑' : '☐' }} Weakness
            {{ isset($neurologicalSystem['uncoordinatedMovements']) && $neurologicalSystem['uncoordinatedMovements'] == 'on' ? '☑' : '☐' }} Uncoordinated Movements
        </td>
    </tr>
    <tr><td>Other Notes</td><td style="height: 40px;"> {!! $record->examination !!}</td></tr>
</table>

<h2>Diagnosis</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    {!! $record->diagnosis !!}
</div>

<h2>Treatment</h2>

<h3>Medication Received</h3>
@if (!empty($recordTreatment) && count($recordTreatment) > 0)
    <table>
        <thead>
            <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recordTreatment as $treatment)
                <tr>
                    <td>
                        {{ $medications->firstWhere('id', $treatment->productID)?->product_name ?? 'Unknown Medication' }}
                    </td>
                    <td>{{ $treatment->dosage }}</td>
                    <td>{{ $treatment->frequency }}</td>
                    <td>{{ $treatment->medication_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <thead>
            <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="text-center">No medications recorded.</td>
            </tr>
        </tbody>
    </table>
@endif


<h3>Procedure Received</h3>
@if (isset($procedures) && count($procedures) > 0)
    <table>
        <thead>
            <tr>
                <th>Procedure</th>
                <th>Outcome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($procedures as $procedure)
                <tr>
                    <td>
                        {{ $services->firstWhere('id', $procedure->serviceID)?->service_name ?? 'Unknown Procedure' }}
                    </td>
                    <td>{{ $procedure->outcome ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <thead>
            <tr>
                <th>Procedure</th>
                <th>Outcome</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="text-center">No procedures recorded.</td>
            </tr>
        </tbody>
    </table>
@endif

<h3>Treatment Notes</h3>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    {!! $record->treatment_notes !!}
</div>

<h2>Remarks</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    {!! $record->remarks !!}
</div>

<hr>
<h2>Prescriptions</h2>
@if (isset($prescriptions) && count($prescriptions) > 0)
    <table class="">
        <thead>
            <tr>
                <th>Prescription</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->medication }}</td>
                    <td>{{ $prescription->dosage }}</td>
                    <td>{{ $prescription->frequency }}</td>
                    <td>{{ $prescription->duration }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table class="">
        <thead>
            <tr>
                <th>Prescription</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Duration</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" class="text-center">No prescriptions recorded.</td>
            </tr>
        </tbody>
    </table>
@endif

<h3>Prescription Notes</h3>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    {!! $record->prescription_notes !!}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

