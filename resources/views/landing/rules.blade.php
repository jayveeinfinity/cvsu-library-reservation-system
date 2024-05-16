@extends('layouts.landing')

@section('title')
    Rules and Regulations &sdot; 
@endsection

@section('content')
<main class="main">
  <!-- Rules and Regulations -->
  <section class="articles py-5">
    <div class="container">
      <div class="section-heading">
        <h2>Rules and Regulations</h2>
      </div>
      <div class="section-content">
        <ol class="px-3" style="line-height: 4rem;">
          <li>You must have a <b>CvSU email address (email@cvsu.edu.ph)</b> to reserve a room and can only make a maximum of one reservation per day.</li>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Users</th>
                  <th scope="col">Maximum hours usage per transaction</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Student</td>
                  <td>3 hours</td>
                </tr>
                <tr>
                  <td>Faculty/Staff</td>
                  <td>1 day</td>
                </tr>
              </tbody>

            </table>
          <li>Reservations can be made up to 1 week in advance or must be made at least 3 days ahead of the requested date. These rooms are reserved on a <b>first come first serve</b> basis.</li>
          <li>Collaboration Area and Learning Commons are for <b>academic use only</b>.</li>
          <li>You must show up for your reservation on time. If you are not present within 15 minutes of the start time of your reservation, other groups will be allowed to use the library space.</li>
          <li>Foods and drinks are not allowed inside the learning spaces except for the Collaboration Area.</li>
          <li>A <b>confirmation email</b> will be sent once the reservation request is already approved.</li>
          <li>Patrons are required to return the room in the condition it was received. Practice <b>CLAYGo (CLean As You Go)/</b>. All waste should be properly disposed of in appropriate trash bins at the end of the reservation period. </li>
          <li>The patron/student/staff who made the reservation is considered as the  focal person and must accept full responsibility for any damage incurred while the room is in use.</li>
          <li>Groups using the learning spaces must agree to the Library policies. The Library reserves the right to ask users to discontinue any activities that disrupt the normal operations of the Library.</li>
          <li>LibSpace usage is <b>FREE of CHARGE</b>.</li>
        </ol>
      </div>
    </div>
  </section>
</main>
@endsection