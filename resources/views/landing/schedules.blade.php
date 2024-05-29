@extends('layouts.landing')

@section('title')
    Schedules &sdot; 
@endsection

@section('content')
@if(!$myReservation)
<main class="main">
  <section class="articles">
    <div class="container">
      <div class="section-heading">
        <h2>Schedules</h2>
      </div>
      <div class="row">
        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-body">
              <form class="pt-3 pb-3 px-5" data-form="reserveSpace">
                @csrf
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label class="form-label">Learning Spaces</label>
                    <select class="form-control" data-select="facility">  
                      <option value="" selected disabled>Choose a learning space...</option>
                      @foreach($learningSpaces as $learningSpace)
                        <option value="{{ $learningSpace->id }}" ' . {{ $facility == $learningSpace->id ? 'selected' : '' }}>{{ $learningSpace->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label class="form-label">Choose date</label>
                    <br>
                    <!-- <input class="form-control" type="date" data-input="date" onkeydown="return false" disabled> -->
                    <select class="form-control" data-select="date" disabled>
                      <option value="" selected disabled>Choose date...</option>
                      <?php
                        $allowedDays = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
                        $dateBegin = date('Y') . '-' . date('m') . '-' . date('d');
                        $begin = new DateTime($dateBegin);
                        $end = new DateTime($dateBegin);
                        $begin = $begin->modify('+1 day');
                        $daysModifier = 14;
                        switch($begin->format('D')) {
                          case 'Mon':
                            $daysModifier = 14;
                            break;
                          case 'Tue':
                            $daysModifier = 13;
                            break;
                          case 'Wed':
                            $daysModifier = 12;
                            break;
                          case 'Thu':
                            $daysModifier = 11;
                            break;
                          case 'Fri':
                          case 'Sat':
                          case 'Sun':
                            $daysModifier = 16;
                            break;
                        }
                        $end = $end->modify('+' . $daysModifier . ' days');

                        $interval = new DateInterval('P1D');
                        $daterange = new DatePeriod($begin, $interval ,$end);

                        foreach($daterange as $date) {
                            if(in_array($date->format("D"), $allowedDays)) {
                              echo '<option value="' . $date->format("Y-m-d") . '">' . $date->format("F j, Y") . " - " . $date->format("l") . '</option>';
                            }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label class="form-label">Choose a duration hour/s</label>
                    <select class="form-control" data-select="duration" disabled>
                      <option value="" selected disabled>Choose duration hour/s...</option>
                      <option value="1">1 hour</option>
                      <option value="2">2 hours</option>
                      <option value="3">3 hours</option>
                      <option value="4">4 hours</option>
                      <option value="5">5 hours</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body d-none" data-show="schedules">
              <div class="table-responsive-md">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Availability</th>
                      <th>Time</th>
                      <th>Duration</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody data-tbody="schedules"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <br><br><br>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="reservationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reservationModalLabel">Reservation details</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 py-2 px-4">
              <div class="card flex-lg-row flex-md-column flex-sm-column">
                <img src="images/facilities/collaboration-area.jpg" height="100%" data-image="facility">
                <div class="card-body">
                  <h3 data-input="facility">Collaboration Area</h3>
                  <p>
                    <i class="far fa-calendar"></i> Date: <span class="badge badge-warning text-white" data-input="date">__-__-____</span><br>
                    <i class="far fa-clock"></i> Time Duration: <span class="badge badge-warning text-white" data-input="duration">__ hours/s</span><br>
                    <i class="far fa-clock"></i> Schedule: <span class="badge badge-warning text-white" data-input="schedule">__:__ __ - __:__ __</span><br>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <form class="px-3" data-form="additionalDetails">
                <div class="form-group">
                  <label for="Purpose of Reservation">Purpose of Reservation</label>
                  <input class="form-control confirm_required" type="text" placeholder="Type your purpose of reservation..." id="purpose" required>
                </div>
                <div class="form-group">
                  <label for="Number Guests">No. of guests</label>
                  <input class="form-control confirm_required" type="number" placeholder="No. of guests..." id="no_of_guests" required>
                </div>
                <div class="form-group">
                  <label for="Activity Description">Activity Description (Optional)</label>
                  <textarea class="form-control confirm_required" placeholder="Type activity description..." style="height: 100px;" id="activity_description" required></textarea>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" required data-input="checkbox"><label class="form-check-label" for="Accept Rules and Regulations">Accept Rules & Regulations</label>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a type="button" class="button-sm button-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancel</a>
          <button type="button" class="button-sm button-warning border-0" data-submit="confirmReservation" disabled>Confirm reservation</button>
      </div>
    </div>
  </div>
</main>
@else
<main class="main">
  <section class="articles">
    <div class="container">
      <div class="section-heading mb-0">
        <h2>My Reservation</h2>
      </div>
      <div class="card">
        <div class="card-horizontal">
          @php
            $status = "badge-primary";

            switch($myReservation->status) {
                case "pending":
                    $status = "badge-primary";
                    break;
                case "confirmed":
                    $status = "badge-success";
                    break;
                case "rejected":
                    $status = "badge-danger";
                    break;
            }
            $reservation_date = Carbon\Carbon::parse($myReservation->reservation_date);
            $start_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $myReservation->start_time));
            $end_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $myReservation->end_time));

            $duration = $end_time->diff($start_time);
            $image = $myReservation->learningSpace->slug == "collaboration-room" ? "collaboration-area" : "learning-common-1";
          @endphp
          <div class="img-square-wrapper">
              <img class="" src="images/facilities/{{ $image }}.jpg" alt="Card image cap" style="height: 180px;">
          </div>
          <div class="card-body">
            <!-- <h3>{{ $controlNumber }} </h3> -->
            <h4 class="card-title">{{ $myReservation->learningSpace->name  }} <span class="badge badge-pill {{ $status }}">{{ Str::upper($myReservation->status) }}</span></h4>
            <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Date</span> {{ $reservation_date->format('F d, Y') }} ({{$reservation_date->format('l')}})</p>
            <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Time</span> {{ Carbon\Carbon::parse($myReservation->start_time)->format('h:i A') }} - {{ Carbon\Carbon::parse($myReservation->end_time)->format('h:i A') }} ({{ $duration->format('%h') }} hours)</p>
            <p class="card-text"><span class="badge badge-pill badge-warning">Participants</span> {{ $myReservation->no_of_guests}}</p>
          </div>
        </div>
        <div class="card-footer">
            <small class="text-muted">Date booked: {{ $reservation->created_at->format('F d, Y') }}</small>
        </div>
      </div>
    </div>
  </section>
</main>
@endif
<script>
  const form = document.querySelector('[data-form="reserveSpace"]');
  const facilitySelect = document.querySelector('[data-select="facility"]');
  const dateSelect = document.querySelector('[data-select="date"]');
  const durationSelect = document.querySelector('[data-select="duration"]');
  const schedulesTable = document.querySelector('[data-show="schedules"]');
  const schedulesContent = document.querySelector('[data-tbody="schedules"]');

  let hasFacility = false;
  let hasDate = false;
  let hasDuration = false;

  let start_time = null;
  let end_time = null;

  form.addEventListener('change', (e) => {
    Validate();
  });

  function Validate() {
    if(facilitySelect.value === "") {
      hasFacility = false;
    } else {
      if(facilitySelect === document.activeElement) {
        dateSelect.removeAttribute("disabled");
        if(!durationSelect.hasAttribute("disabled")) {
          dateSelect.value = '';
          durationSelect.selectedIndex = 0;
          durationSelect.setAttribute("disabled", "");
        }
        hasFacility = true;
        hasDate = false;
        hasDuration = false;
      }
    }
    if(dateSelect.value === "") {
      hasDate = false;
    } else {
      if(dateSelect === document.activeElement) {
        durationSelect.removeAttribute("disabled");
        hasDate = true;
        hasDuration = false;
        durationSelect.selectedIndex = 0;
      }
    }
    if(durationSelect.value === "") {
      hasDuration = false;
    } else {
      if(durationSelect === document.activeElement) {
        hasDuration = true;
      }
    }
    if(hasFacility && hasDate && hasDuration) {
      LoadSchedules();
    } else {
      HideSchedules();
    }
  }

  function LoadSchedules() {
    var formData = new FormData();
    formData.append('learning_space_id', facilitySelect.options[facilitySelect.selectedIndex].value);
    formData.append('reservation_date', dateSelect.options[dateSelect.selectedIndex].value);
    formData.append('duration', durationSelect.options[durationSelect.selectedIndex].value);
    formData.append('_token', "{{ csrf_token() }}");
    $.ajax({
        type: "POST",
        url: "{{ route('schedules.getAvailableSlots') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          // let data = JSON.parse(response);
          //console.log(response['available']);
          let data = response;
          ShowSchedules();
          let contents = '';
          for (const [key, value] of Object.entries(data)) {
            if(durationSelect.options[durationSelect.selectedIndex].value == value['duration']) {
              let button = value['availability'] === "Available" ? '<a class="button button-warning" href="javascript:void(0)" data-submit="schedule" data-start="' + value['start'] + '" data-end="' + value['end'] + '" data-duration="' + value['duration'] + '">Reserve</a>' : '';
              let duration = value['duration'] > 1 ? value['duration'] + ' hours' : value['duration'] + ' hour';
              let availability = value['availability'] === "Available" ? '<span class="badge badge-success">Available</span>' : '<span class="badge badge-danger">Reserved</span>';
              contents += `<tr><td class="text-center">` + availability + `</td><td>${value['start']} - ${value['end']}</td><td>` + duration + `</td><td class="text-center">` + button + `</td></tr>`;
            }
          }
          schedulesContent.innerHTML = contents;
        }
    });
  }
  
  function ShowSchedules() {
    if(schedulesTable.classList.contains('d-none')) {
      schedulesTable.classList.remove('d-none');
    }
  }

  function HideSchedules() {
    if(!schedulesTable.classList.contains('d-none')) {
      schedulesTable.classList.add('d-none');
    }
  }

  document.addEventListener("click", (e) => {
    e = e || window.event;
    var target = e.target || e.srcElement;
    switch(target.dataset.submit) {
      case "schedule":
        start_time = target.dataset.start;
        end_time = target.dataset.end;

        // document.querySelector('[data-input="facility"]').src = facilitySelect.options[facilitySelect.selectedIndex].text;
        document.querySelector('[data-input="facility"]').innerHTML = facilitySelect.options[facilitySelect.selectedIndex].text;
        document.querySelector('[data-input="date"]').innerHTML = dateSelect.options[dateSelect.selectedIndex].text;
        document.querySelector('[data-input="duration"]').innerHTML = target.dataset.duration + " hour" + (target.dataset.duration > 1 ? "s" : "");
        document.querySelector('[data-input="schedule"]').innerHTML = start_time + " - " + end_time;
        // Trigger the modal when the page is fully loaded
        $(document).ready(function() {
            $('#reservationModal').modal('show');
        });
        break;
      case "confirmReservation":
        var formData = new FormData();
        formData.append('learning_space_id', facilitySelect.options[facilitySelect.selectedIndex].value);
        formData.append('reservation_date', dateSelect.options[dateSelect.selectedIndex].value);
        formData.append('start_time', start_time);
        formData.append('end_time', end_time);
        formData.append('duration', durationSelect.options[durationSelect.selectedIndex].value);
        formData.append('purpose', $('#purpose').val());
        formData.append('no_of_guests', $('#no_of_guests').val());
        formData.append('activity_description', $('#activity_description').val());
        formData.append('_token', "{{ csrf_token() }}");
        $.ajax({
            type: "POST",
            url: "{{ route('schedules.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              Swal.fire({
                icon: "success",
                title: "Schedule reserved successfully!",
                showConfirmButton: false,
                timer: 1500,
                willClose: () => {
                  $(document).ready(function() {
                    $('#reservationModal').modal('hide');

                    window.location = "{{ route('schedules.index') }}";
                  });
                }
              });
            }
        });
        break;
    }
  });

  const additionalDetailsForm = document.querySelector('[data-form="additionalDetails"]');
  const confirmButton = document.querySelector('[data-submit="confirmReservation"]');
  const requiredFields = document.querySelectorAll('.confirm_required');
  const checkbox = document.querySelector('[data-input="checkbox"]');

  additionalDetailsForm.addEventListener('input', function () {
    let allFilled = true;
    requiredFields.forEach(field => {
        if (!field.value) {
          allFilled = false;
        }
        if(!checkbox.checked) {
          allFilled = false;
        }
    });
    confirmButton.disabled = !allFilled;
  });
</script>
@endsection