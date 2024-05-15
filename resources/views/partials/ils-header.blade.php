<div class="container-fluid p-0">
	<div class="row no-gutters">
		<div class="col-md-12 ils-bg-green">
			<div class="ils-header-sm">
				<a href="http://library.cvsu.edu.ph/landing" style="text-decoration: none !important;">
					<!-- <i class="fas fa-long-arrow-alt-left text-white"></i> -->
					<img class="ils-header-logo" src="images/CvSU-logo-64x64.webp">
					<div class="ils-website text-white">
						Cavite State University <span class="ils-website-sub text-white">Integrated Library System</span>
					</div>
				</a>
				<div class="ils-mobile">
					@guest
					<a href="{{ route('google.auth') }}">
						<div class="cvsu-btn-sm d-inline-block">
							<div class="cvsu-icon-wrapper">
								<img class="cvsu-icon" src="images/CvSU-logo-16x16.webp"/>
							</div>
							<p class="btn-text"><b>Sign in with CvSU Email</b></p>
						</div>
					</a>
					@endguest
					@auth
						<div class="d-flex align-items-center justify-content-center">
							<div class="nav-item dropdown">
								<a class="nav-link p-0 dropdown-toggle text-white" href="javascript:void(0)" id="dropdown08" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="rounded-circle" src="{{ $googleUserInfo->picture }}" height="24px"> Hi! {{ $googleUserInfo->name }}</a>
								<div class="dropdown-menu" aria-labelledby="dropdown08">
									<a class="dropdown-item" href="{{ route('profile') }}">Account Settings</a>
									<a class="dropdown-item" href="{{ route('google.logout') }}">Signout</a>
								</div>
							</div>
						</div>
					@endauth
				</div>
			</div>
		</div>
	</div>
</div>