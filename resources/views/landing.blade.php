<x-layout>

  <section class="landing-hero-section">

    <div class="container">

        <div class="landing-hero-card">

            <img src="{{ asset('assets/images/hero.jpg') }}"
                 class="w-100 landing-hero-image"
                 alt="Hero">

            <div class="landing-hero-overlay">

                <div class="landing-hero-content">

                    <div class="landing-hero-badge">
                        Welcome to JShop
                    </div>

                    <h1 class="landing-hero-title">
                        Electronics that <br>
                        move with you.
                    </h1>

                    <p class="landing-hero-text">
                        From featherlight laptops to flagship phones —
                        explore the latest gear with curated deals
                        and lightning-fast delivery.
                    </p>

                </div>

            </div>

        </div>

        <div class="text-center mt-5">

            <a href="{{ route('home') }}"
               class="landing-discover-btn text-decoration-none">

                Discover more →

            </a>

        </div>

    </div>

</section>

</x-layout>
