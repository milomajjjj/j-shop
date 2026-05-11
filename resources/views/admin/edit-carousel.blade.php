<x-layout>

<section class="container py-5" style="max-width: 700px;">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="section-title">
            Edit Slide
        </h1>

        <p class="section-subtitle">
            Update carousel content and image
        </p>

    </div>

    <!-- CARD -->
    <div class="carousel-admin-card">

        <form action="{{ route('admin.carousel.update', $carousel->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- TITLE -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ $carousel->title }}"
                    class="form-control premium-input"
                >

            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Description
                </label>

                <input
                    type="text"
                    name="description"
                    value="{{ $carousel->description }}"
                    class="form-control premium-input"
                >

            </div>

            <!-- CURRENT IMAGE -->
            <div class="mb-4 text-center">

                <p class="premium-label mb-3">
                    Current Image
                </p>

                <div class="edit-carousel-image-wrapper">

                    <img
                        src="/assets/images/{{$carousel->pic}}"
                        class="edit-carousel-image"
                    >

                </div>

            </div>

            <!-- CHANGE IMAGE -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Change Image
                </label>

                <input
                    type="file"
                    name="pic"
                    class="form-control premium-input"
                >

            </div>

            <!-- BUTTON -->
            <button class="gradient-btn w-100">

                Update Slide

            </button>

        </form>

    </div>

</section>

</x-layout>