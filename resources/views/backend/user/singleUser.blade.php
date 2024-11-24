@extends('backend.layouts.design')
@section('title')Users @endsection

@php

@endphp

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
<div class="container my-5">
    <!-- User Profile -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5>User Profile</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $user->profile_picture ?? 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                </div>
                <div class="col-md-8">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>About:</strong> {{ $user->about ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Home Swaps -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5>Home Swaps</h5>
        </div>
        <div class="card-body">
            @if ($user->homeSwaps->isEmpty())
                <p>No home swaps available.</p>
            @else
                @foreach ($user->homeSwaps as $swap)
                    <div class="border p-3 mb-3">
                        <h5>{{ $swap->short_decsription }}</h5>
                        <p><strong>City:</strong> {{ $swap->place_city }}, {{ $swap->place_state }}</p>
                        <p><strong>Country:</strong> {{ $swap->place_country }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($swap->status) }}</span></p>
                        <div class="d-flex gap-2">
                            @foreach (json_decode($swap->place_pictures) as $picture)
                                <img src="{{ $picture }}" alt="Place Image" class="img-thumbnail" style="width: 100px;">
                            @endforeach
                        </div>
                        <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="collapse" data-bs-target="#swap-{{ $swap->id }}-offers" aria-expanded="false">
                            View Offers ({{ count($swap->listOffers) }})
                        </button>

                        <!-- Offers Section -->
                        <div class="collapse mt-3" id="swap-{{ $swap->id }}-offers">
                            @if (count($swap->listOffers) > 0)
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Seeker</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Stay Duration</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($swap->listOffers as $offer)
                                            <tr>
                                                <td>{{ $offer->seeker->name }}</td>
                                                <td>{{ $offer->check_in }}</td>
                                                <td>{{ $offer->check_out }}</td>
                                                <td>{{ $offer->stay_duration }} nights</td>
                                                <td><span class="badge bg-warning">{{ ucfirst($offer->status) }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No offers available for this listing.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Non-Swaps -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5>Non-Swaps</h5>
        </div>
        <div class="card-body">
            @if ($user->nonSwaps->isEmpty())
                <p>No non-swap listings available.</p>
            @else
                @foreach ($user->nonSwaps as $nonSwap)
                    <div class="border p-3 mb-3">
                        <h5>{{ $nonSwap->house_precise_title }}</h5>
                        <p><strong>City:</strong> {{ $nonSwap->place_city }}, {{ $nonSwap->place_state }}</p>
                        <p><strong>Country:</strong> {{ $nonSwap->place_country }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($nonSwap->status) }}</span></p>
                        <div class="d-flex gap-2">
                            @foreach (json_decode($nonSwap->place_pictures) as $picture)
                                <img src="{{ $picture }}" alt="Place Image" class="img-thumbnail" style="width: 100px;">
                            @endforeach
                        </div>
                        <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="collapse" data-bs-target="#nonSwap-{{ $nonSwap->id }}-offers" aria-expanded="false">
                            View Offers ({{ count($nonSwap->listOffers) }})
                        </button>

                        <!-- Offers Section -->
                        <div class="collapse mt-3" id="nonSwap-{{ $nonSwap->id }}-offers">
                            @if (count($nonSwap->listOffers) > 0)
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Seeker</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Stay Duration</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nonSwap->listOffers as $offer)
                                            <tr>
                                                <td>{{ $offer->seeker->name }}</td>
                                                <td>{{ $offer->check_in }}</td>
                                                <td>{{ $offer->check_out }}</td>
                                                <td>{{ $offer->stay_duration }} nights</td>
                                                <td><span class="badge bg-warning">{{ ucfirst($offer->status) }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No offers available for this listing.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
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
