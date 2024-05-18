@extends('layouts.landing')

@section('title')
    Schedules &sdot; 
@endsection

@section('content')
<main class="main">
  <section class="articles" data-step="first">
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
                    <label class="form-label">Facility</label>
                    <select class="form-control" data-select="facility">
                      <?php
                        $arrayOfFacilities = array(
                          '1' => "Collaboration Area",
                          '2' => "Learning Common 1",
                          '3' => "Learning Common 2",
                          '4' => "Learning Common 3"
                        );
                        echo '<option value="" ' . (is_null($facility) ? 'selected' : '') . ' disabled>Select facility</option>';
                        foreach($arrayOfFacilities as $key => $value) {
                          echo '<option value="' . $key . '" ' . ($facility == $key ? 'selected' : '') . '>' . $value . '</option>';
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <label class="form-label">Select date</label>
                    <br>
                    <!-- <input class="form-control" type="date" data-input="date" onkeydown="return false" disabled> -->
                    <select class="form-control" data-select="date" disabled>
                      <option value="" selected disabled>Select date</option>
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
                    <label class="form-label">Select duration hour/s</label>
                    <select class="form-control" data-select="duration" disabled>
                      <option value="" selected disabled>Select duration hour/s</option>
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
  <section class="articles d-none" data-step="second">
    <div class="container">
      <a class="button-sm button-warning mb-3" href="?view=schedules"><i class="fas fa-arrow-left"></i> Cancel reservation</a>
      <div class="row">
        <div class="col-12 mb-5">
          <div class="section-heading">
            <h2>Confirm reservation</h2>
          </div>
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
          <div class="section-heading">
            <h2>Additional Information</h2>
          </div>
          <div class="card">
            <div class="card-body">
              <form class="px-3">
                <div class="form-group">
                  <label for="Purpose of Reservation">Purpose of Reservation</label>
                  <input class="form-control" type="text" placeholder="Type your purpose of reservation...">
                </div>
                <div class="form-group">
                  <label for="Number Guests">No. of guests</label>
                  <input class="form-control" type="number" placeholder="No. of guests...">
                </div>
                <div class="form-group">
                  <label for="Activity Description">Activity Description (Optional)</label>
                  <textarea class="form-control" placeholder="Type activity description..." style="height: 100px;"></textarea>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox"><label class="form-check-label" for="Accept Rules and Regulations">Accept Rules & Regulations</label>
                </div>
                <button class="button button-warning border-0 float-lg-right float-md-none">Confirm reservation</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <br><br><br>
  </section>
</main>
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
          console.log(response['available']);
          let data = response['available'];
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
    if(target.dataset.submit == "schedule") {
      // let firstForm = document.querySelector('[data-step="first"]');
      // let secondForm = document.querySelector('[data-step="second"]');
      
      var formData = new FormData();
      formData.append('start_time', target.dataset.start);
      formData.append('end_time', target.dataset.end);
      formData.append('duration', target.dataset.duration);
      $.ajax({
          type: "POST",
          url: "{{ route('schedules.store') }}",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            // if(!JSON.parse(response).auth) {
            //   Swal.fire({
            //     title: 'Authentication needed',
            //     text: "You must sign in first before reserving a space",
            //     icon: 'info',
            //     confirmButtonColor: '#4285f4',
            //     confirmButtonText: 'Sign In with Google'
            //   }).then((result) => {
            //     if (result.isConfirmed) {
            //       window.location.href = JSON.parse(response).url;
            //     }
            //   })
            // } else {
              if(!firstForm.classList.contains("d-none")) {
                firstForm.classList.add("d-none");
              }
              if(secondForm.classList.contains("d-none")) {
                secondForm.classList.remove("d-none");
              }
              document.querySelector('[data-input="date"]').innerHTML = dateSelect.options[dateSelect.selectedIndex].text;
              document.querySelector('[data-input="duration"]').innerHTML = target.dataset.duration + " hour" + (target.dataset.duration > 1 ? "s" : "");
              document.querySelector('[data-input="schedule"]').innerHTML = target.dataset.start + " - " + target.dataset.end;
            //}
          }
      });
    }
  });
</script>
@endsection