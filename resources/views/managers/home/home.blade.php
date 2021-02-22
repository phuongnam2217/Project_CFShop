@extends('managers.layout.master')
@section('content')
    <section class="content">
        <div class="body">
            <div class="home-nav">
                <h5>Kết quả bán hàng hôm nay</h5>

            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        {{--        (2500).toLocaleString('VN', {--}}
        {{--        style: 'currency',--}}
        {{--        currency: 'VND',--}}
        {{--        });--}}
        $(document).ready(function () {
            $("#home").addClass("active");
        });
    </script>
@endsection
