<x-layout>

<div class="container mt-5" style="max-width: 600px;">

  <h3 class="mb-4 text-center fw-bold">Edit Slide</h3>

  <div class="card shadow-sm p-4">

    <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ $carousel->title }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" name="description" value="{{ $carousel->description }}" class="form-control">
      </div>

      <!-- Current Image -->
      <div class="mb-3 text-center">
        <img src="/assets/images/{{$carousel->pic}}" 
             class="img-fluid rounded"
             style="max-height:150px;">
      </div>

      <div class="mb-3">
        <label class="form-label">Change Image</label>
        <input type="file" name="pic" class="form-control">
      </div>

      <button class="btn btn-primary w-100">
        Update Slide
      </button>

    </form>

  </div>

</div>

</x-layout>