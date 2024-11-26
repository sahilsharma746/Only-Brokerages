@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
    <div class="container admin-settings-container">
        <div class="section-title">Add Education Topics</div>
        <section class="admin-settings-section">
            <div class="card common-card seo-card">

                <form method="POST" class="add_education_topic_form" action="{{ route('admin.education.save.topic') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="input-group">
                            <label class="form-label">Title</label>
                            <input class="form-control" name="education_title" type="text" placeholder="Enter Title"
                                required>
                            @error('education_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control" name="education_short_description"  placeholder="Enter Short Description" required></textarea>
                            @error('education_short_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="form-label">Description</label>
                            <textarea id="editor" name="education_description" class="form-control"
                                rows="10"></textarea>
                                @error('education_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="form-label">Market</label>
                            <select class="form-control" name="education_type" id="user-market-selector"
                                searchable="false" required>
                                @foreach($education_types as $education_type)
                                <option value="{{ $education_type->id }}">{{ ucfirst($education_type->name) }}
                                </option>
                                @endforeach
                            </select>
                            @error('education_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" name="education_image" required>
                            @error('education_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <br>
                        <button type="submit" class="btn btn-update-settings add_education_topic">Save
                            Topic</button>
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