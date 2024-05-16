@extends('layout.app')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card">
        <div class="card-header text-center">
            {{ $cardDetails->fullname }}
        </div>
        <div class="card-body" id="imagesave">
           {!! $qrcode !!}
        </div>
        <div class="card-footer  p-1">
            <button id="save-image" class="btn btn-block btn-info text-light" onclick="downloadPNG()">Download SVG</button>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script>
    $( "#save-image" ).on( "click", function() {
        html2canvas(document.querySelector("#imagesave")).then(canvas => {
          canvas.toBlob(function(blob) {
            window.saveAs(blob, '{{ str_replace(" ", "_", strtolower($cardDetails->fullname)); }}.jpg');
          });
        });
       setTimeout(() => {
        window.close();
       }, 3000);
    });
</script>
@endsection
