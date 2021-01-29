@extends('managers.layout.master')
@section('content')

    <section class="content">
        <div class="body">
            <div class="search">
                <div class="search-name">
                    <form action="">
                        <label for="" class="search-name-text">Tìm kiếm</label>
                        <input type="text" class="input" placeholder="Theo tên phiếu nhập, .." />
                    </form>
                </div>
            </div>
            <div class="table">
                <div class="subHeader">
                    <div>
                        <h2>Nguyên liệu</h2>
                    </div>
                    <div>

                        <!-- Nhập nguyên liệu -->
                        <div class="mybutton" style="width: 160px" data-bs-toggle="modal" data-bs-target="#addResource">
                            <i class="fas fa-fw fa-file-import"></i> Nhập nguyên liệu
                        </div>
                        <div class="modal fade" id="addResource" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nhập nguyên liệu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="subTable"></div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#resources").addClass("active");
        });
    </script>
@endsection

