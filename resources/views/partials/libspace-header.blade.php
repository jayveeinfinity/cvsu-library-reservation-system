<div class="overlay fade-out"></div>
<!-- Header -->
<header class="header">
    <div class="container">
        <nav class="flex flex-jc-sb flex-ai-c">
        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('landing') }}" class="ils-webname text-warning">
            <!-- <img src="https://raw.githubusercontent.com/MohamedAridah/frontendmentor_easybank-landing-page/main/images/logo-dark.svg" alt="EasyBank" /> -->
                Reservation System
            </a>
        </div>
        <!-- Links -->
        <div class="main-navgation hide-for-mobile">
            <a href="{{ route('landing') }}">Home</a><a href="{{ route('schedules.index') }}">Schedules</a><a href="{{ route('landing.facilities') }}">Learning Spaces</a><a href="{{ route('landing.rules') }}">Rules & Regulations</a>
            <!-- <a href="#">Help Center</a> -->
        </div>
        <!-- CTA Button -->
        <a href="{{ route('schedules.index') }}" class="button button-warning hide-for-mobile">Reserve a space</a>
        <!-- Hamburger Menu -->
        <div class="menu hide-for-desktop">
            <span></span>
            <span></span>
            <span></span>
        </div>
        </nav>
    </div>
</header>
<script>
	let menu = document.querySelector(".header .menu");
	let navgation = document.querySelector(".header .main-navgation");
	let links = document.querySelectorAll(".header .main-navgation a");
	let overlay = document.querySelector(".overlay");

	// Open Navgation Links For Tablets And Mobile.
	function openMobileNavgation() {
		menu.classList.add("open"); // Open Menu
		navgation.classList.add("fade-in"); // Open Mobile Navgation
		controlOverlay("open"); // Open Overlay
	}

	// Close Navgation Links For Tablets And Mobile.
	function closeMobileNavgation() {
		menu.classList.remove("open"); // Close Menu
		navgation.classList.remove("fade-in"); // Close Mobile Navgation
		controlOverlay("!open"); // Close Overlay
	}

	menu.addEventListener("click", () => {
		if (menu.classList.contains("open")) {
			closeMobileNavgation();
		} else {
			openMobileNavgation();
		}
	});

	links.forEach((link) => {
		link.addEventListener("click", () => {
			closeMobileNavgation();
		});
	});

	// Reset To Bars Icon Shape IF Width >= 1024px
	window.addEventListener("resize", () => {
		if (window.innerWidth >= 1024 && menu.classList.contains("open")) {
			// Close Menu & Mobile Navgation & Overlay
			closeMobileNavgation();
		}
	});

	// Control [ Open || Close ] Overlay Function.
	function controlOverlay(status) {
		/// status:
		/// open => Open Overlay
		/// anything else open => close Overlay
		if (status == "open") {
			overlay.classList.add("fade-in");
			overlay.classList.remove("fade-out");
		} else {
			overlay.classList.add("fade-out");
			overlay.classList.remove("fade-in");
		}
	}

</script>