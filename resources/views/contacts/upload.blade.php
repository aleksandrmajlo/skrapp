<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card" style="width: 18rem;">
            <div class="card-header">ЗАГРУЗИТЬ (загрузка EXCEL)</div>
            <div class="card-body">

                <form method="post" action="{{ route('file.upload.excel') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Файл</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn-primary btn">Сохранить</button>
                </form>

            </div>
        </div>
    </div>
</div>
