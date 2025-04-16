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
            <tr><td>Subject: Annual Check-Up</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table>
            <tr><td>Veterinarian: Dr. Maria Santos</td></tr>
            <tr><td>Owner: Juan Dela Cruz</td></tr>
            <tr><td>Owner Contact No.: 09123456789</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table>
            <tr><td>Date Created: April 14, 2025</td></tr>
            <tr><td>Status: Completed</td></tr>
        </table>
    </div>
</div>

<h2>Pet Information</h2>
<div class="row gy-1 gx-1">
    <div class="col-6">
        <table class="mb-0">
            <tr><td>Pet Name</td><td>Lexie</td></tr>
            <tr><td>Pet Type</td><td>Dog</td></tr>
            <tr><td>Breed</td><td>Japanese Spitz</td></tr>
            <tr><td>Color</td><td>White</td></tr>
        </table>
    </div>
    <div class="col-6">
        <table class="mb-0">
            <tr><td>Birthdate</td><td>January 15, 2021</td></tr>
            <tr><td>Spayed/Neutered</td><td>Yes</td></tr>
            <tr><td>Anti-Rabies</td><td>Given - March 2025</td></tr>
            <tr><td>Vaccinated Date</td><td>April 10, 2025</td></tr>
        </table>
    </div>
    <div class="col-12">
        <h3>Medical Info</h3>
        <table>
            <tr><td>Medical Condition</td><td>None</td></tr>
            <tr><td>Allergies</td><td>Chicken</td></tr>
            <tr><td>Aggression History</td><td>None</td></tr>
        </table>
    </div>
</div>
<hr>
<h2>Chief Complaint</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    Occasional scratching and dry skin patches on hind legs.
</div>

<h2>Examination</h2>
<table>
    <tr><td>Temp</td><td>38.6°C</td></tr>
    <tr><td>Heart Rate</td><td>90 bpm</td></tr>
    <tr><td>Resp. Rate</td><td>25 breaths/min</td></tr>
    <tr><td>Weight</td><td>7.8 kg</td></tr>
    <tr><td>Length</td><td>45 cm</td></tr>
    <tr><td>Height</td><td>30 cm</td></tr>
    <tr><td>Body Condition</td><td>☐ Underweight ☑ Normal ☐ Overweight</td></tr>
    <tr><td>Appearance</td><td>☑ Active ☐ Lethargic ☐ Aggressive</td></tr>
    <tr><td>Skin & Coat</td><td>☐ Healthy ☑ Dry ☐ Hair Loss</td></tr>
    <tr><td>EENT</td><td>☑ Clear ☐ Discharge ☐ Redness</td></tr>
    <tr><td>Mouth/Teeth</td><td>☑ Healthy ☐ Tartar ☐ Gingivitis</td></tr>
    <tr><td>Lymph Nodes</td><td>☑ Normal ☐ Swollen</td></tr>
    <tr><td>CVS</td><td>☑ Normal ☐ Murmurs</td></tr>
    <tr><td>Resp. System</td><td>☑ Normal ☐ Coughing</td></tr>
    <tr><td>Digestive</td><td>☑ Normal ☐ Vomiting ☐ Diarrhea</td></tr>
    <tr><td>Musculoskeletal</td><td>☑ Normal ☐ Limping</td></tr>
    <tr><td>Neuro</td><td>☑ Normal ☐ Seizures</td></tr>
    <tr><td>Other Notes</td><td style="height: 40px;">No abnormalities observed.</td></tr>
</table>

<h2>Diagnosis</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    Mild dermatitis due to dry skin. No signs of infection.
</div>

<h2>Treatment</h2>

<h3>Medication Received</h3>
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
    <tr><td>Hydrocortisone Cream</td><td>Thin layer</td><td>2x daily</td><td>Topical</td></tr>
    </tbody>
</table>

<h3>Procedure Received</h3>
<table>
    <thead>
    <tr>
        <th>Procedure</th>
        <th>Outcome</th>
    </tr>
    </thead>
    <tbody>
    <tr><td>Skin Scraping</td><td>Negative for mites</td></tr>
    </tbody>
</table>

<h3>Treatment Notes</h3>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    Apply cream as prescribed. Monitor for worsening symptoms or signs of infection.
</div>

<h2>Remarks</h2>
<div class="border border-dark w-100 p-1" style="min-height: 90px">
    Return visit in 2 weeks for follow-up check.
</div>

<hr>

<h2>Prescriptions</h2>
<table>
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
    <tr><td>Omega-3 Supplement</td><td>1 capsule</td><td>Once daily</td><td>30 days</td><td>For skin health</td></tr>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
