@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <nav class="pb-2 pt-2 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/managepet">Manage Pets</a></li>
                    <li class="breadcrumb-item active">Pet Profile</li>
                    <li class="breadcrumb-item active">Vaccination Record</li>
                </ol>
            </nav>
        </div>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="addDoseModal" tabindex="-1" aria-labelledby="addDoseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="addDoseModalLabel">Add New Dosage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Administered By -->
                    <div class="mb-3">
                        <label for="administeredBy" class="form-label">Administered By</label>
                        <select class="form-select vac-select-vet-name" id="administeredBy" name="administered_by" required>
                            <option value="Dr. Reyes">Dr. Reyes</option>
                            <option value="Dr. Cruz">Dr. Cruz</option>
                            <option value="Dr. Santos">Dr. Santos</option>
                            <!-- Add more staff names as needed -->
                        </select>
                    </div>

                    <!-- Final Dose Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="finalDose" name="final_dose">
                        <label class="form-check-label" for="finalDose">
                            Final Dose
                        </label>
                    </div>

                    <!-- Next Scheduled Dose Date -->
                    <div class="mb-3">
                        <label for="nextDoseDate" class="form-label">Next Scheduled Dose</label>
                        <div class="input-group input-group-joined">
                            <input type="text" class="form-control" id="nextDoseDate" name="next_dose_date" placeholder="Select date" readonly>
                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-soft text-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-xl px-4 mt-4">
    <nav class="nav nav-borders">
        <a class="nav-link ms-0" href="javascript:window.history.back();"><span class="px-2"><svg class="svg-inline--fa fa-arrow-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z"></path></svg><!-- <i class="fa-solid fa-arrow-left"></i> Font Awesome fontawesome.com --></span> Back</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-none">
                <div class="card-header">
                    Vaccination Record
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Pet Name</label>
                            <p>Lexie</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Type</label>
                            <p>Dog</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Breed</label>
                            <p>Japanese Spitz</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Gender</label>
                            <p>Female</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Date of Birth</label>
                            <p>August 11, 2022</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Type of Vaccination</label>
                            <p>Feline 3-in-1 Vaccine</p>
                        </div>
                        <div class="col-md-3">
                            <label for="">Vaccination Status</label>
                            <p class="rounded-pill badge badge-sm bg-primary-soft text-primary">Completed</p>
                        </div>
                    </div>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Vaccination Dose</th>
                                    <th scope="col">Date Administered</th>
                                    <th scope="col">Administered By</th>
                                    <th scope="col">Next Scheduled Dose</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3rd Dose</td>
                                    <td>August 30, 2022</td>
                                    <td>Dr. John Doe</td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>2nd Dose</td>
                                    <td>August 13, 2022</td>
                                    <td>Dr. John Doe</td>
                                    <td>August 30, 2022</td>
                                </tr>
                                <tr>
                                    <td>1st Dose</td>
                                    <td>August 11, 2022</td>
                                    <td>Dr. John Doe</td>
                                    <td>August 13, 2022</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none mb-4">
                <div class="card-header">
                    Actions
                </div>
                <div class="card-body">
                    <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#addDoseModal"><i class="fa-solid fa-plus me-2"></i>Add New Dosage</button>
                </div>
            </div>
            <div class="card shadow-none">
                <div class="card-header">
                    Owner Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Pet Owner</label>
                            <p>John Doe</p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Contact Number</label>
                            <p>09123456789</p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Address</label>
                            <p>1234 Street Name, City, Country</p>
                        </div>
                        <div class="col-md-12">
                            <label for="">Email Address</label>
                            <p>john@email.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const finalDoseCheckbox = document.getElementById('finalDose');
        const nextDoseDateGroup = document.getElementById('nextDoseDate').closest('.mb-3');

        function toggleNextDoseField() {
            if (finalDoseCheckbox.checked) {
                nextDoseDateGroup.style.display = 'none';
            } else {
                nextDoseDateGroup.style.display = '';
            }
        }

        finalDoseCheckbox.addEventListener('change', toggleNextDoseField);

        // Initial check in case it's pre-checked
        toggleNextDoseField();
    });
</script>
@endsection