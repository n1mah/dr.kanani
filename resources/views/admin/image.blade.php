
<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div class="container">
                <h2>Image Upload</h2>
                <form action="{{ url('/imagess/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                <hr>

                <h2>Uploaded Images</h2>
                <div class="row">
                    @foreach($images as $image)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="images/{{($image->image_path)}}" width="300px" alt="nit" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">xd</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
