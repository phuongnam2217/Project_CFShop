@extends('managers.layout.master')
@section('content')
    <img src="https://img.icons8.com/ios-filled/75/000000/table.png"/>

    <img src="https://img.icons8.com/dotty/80/000000/table.png"/>

    <img src="https://img.icons8.com/officel/80/000000/table.png"/>

    <img src="https://img.icons8.com/ultraviolet/100/000000/table.png"/>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#home").addClass("active");
        });
    </script>
@endsection
