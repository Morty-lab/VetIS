@php use App\Models\Clients;use Illuminate\Support\Facades\Auth; @endphp
@extends('portal.layouts.app')
@section('outerContent')
    <!-- Modals -->
    <div class="modal fade" id="appointmentRequestModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('portal.appointments.add')}}" method="post">
                    @csrf
                    @php
                        $client = Clients::getClientByUserID(Auth::user()->id)
                    @endphp
                    <input type="hidden" value="{{$client->id}}" name="owner_ID">
                    <div class="modal-header">
                        <h5 class="modal-title" id="appointmentRequestTitle">Request Appointment</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-3 gx-4">
                            <div class="col-md-6">
                                <!-- Select Pet -->
                                <div class="form-group">
                                    <label for="select-pet" class="mb-1">Select Pet</label>
                                    <select class="form-control" id="select-pet" name="pet_ID">
                                        <option value="" disabled selected>Select a Pet</option>
                                        @foreach($pets as $pet)
                                            <option value={{$pet->id}}>{{$pet->pet_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Schedule -->
                                <div class="form-group">
                                    <label for="select-schedule" class="mb-1">Select Schedule</label>
                                    <input type="date" class="form-control" id="select-schedule"
                                           name="appointment_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Veterinarian -->
                                <div class="form-group">
                                    <label for="select-veterinarian" class="mb-1">Select Veterinarian</label>
                                    <select class="form-control" id="select-veterinarian" name="doctor_ID">
                                        <option value="" disabled selected>Select a Veterinarian</option>
                                        @foreach($vets as $vet)
                                            <option
                                                value={{$vet->id}}>{{$vet->firstname. " " . $vet->lastname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- View Veterinarian Schedule -->
                                <div class="form-group">
                                    <label>&nbsp;</label> <!-- For spacing alignment -->
                                    <br>
                                    <a href="#" class="text-decoration-underline">View Veterinarian Schedule</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Concern/Complain -->
                                <div class="form-group">
                                    <label for="concern-complain" class="mb-1">Concern/Complain</label>
                                    <textarea class="form-control" id="concern-complain" name="purpose" rows="5"
                                              placeholder="Enter your concern or complaint"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Request Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <header class="mt-n10 pt-10 bg-white border-bottom">
        <div class="container-xl px-4">
            <div class="page-header-content py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-primary">Appointments</h1>
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#appointmentRequestModal">Request Appointment
                    </button>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card shadow-none border">
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Scheduled Appointments</span>
                </div>
                <div class="card-body">
                    <table id="scheduledAppointmentsTable">
                        <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Appointment ID</th>
                            <th>Pet</th>
                            <th>Veterinarian</th>
                            <th>Complaint/Concern</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $s)
                            @if($s->status === 0)
                                @php
                                    $pet = \App\Models\Pets::getPetById($s->pet_ID);
                                    $owner = Clients::getClientById($s->owner_ID);
                                @endphp
                                <tr data-index="0">
                                    <td>{{$s->appointment_date}} |
                                        {{$s->appointment_time}}
                                    </td>
                                    <td>{{sprintf("VetIS-%05d", $s->id)}}</td>
                                    <td>{{$pet->pet_name}}</td>
                                    <td>{{$owner->client_name}}</td>
                                    <td>{{$s->purpose}}</td>
                                    <td>
                                <span class="badge bg-success-soft text-success text-sm rounded-pill">
                                    Scheduled
                                </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$s->id, 'petid'=>$s->pet_ID])}}">Open</a>
                                    </td>
                                </tr>
                               @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow-none border">
                <div class="card-header d-flex d-flex justify-content-between align-items-center"><span>Appointment Requests</span>
                </div>
                <div class="card-body">
                    <table id="appointmentsRequestsTable">
                        <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Appointment ID</th>
                            <th>Pet</th>
                            <th>Veterinarian</th>
                            <th>Complaint/Concern</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $a)
                            @if($a->status === null)
                                @php
                                    $pet = \App\Models\Pets::getPetById($a->pet_ID);
                                    $owner = Clients::getClientById($a->owner_ID);
                                @endphp
                                <tr data-index="0">
                                    <td>{{$a->appointment_date}} |
                                        {{$a->appointment_time}}
                                    </td>
                                    <td>{{sprintf("VetIS-%05d", $a->id)}}</td>
                                    <td>{{$pet->pet_name}}</td>
                                    <td>{{$owner->client_name}}</td>
                                    <td>{{$a->purpose}}</td>
                                    <td>
{{--                                <span class="badge bg-success-soft text-success text-sm rounded-pill">--}}
{{--                                    Scheduled--}}
{{--                                </span>--}}
                                        <span class="badge bg-warning-soft text-warning text-sm rounded-pill">Pending</span>
{{--                                        <span class="badge bg-danger-soft text-danger text-sm rounded-pill">Cancelled</span>--}}
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{route('portal.appointments.view',['appid'=>$a->id, 'petid'=>$a->pet_ID])}}">Open</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
