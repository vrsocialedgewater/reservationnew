@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
@endsection

@section('container')
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
{{--                            <button class="btn btn-secondary mb-3" id="single-row-delete-btn">Delete Row</button>--}}
                            <table class="display" id="row-select-delete">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>dummy@mail.com</td>
                                    <td>89776878</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>dummy@mail.com</td>
                                    <td>89776878</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>dummy@mail.com</td>
                                    <td>89776878</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>dummy@mail.com</td>
                                    <td>89776878</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>dummy@mail.com</td>
                                    <td>89776878</td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Selection And Deletion (Single Row) Ends-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script>
        (function ($) {
            $(document).ready(function () {
                var deleterow = $("#row-select-delete").DataTable();
                $("#row-select-delete tbody").on("click", "tr", function () {
                    if ($(this).hasClass("selected")) {
                        $(this).removeClass("selected");
                    } else {
                        deleterow.$("tr.selected").removeClass("selected");
                        $(this).addClass("selected");
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
