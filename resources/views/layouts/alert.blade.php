@if ($message = Session::get('success'))
    <div class="row">
        <div class="col-6 col-md-6 col-lg-6">
        </div>
        <div class="col-6 col-md-6 col-lg-6">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>x</span>
                    </button>
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
