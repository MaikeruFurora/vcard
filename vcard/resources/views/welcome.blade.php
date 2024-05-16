@extends('layout.app')
@section('link')
<link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatables/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="row mt-4">
  <div class="col-lg-3 col-sm-12">
     <div class="card m-1">
      <div class="card-body">
        @if (session()->has('msg'))
            <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
            </div>
        @endif
        <form method="POST" action="{{ route('authenticate.card.store') }}" autocomplete="off">@csrf
          <div class="form-group">
            <label for="">First name</label>
            <input type="text" class="form-control" name="fname">
            @error('fname')
                 <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
              <label for="">Middle name</label>
              <input type="text" class="form-control" name="mname">
              @error('mname')
                   <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Last name</label>
              <input type="text" class="form-control" name="lname">
              @error('lname')
                   <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group col-6">
                <label for="">Contact No</label>
                <input type="tel" class="form-control" name="contact" required>
              </div>
            </div>
            <div class="form-group">
              <label for="">Position</label>
              <input type="text" class="form-control" name="position" required>
            </div>
           <div class="form-row">
              <div class="form-group col-6">
                <label for="">Managing</label>
                <input type="text" class="form-control" name="managing">
              </div>
              <div class="form-group col-6">
                <label for="">Active</label>
                <select class="select form-control" name="is_active">
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                </select>
              </div>
           </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
     </div>
  </div>
  <div class="col-lg-9 col-sm-12">
      <div class="card m-1">
        <div class="card-body">
         <div class="table-responsive">
          <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cards as $card)
                    <tr>
                        <td>{{ $card->fullname }}</td>
                        <td>{{ $card->position }}</td>
                        <td>{{ $card->email }}</td>
                        <td>{{ $card->contact }}</td>
                        <td>{{ $card->is_active }}</td>
                        <td>
                            <a class="btn btn-primary" target="_blank" href="{{ route('authenticate.qrcode',  encrypt($card->id)) }}">Get QRCode</a>
                            <button class="btn btn-primary">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         </div>
        </div>
      </div>
  </div>
</div>

@endsection
@section('script')

<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script>
  $("#table").dataTable();
</script>
@endsection