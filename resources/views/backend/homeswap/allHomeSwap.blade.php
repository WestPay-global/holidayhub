@extends('backend.layouts.design')
@section('title')Swap Properties @endsection

@section('extra_css')
    <style>
        .pointer{
            cursor: pointer;
        }
        .selected .sorting_1{
            color: white;
        }
    </style>
@endsection

@section('content')
<div class="content">

    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    @if (session('success'))
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                confirmAlert("{{ session('success') }}", 'success');
            });
        </script>
    @endif


    <!-- Start Content-->
    <div class="container-fluid">

        {{-- @if(Session::has('success'))
            <div class="alert alert-success mb-3 text-center">
                {{ Session::get('success') }}
            </div>
        @endif --}}

        <div class="row d-none">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border" id="dash-daterange">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">{{ucFirst($status)}} Swap Properties</h4>
                </div>
            </div>
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Dashboard</a> </li>
                            <li class="breadcrumb-item active"><a href="javascript: void(0);">Swap Properties</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ucFirst($status)}} Swap Properties</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- table part-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Properties</h4>
                        <p class="text-muted font-13 mb-4">
                            This shows the list of Swap Properties.
                        </p>

                        <div>
                            <table id="datatable-buttons" class="table table-striped nowrap w-100" style="overflow-x: auto;">
                                <thead>
                                    <tr>
                                        <th>Owner Name</th>
                                        <th>Seeker Name</th>
                                        <th>List City</th>
                                        <th>Swap Type</th>
                                        <th>Offers</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <td>Action</td>

                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($listings) > 0)
                                        @foreach ($listings as $item)
                                            <tr>
                                                <td>
                                                    @if ($item->createdBy->profile_picture)
                                                        <img src="{{ $item->createdBy->profile_picture }}" alt="Profile Picture" style="width: 25px; height: 25px; border-radius: 5px;">
                                                    @else
                                                        <div style="font-size: 24px; text-align:center;"><i class="fa fa-user-circle-o"></i></div>
                                                    @endif
                                                    <h5>{{ $item->createdBy->name }}</h5>
                                                </td>

                                                <td>{{ $item?->seeker?->name ? $item->seeker->name : 'N/A' }}</td>

                                                <td>{{ $item->place_city ? $item->place_city : 'N/A' }}</td>

                                                <td>{{ $item->swap_type }}</td>

                                                <td><span class="badge bg-dark">{{count($item->listOffers)}}</span></td>

                                                <td>{{ $item->created_at->format('D, M j, Y') }}</td>

                                                <td>
                                                    <div class="btn-group">
                                                        <span class="badge bg-{{ $item->getBgColor($item->status) }} pointer" data-bs-toggle="dropdown">{{ucFirst($item->status)}}</span>
                                                        <div class="dropdown-menu">
                                                            @foreach ($allStatus as $status)
                                                                <a class="dropdown-item {{ $item->status == $status['name'] ? 'd-none' : '' }}"
                                                                    {{-- href="{{ route('adminUpdateSwap Propertiestatus', ['id' => $user->id, 'status' => $status['name']]) }}" --}}
                                                                >
                                                                    {{ ucFirst($status['name']) }}
                                                                </a>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-space-between align-items-center">
                                                        <a class="btn btn-light btn-sm border border-info me-1 d-none"><i class="fa fa-edit text-info"></i></a>
                                                        <a
                                                        href="{{ route('singleHomeSwap', $item->id) }}"
                                                        class="btn btn-light btn-sm border border-primary me-1"><i class="fa fa-eye text-primary"></i></a>

                                                        <form method="POST"
                                                        {{-- action="{{ route('adminUserDelete', $user->id) }}" --}}
                                                        >
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-light btn-sm border border-danger me-1 show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash text-danger"></i></button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>

                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        <!-- end row-->



    </div> <!-- container -->

</div>
@endsection

@section('extra_js')
<!-- Datatables init -->
<script src="{{asset('/assets/js/pages/datatables.init.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true, //ok btn red color
          })
          .then((willDelete) => {
            if (willDelete) {
            form.submit();
            // confirmAlert('Removed Successfully', "success")

            } else {
                console.log('nothing');

            }
          });
    });

      function confirmAlert(title, icon) {
        swal({
            title: title,
            icon: icon,
        })
      }

</script>

@endsection
