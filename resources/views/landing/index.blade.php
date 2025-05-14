<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>PetHub</title>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
        <script data-search-pseudo-elements="" defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
        <!-- @vite('resources/js/app.js') -->
    </head>
    <body class="bg-white">
    <nav class="navbar navbar-expand-lg border-bottom bg-body-tertiary bg-white shadow-none position-fixed w-100 top-0">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="#"><img src="{{asset('assets/img/favicon.png')}}" alt="" style=" width: 40px; height: auto; margin-right: 8px;"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="shadow-0">
        <div class="container hero mt-5 rounded-4 bg-white py-10 px-5 mx-auto" id="home">
            <div class="row">
                <div class="col-md-6 my-auto">
                    <h1 class="display-3 lh-1 fw-700"><span class="text-primary">We care</span> for your Pets!</h1>
                    <p class="text-body text-lg">
                        Providing quality veterinary care with compassion and dedication—because your furry friends deserve the best.
                        At <strong>Pruderich Veterinary Clinic</strong>, your pet’s health and happiness are our top priority.
                    </p>
                    <button class="btn btn-primary"><i class="fa-solid fa-paw me-2"></i>Pet Portal</button>
                </div>
                <div class="col-md-6 justify-content-center d-flex align-items-center">
                    <img src="{{ asset('assets/img/landing/hero.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white mt-15">
        <div class="container px-5" id="services">
            <div class="row gy-5 rounded-5">
                <div class="col-md-12 my-auto">
                    <h1 class="fw-700 text-xl mb-0">Services</h1>
                    <p class="text-body">We offer the following services to keep your pets healthy and happy.</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/img/landing/appointments.png')}}" alt="" style="height: 64px;" class="p-2 mb-3 rounded border mb-2"/>
                    <h1 class="fw-600">Appointments</h1>
                    <p>Schedule an appointment with our veterinary team for personalized pet care at your convenience.</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/img/landing/medical.png')}}" alt="" style="height: 64px;" class="p-2 mb-3 rounded border mb-2"/>
                    <h1 class="fw-600">Health Checkups</h1>
                    <p>Comprehensive health evaluations to ensure your pet stays happy, healthy, and active.</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/img/landing/vaccination.png')}}" alt="" style="height: 64px;" class="p-2 mb-3 rounded border mb-2"/>
                    <h1 class="fw-600">Vaccinations</h1>
                    <p>Protect your pets from common diseases with our complete and up-to-date vaccination services.</p>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('assets/img/landing/treatment.png')}}" alt="" style="height: 64px;" class="p-2 mb-3 rounded border mb-2"/>
                    <h1 class="fw-600">Pet Treatment</h1>
                    <p>From minor ailments to ongoing conditions, we provide effective treatments tailored to your pet’s needs.</p>
                </div>
            </div>
        </div>
    </div>
        <div class="mt-15">
            <div class="container" id="about">
                <div class="row gy-5 px-5 rounded-5 py-5 bg-primary" style="background-image: url({{asset('assets/img/backgrounds/bg-pattern-shapes.png')}});">
                    <div class="col-md-6 my-auto">
                        <div class="mb-3">
                            <h1 class="fw-700 text-white text-xl">About Us</h1>
                        </div>
                        <p class=" text-white">Pruderich Veterinary Clinic is your trusted animal care provider in Maramag, Bukidnon, Philippines. We offer a wide range of veterinary services including vaccinations, checkups, deworming, consultations, and grooming. We also provide specialized care such as complete blood count (CBC) testing, pregnancy diagnosis, and surgical procedures.</p>
                    </div>
                    <div class="col-md-6 justify-content-center d-flex my-auto">
                        <img src="{{ asset('assets/img/landing/about.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    <div class="mt-15">
        <div class="container" id="contact">
            <div class="row gy-5 px-5 py-5">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h1 class="fw-700 text-xl">Contact Us</h1>
                    </div>
                    <p class="text-body">
                        Get in touch for appointments, inquiries, or pet care assistance.
                    </p>
                    <div class="mt-4">
                        <p class="mb-1"><strong>Email:</strong> pruderichvetclinic@example.com</p>
                        <p class="mb-1"><strong>Phone:</strong> +63 912 345 6789</p>
                        <p class="mb-1"><strong>Address:</strong> Purok 6, South Poblacion, Maramag, Bukidnon, Philippines</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.5325457758454!2d125.0429678!3d7.8391947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ff23b824baa31b%3A0x50999dbf4cfa0aea!2sPruderich%20Veterinary%20Clinic%20And%20Supply!5e0!3m2!1sen!2sph!4v1746305828568!5m2!1sen!2sph"
                        width="100%"
                        height="350"
                        style="border:0; border-radius: 1.5rem;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-img-repeat py-10 text-center mt-10 container rounded-5 mb-5 bg-primary" style="background-image: url({{asset('assets/img/backgrounds/bg-pattern-shapes.png')}});">
        <h1 class="display-6 text-white fw-700 text-center">Ready to Give Your Pet the Best Care?</h1>
        <p class="text-white text-center mb-5">Book an appointment today and let Pruderich Veterinary Clinic take care of your furry friend.
        </p>
        <a class="btn btn-outline-white">Book Now</a>
    </div>
    <footer class="bg-white border-top py-4">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-6 mb-3 mb-md-0">
                    <a class="navbar-brand logo" href="#"><img src="{{asset('assets/img/favicon.png')}}" alt="" style=" width: 40px; height: auto; margin-right: 8px;"/></a>
                </div>
                <!-- Navigation Links -->
                <div class="col-md-6 text-md-end">
                    <a href="#home" class="text-decoration-none text-dark me-3">Home</a>
                    <a href="#services" class="text-decoration-none text-dark me-3">Services</a>
                    <a href="#about" class="text-decoration-none text-dark me-3">About</a>
                    <a href="#contact" class="text-decoration-none text-dark">Contact</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-start">
                    <small class="text-muted">&copy; 2025 Pruderich Veterinary Clinic. All rights reserved.</small>
                </div>
            </div>
        </div>
    </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    const offset = 150; // adjust this based on your navbar height
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = target.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                });
            });
        </script>

</html>
