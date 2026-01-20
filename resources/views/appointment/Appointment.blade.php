@extends('layout.main')
@section('title', 'Appointment');

@section('main-content')

    <!-- Error Alert -->
    <div id="errorBox" class="alert alert-danger d-none">
        <i class="fas fa-exclamation-circle me-2"></i>
        <span id="errorMsg"> </span>
    </div>

    <div id="successBox" class="alert alert-danger d-none">
        <span id="successMsg"> </span>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10">
                <!-- appointments -->
                <div class="card m-3">
                    <div class="card-header">
                        <h5 class="mb-0">Create Appointment</h5>
                    </div>
                    <form id="meetingform">
                       <!-- <input type="hidden" id="startup_id" class="form-control" placeholder="startupId">-->
                        <input type="text" id="schedule" class="form-control" placeholder="Select date & time">
                        <button type="submit" class="btn btn-primary mt-3">Book Appointment</button>
                    </form>
                </div>
                <!-- list of appointment-->
                <div class="card m-3" id="table_data">
                  <!--show table in frontend javascript -->
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <link href="{{ asset('assets/css/jquerydatetimepicker.min.css') }}" rel="stylesheet">
    <script src="{{  asset('assets/js/javascript/jquery.datetimepicker.full.min.js') }}"></script>

    <script src="{{  asset('assets/js/booking.js') }}"></script>


    <script>
        $('#schedule').datetimepicker({
            format: 'Y-m-d H:i',
            step: 30, // 30-minute intervals
            minDate: 0 // Disable past dates
        });
    </script>
@endpush