<template>
    <div>
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="#" class="nav-item nav-link">About</a>
                        <a href="#" class="nav-item nav-link">Service</a>
                        <a href="#" class="nav-item nav-link">Menu</a>
                        <a href="#" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-cart-shopping"></i>Cart</a>
                        <a href="#" class="nav-item nav-link">Contact</a>
                        <a href="#" class="nav-item nav-link">Login</a>
                        <a href="#" class="nav-item nav-link">Register</a>
                    </div>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                            <a href="#" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A Table</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="/img/hero.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                <h2>Welcome to the homepage!</h2>
                <p>This is your content.</p>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: 'Home',
    setup() {
        return {}
    }
}
</script>

<style scoped>
/* Add any component-specific styles here */
</style>

