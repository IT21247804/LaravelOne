@extends('layouts.layout')

@section('content')
<div id="app"></div> <!-- The root div where React will render -->

<!-- Include the Vite-compiled JavaScript file -->
@vite('resources/js/app.js') <!-- Make sure this path is correct based on your setup -->

@endsection
