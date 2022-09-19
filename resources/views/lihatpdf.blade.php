@extends('layout.app')
@section('title')
    <title>COA</title>
@endsection

@section('content')
    <main>
        {{-- <iframe src="{{ $pdf }}" style="width:600px; height:500px;" frameborder="0"></iframe> --}}
        {{-- <embed src="{{ $pdf }}" width="800px" height="2100px" /> --}}
        {{-- <embed src="{{ $pdf }}" type="application/pdf" frameBorder="0" scrolling="auto" height="100%"
            width="100%"></embed> --}}
        <div class="container flex-center">
            <p>PDF</p>
            <a href="{{ $pdf }}" class="btn btn-primary float-right pl-2">Download</a>
            <br>
            <object style="align: center" width="800px" height="1000px" type="application/pdf"
                data="{{ $pdf }}#toolbar=0" id="pdf_content">
                <p>Document load was not
                    successful.</p>
            </object>
        </div>

    </main>
@endsection
