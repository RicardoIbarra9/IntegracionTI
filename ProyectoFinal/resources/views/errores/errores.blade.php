<div class="row">
    <div class="col-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Verifica los datos<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible text-dark fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible text-dark fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible text-dark fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
</div>
