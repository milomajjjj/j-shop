<x-layout>

<div class="container mt-5" style="max-width: 600px;">

  <!-- Title -->
  <h2 class="mb-4 text-center fw-bold">Manage Carousel</h2>

  <!-- Success Message -->
  @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

  <!-- Error Messages -->
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Form -->
  <div class="card shadow-sm p-4">
    <form action="{{ route('admin.carouselUpload') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Title -->
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter title" required>
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" name="description" class="form-control" placeholder="Enter description" required>
      </div>

      <!-- Image -->
      <div class="mb-3">
        <label class="form-label">Upload Image</label>
        <input type="file" name="pic" class="form-control" required>
      </div>

      <!-- Button -->
      <button type="submit" class="btn btn-primary w-100">
        Upload Slide
      </button>

    </form>
    <hr class="my-5">

<h5 class="mb-3 fw-bold">All Slides</h5>

<div class="row g-4">

@forelse($carousels as $slide)
<div class="col-md-4">

  <div class="card shadow-sm">

    <img src="/assets/images/{{$slide->pic}}" 
         style="height: 150px; object-fit: cover;"
         class="card-img-top">

    <div class="card-body">

      <h6 class="fw-bold">{{$slide->title}}</h6>
      <p class="small text-muted">{{$slide->description}}</p>

      <!-- Actions -->
      <div class="d-flex justify-content-between">

        <!-- Edit -->
        <a href="{{ route('admin.carousel.edit', $slide->id) }}" 
           class="btn btn-sm btn-primary">
          Edit
        </a>

        <!-- Delete -->
        <form action="{{ route('admin.carousel.delete', $slide->id) }}" method="POST"
              onsubmit="return confirm('Delete this slide?');">
          @csrf
          <button class="btn btn-sm btn-danger">
            Delete
          </button>
        </form>

      </div>

    </div>

  </div>

</div>
@empty
<p class="text-muted">No slides yet.</p>
@endforelse

</div>
  </div>

</div>

</x-layout>