@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Permissions <div class="col-md-6 pull-right"><input type="text" id="txt_search" class="form-control" onkeyup="search()" placeholder="Search Permissions.."></div><div class="clearfix"></div></div>
                    <table class="panel-body table table-hover table-striped" id="permissions-table">
                        <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-7">Permission</th>
                            <th class="col-md-2"># Roles</th>
                            <th class="col-md-2"># Used</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $index => $permission)
                            <tr class="clickable-row" data-href="{{ route('eon.admin.permissions.single', $permission->id) }}">
                                <a href="">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->roles->count() }}</td>
                                    <td>{{ $permission->users->count() }}</td>
                                </a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="list-group">
                        <a href="{{ route('eon.admin.roles') }}" class="list-group-item">
                            Roles
                        </a>
                        <a href="{{ route('eon.admin.permissions') }}" class="list-group-item active">
                            Permissions
                        </a>
                        <a href="{{ route('eon.admin.roles.users') }}" class="list-group-item">Users' Roles</a>
                        <a href="{{ route('eon.admin.departments') }}" class="list-group-item">Departments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });

        function search() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("txt_search");
            filter = input.value.toLowerCase();
            table = document.getElementById("permissions-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection