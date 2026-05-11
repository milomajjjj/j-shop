<x-layout>

<section class="container py-5" style="max-width: 1200px;">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="section-title">
            Manage Carousel
        </h1>

        <p class="section-subtitle">
            Upload and manage homepage slides
        </p>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

<div class="container mt-4">

    <div class="premium-alert-success">

        <span class="premium-alert-icon">
            ✓
        </span>

        <span>
            {{ session('success') }}
        </span>

    </div>

</div>

@endif

    <!-- ERRORS -->
    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row g-5">

        <!-- UPLOAD FORM -->
        <div class="col-lg-4">

            <div class="carousel-admin-card">

                <h3 class="carousel-admin-title">
                    Upload Slide
                </h3>

                <form action="{{ route('admin.carouselUpload') }}"
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
                            class="form-control premium-input"
                            placeholder="Enter title"
                            required
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
                            class="form-control premium-input"
                            placeholder="Enter description"
                            required
                        >

                    </div>

                    <!-- IMAGE -->
                    <div class="mb-4">

                        <label class="form-label premium-label">
                            Upload Image
                        </label>

                        <input
                            type="file"
                            name="pic"
                            class="form-control premium-input"
                            required
                        >

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="gradient-btn w-100">

                        Upload Slide

                    </button>

                </form>

            </div>

        </div>

        <!-- SLIDES -->
        <div class="col-lg-8">

            <div class="carousel-admin-card">

                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

                    <div>

                        <h3 class="carousel-admin-title mb-1">
                            All Slides
                        </h3>

                        <p class="section-subtitle mb-0">
                            Existing homepage carousel images
                        </p>

                    </div>

                </div>

                <div class="row g-4">

                    @forelse($carousels as $slide)

                    <div class="col-md-6">

                        <div class="carousel-slide-card h-100">

                            <!-- IMAGE -->
                            <div class="carousel-slide-image-wrapper">

                                <img
                                    src="/assets/images/{{$slide->pic}}"
                                    class="carousel-slide-image"
                                >

                            </div>

                            <!-- CONTENT -->
                            <div class="carousel-slide-content">

                                <h5 class="carousel-slide-title">
                                    {{$slide->title}}
                                </h5>

                                <p class="carousel-slide-description">
                                    {{$slide->description}}
                                </p>

                                <!-- ACTIONS -->
                                <div class="d-flex gap-3 mt-4">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.carousel.edit', $slide->id) }}"
                                       class="carousel-edit-btn w-100 text-center">

                                        Edit

                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.carousel.delete', $slide->id) }}"
                                          method="POST"
                                          class="w-100"
                                          onsubmit="return confirm('Delete this slide?');">

                                        @csrf

                                        <button class="carousel-delete-btn w-100">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="col-12">

                        <div class="empty-products">

                            <h3>No Slides Yet</h3>

                            <p>
                                Upload your first carousel slide.
                            </p>

                        </div>

                    </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</section>

</x-layout>