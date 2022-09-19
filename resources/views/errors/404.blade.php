@extends('layout.app')
@section('title')
    <title>COA</title>
@endsection

@section('content')
    <main>
        <h2>{{ $exception->getMessage() }}</h2>
    </main>
@endsection
