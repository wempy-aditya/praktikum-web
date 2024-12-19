<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark shadow-sm">
      <div class="container">
        <!-- Brand -->
        <router-link :to="{ name: 'home' }" class="navbar-brand fw-bold d-flex align-items-center">
          <svg id="logo-35" width="50" height="39" viewBox="0 0 50 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.4992 2H37.5808L22.0816 24.9729H1L16.4992 2Z" class="ccompli1" fill="#007AFF"></path>
            <path d="M17.4224 27.102L11.4192 36H33.5008L49 13.0271H32.7024L23.2064 27.102H17.4224Z" class="ccustom" fill="#312ECB"></path>
          </svg>
          <span class="ms-2">MyBlog</span>
        </router-link>

        <!-- Toggler -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link :to="{ name: 'home' }" class="nav-link">
                <!-- <i class="bi bi-house-door me-1"></i>--> Home 
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'posts.index' }" class="nav-link">
                <!-- <i class="bi bi-file-text me-1"></i> --> Posts
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'categories.index' }" class="nav-link">
                <!-- <i class="bi bi-tag me-1"></i> --> Categories
              </router-link>
            </li>
          </ul>

          <!-- Right Buttons -->
          <div class="d-flex">
            <a href="#" class="btn btn-outline-primary btn-sm me-2 rounded-pill px-3">Login</a>
            <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3">Sign Up</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <router-view></router-view>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-4">
      <div class="container text-center">
        <div class="row">
          <!-- About -->
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">About Us</h5>
            <p class="small fw-light">
              MyBlog is your go-to platform for the latest and greatest in tech, lifestyle, and more.
            </p>
          </div>

          <!-- Quick Links -->
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Quick Links</h5>
            <ul class="list-unstyled small">
              <li>
                <router-link :to="{ name: 'home' }" class="text-light text-decoration-none">
                  <i class="bi bi-chevron-right"></i> Home
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'posts.index' }" class="text-light text-decoration-none">
                  <i class="bi bi-chevron-right"></i> Posts
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'categories.index' }" class="text-light text-decoration-none">
                  <i class="bi bi-chevron-right"></i> Categories
                </router-link>
              </li>
            </ul>
          </div>

          <!-- Social Media -->
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Follow Us</h5>
            <a href="#" class="text-light me-3 fs-5">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="text-light me-3 fs-5">
              <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="text-light fs-5">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </div>

        <!-- Copyright -->
        <hr class="border-light mb-3" />
        <p class="small mb-0">© 2024 MyBlog. All Rights Reserved.</p>
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* Navbar Styling */
.navbar-nav .nav-link {
  transition: color 0.3s ease;
}
.navbar-nav .nav-link:hover {
  color: #00d9ff !important;
}

/* Footer Social Icons Hover */
footer a i {
  transition: transform 0.3s ease, color 0.3s ease;
}
footer a i:hover {
  color: #00d9ff;
  transform: scale(1.2);
}

/* Footer Links */
footer ul li a {
  transition: color 0.3s ease;
}
footer ul li a:hover {
  color: #00d9ff !important;
}

/* Buttons */
.btn {
  font-size: 0.9rem;
  transition: all 0.3s ease;
}
.btn:hover {
  transform: translateY(-2px);
}
</style>
