<div class="navbar-header shadow-1">
  <div class="row align-items-center justify-content-between">
    <div class="col-auto">
      <div class="d-flex flex-wrap align-items-center gap-4">
        <button type="button" class="sidebar-mobile-toggle" aria-label="Sidebar Mobile Toggler Button">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
        </button>
        <form class="navbar-search">
          <input type="text" class="bg-transparent" name="search" placeholder="Search">
          <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
        </form>
      </div>
    </div>
    <div class="col-auto">
      <div class="d-flex flex-wrap align-items-center gap-3">
        <button type="button" data-theme-toggle
          class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" aria-label="Dark & Light Mode Button"></button>
        <div class="dropdown d-inline-block">
          <button
            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
            type="button" data-bs-toggle="dropdown" aria-label="Language Change Button">
            <img src="{{ asset('assets/images/flags/flag1.png') }}" alt="image" class="w-24 h-24 object-fit-cover rounded-circle">
          </button>
          <div class="dropdown-menu to-top dropdown-menu-sm">
            <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
              <div>
                <h6 class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</h6>
              </div>
            </div>
            <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="english">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag1.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">English</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="english">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="japan">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag2.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">Japan</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="japan">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="france">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag3.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">France</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="france">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="germany">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag4.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">Germany</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="germany">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="korea">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag5.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">South Korea</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="korea">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="bangladesh">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag6.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">Bangladesh</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="bangladesh">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="india">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag7.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">India</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="india">
              </div>
              <div class="form-check style-check d-flex align-items-center justify-content-between">
                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="canada">
                  <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/flags/flag8.png') }}" alt="Image"
                      class="w-36-px h-36-px bg-success-subtle text-success-main rounded-circle flex-shrink-0">
                    <span class="text-md fw-semibold mb-0">Canada</span>
                  </span>
                </label>
                <input class="form-check-input" type="radio" name="crypto" id="canada">
              </div>
            </div>
          </div>
        </div><!-- Language dropdown end -->

        <div class="dropdown">
          <button
            class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center position-relative"
            type="button" data-bs-toggle="dropdown" aria-label="Notification Button">
            <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
            <span class="w-8-px h-8-px bg-danger-600 position-absolute end-0 top-0 rounded-circle mt-2 me-2"></span>
          </button>
          <div class="dropdown-menu to-top dropdown-menu-lg p-0">
            <div
              class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
              <div>
                <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
              </div>
              <span
                class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
            </div>
            <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
              <a href="javascript:void(0)"
                class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                  <span
                    class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                  </span>
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Congratulations</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Your profile has been Verified. Your
                      profile has been Verified</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              <a href="javascript:void(0)"
                class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                  <span
                    class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <img src="{{ asset('assets/images/notification/profile-1.png') }}" alt="Image">
                  </span>
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Ronald Richards</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">You can stitch between artboards</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              <a href="javascript:void(0)"
                class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                  <span
                    class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    AM
                  </span>
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Arlene McCoy</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              <a href="javascript:void(0)"
                class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between bg-neutral-50">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                  <span
                    class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    <img src="{{ asset('assets/images/notification/profile-2.png') }}" alt="Image">
                  </span>
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Robiul Hasan</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
              <a href="javascript:void(0)"
                class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                  <span
                    class="w-44-px h-44-px bg-info-subtle text-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                    DR
                  </span>
                  <div>
                    <h6 class="text-md fw-semibold mb-4">Darlene Robertson</h6>
                    <p class="mb-0 text-sm text-secondary-light text-w-200-px">Invite you to prototyping</p>
                  </div>
                </div>
                <span class="text-sm text-secondary-light flex-shrink-0">23 Mins ago</span>
              </a>
            </div>
            <div class="text-center py-12 px-16">
              <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md hover-underline">See All Notification</a>
            </div>
          </div>
        </div><!-- Notification dropdown end -->

        <!-- User Profile Dropdown -->
        <div class="dropdown">
          <button class="d-flex justify-content-center align-items-center rounded-circle cursor-pointer" type="button" data-bs-toggle="dropdown"
            style="width:40px;height:40px;background:#e0e3e7;">
            <img src="{{ asset('assets/images/mbc-logo.png') }}" alt="User"
              class="w-40-px h-40-px object-fit-cover rounded-circle" onerror="this.style.display='none'">
          </button>
          <div class="dropdown-menu to-top dropdown-menu-sm">
            <div class="py-12 px-16 radius-8 bg-primary-50 mb-16">
              @auth
              <h6 class="text-lg text-primary-light fw-semibold mb-0">{{ Auth::user()->name }}</h6>
              <span class="text-secondary-light fw-normal text-xs">{{ Auth::user()->role ? Auth::user()->role->display_name : 'User' }}</span>
              @endauth
            </div>
            <ul class="to-top-list">
              <li>
                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                  href="javascript:void(0)">
                  <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                  href="{{ url('/settings/general') }}">
                  <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon> Settings
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                  @csrf
                  <button type="submit"
                    class="dropdown-item text-danger px-0 py-8 hover-bg-transparent hover-text-danger-600 d-flex align-items-center gap-3 border-0 bg-transparent w-100 text-start">
                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Logout
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div><!-- User Profile dropdown end -->

      </div>
    </div>
  </div>
</div>
