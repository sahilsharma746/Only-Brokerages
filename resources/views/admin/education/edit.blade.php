@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container admin-settings-container">
            <div class="section-title">Edit Education Topics</div>
            <section class="admin-settings-section">
                <div class="card common-card seo-card">
                    <form method="POST" class="add_education_topic_form" action="{{ route('admin.education.update', $educationPosts->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="input-group">
                                <label class="form-label">Title</label>
                                <input class="form-control" name="education_title" value="{{ $educationPosts->title }}" type="text" placeholder="Enter Title" required>
                                @error('education_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control" name="education_short_description"  placeholder="Enter Short Description" required>{{ $educationPosts->short_description }}</textarea>
                                @error('education_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Description</label>
                                <textarea id="editor" name="education_description" class="form-control"
                                rows="10">{{ $educationPosts->description }}</textarea>
                                @error('education_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label class="form-label">Market</label>
                                <select class="form-control" name="education_type" value="{{ $educationPosts->type }}" id="user-market-selector" searchable="false" required>
                                    @foreach($education_types as $education_type)
                                        <option value="{{ $education_type->id }}" {{ $educationPosts->type == $education_type->id ? 'selected' : '' }} >{{ ucfirst($education_type->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                    <img src="{{ asset('uploads/education_images/' . $educationPosts->image) }}" alt="Image" width="200" height="100"><br>
                                    <input class="form-control" type="file" name="education_image" required>
                                    @error('education_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <br>
                            <button type="submit" class="btn btn-update-settings add_education_topic">Update Topic</button>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </main>

    <!-- Include CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <!-- Initialize CKEditor -->
    <script>
    CKEDITOR.replace('editor');
    </script>

    <style>
        .cke_notifications_area { display: none !important; }
    </style>
@endsection
