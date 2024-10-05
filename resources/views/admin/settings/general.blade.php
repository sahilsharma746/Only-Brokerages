@extends('admin.layouts.app_admin')
@section('content')
<main class="main-area">
        <div class="container admin-settings-container">
            <section class="user-filter-section">
                <ul class="list-style-none">
                <li><a href="{{ route('admin.general.settings') }}" class="btn">General Settings</a></li>
                    <li><a href="{{ route('admin.system.settings') }}" class="btn active">System Settings</a></li>
                </ul>
            </section>

            <div class="section-title">General Settings</div>
            <section class="admin-settings-section">
                <div class="card common-card site-settings-card">
                    <div class="card-body">
                        <div class="input-group">
                            <label class="form-label">Site Title</label>
                            <input class="form-control" type="text" placeholder="Enter Site Title">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Timezone</label>
                            <select class="form-control" id="siteSettingsTimezone" searchable="false">
                                <option value="-12">(UTC-12:00)</option>
                                <option value="-11">(UTC-11:00)</option>
                                <option value="-10">(UTC-10:00)</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Language</label>
                            <select class="form-control" id="siteSettingsLanguage" searchable="false">
                                <option value="1">
                                    <div>
                                        <img src="../assets/img/flag-eur.png">
                                        <span>English</span>
                                    </div>
                                </option>
                                <option value="2">Bangla</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Records To display Per Page</label>
                            <input class="form-control" type="number" min="0"
                                placeholder="Enter Records To display Per Page">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Decimal After Number</label>
                            <input class="form-control" type="number" min="0" placeholder="Enter Decimal After Number">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Currency</label>
                            <select class="form-control" id="siteSettingsCurrency" searchable="false">
                                <option value="1">
                                    <div>
                                        <img src="../assets/img/flag-eur.png">
                                        <span>USD</span>
                                    </div>
                                </option>
                                <option value="2">BDT</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <br>
                        <a class="btn">Save changes</a>
                    </div>
                </div>
            </section>

            <div class="section-title">SEO Settings</div>
            <section class="admin-settings-section">
                <div class="card common-card seo-card">
                    <div class="card-body">
                        <div class="upload-files-container w-100 overflowY-hidden">
                            <div class="drag-file-area align-content-center">
                                <img id="user-image" class="user-image d-none"
                                    src="https://picsum.photos/300/200?grayscale" alt="">
                                <label for="upload-dp-input"
                                    class="upload-icon attach-icon mx-auto d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-link"></i>
                                    <!-- <img src="./assets/img/Icon-attach.png"> -->
                                </label>
                                <p class="attach-note dynamic-message">
                                    Supported Files: .png, .jpg, .jpeg.
                                    <br> Image will be resized into 400x400px
                                </p>
                                <label class="label d-none">
                                    <span class="browse-files">
                                        <input id="upload-dp-input" type="file" accept="image/*"
                                            class="default-file-input" />
                                    </span>
                                </label>
                            </div>
                            <p class="cannot-upload-message">
                                <strong>Error : </strong> <span> Please select a file
                                    first</span>
                                <span class="cancel-alert-button btn-close">❌</span>
                            </p>

                            <div class="file-block">
                                <div class="file-info">
                                    <span class="file-name"
                                        style="max-width: 230px; padding-right: 5px; overflow: hidden;"> </span>
                                    | <span class="file-size"> </span>
                                </div>
                                <span class="material-icons remove-file-icon">
                                    <i class="fa-regular fa-trash-can"></i>
                                </span>
                                <div class="progress-bar"> </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Meta Keywords Separate multiple keywords by,(comma) or enter
                                key</label>
                            <input class="form-control" id="metaKeyWord" type="text" placeholder="Enter Meta Key words">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" type="text" placeholder="Enter Meta Description"></textarea>
                        </div>
                        <div class="input-group">
                            <label class="form-label">Social Title</label>
                            <input class="form-control" type="text" placeholder="Enter Social Title">
                        </div>
                        <div class="input-group">
                            <label class="form-label">Social Description</label>
                            <textarea class="form-control" type="text"
                                placeholder="Enter Social Description"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <br>
                        <a id="btn-update-settings" class="btn btn-update-settings">Update Settings</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection