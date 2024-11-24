@extends('backend.layouts.design')
@section('title')Single Reservation @endsection

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
<div class="container my-1">
    <!-- Place Details -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="text-white">Reserved Home Details</h5>
        </div>
        <div class="card-body">
            <h5>{{ $nonSwap->short_decsription }}</h5>
            <p><strong>Address:</strong> {{ $nonSwap->place_address }}</p>

            @if ($describePlaceFeatures)
            <p><strong>Describe Place Features:</strong>
            <div class="d-flex gap-3 mb-3">
                @foreach ($describePlaceFeatures as $item)
                    <p> <span class="border border-rounded p-2">{{ $item }}</span></p>
                @endforeach
            </div>
            @endif

            @if ($whatPlaceOfferVisitors)
            <p><strong>What Place Can Offer Visitors:</strong>
            <div class="d-flex gap-3 mb-3">
                @foreach ($whatPlaceOfferVisitors as $item)
                    <p> <span class="border border-rounded p-2">{{ $item }}</span></p>
                @endforeach
            </div>
            @endif

            <div class="d-flex gap-5">
                <p><strong>City:</strong> {{ $nonSwap->place_city }}</p>
                <p><strong>State:</strong> {{ $nonSwap->place_state }}</p>
                <p><strong>Country:</strong> {{ $nonSwap->place_country }}</p>
            </div>

            <div class="d-flex gap-5">
                <p><strong>Bedrooms:</strong> {{ $nonSwap->bedrooms }}</p>
                <p><strong>Beds:</strong> {{ $nonSwap->beds }}</p>
                <p><strong>Bathrooms:</strong> {{ $nonSwap->bathrooms }}</p>
            </div>

            <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($nonSwap->status) }}</span></p>
            <div class="d-flex gap-2">
                @foreach (json_decode($nonSwap->place_pictures) as $picture)
                    <img src="{{ $picture }}" alt="Place Image" class="img-thumbnail" style="width: 100px;">
                @endforeach
            </div>
        </div>
    </div>

    <!-- Owner Details -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="text-white">Owner Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $nonSwap->createdBy->name }}</p>
            <p><strong>Email:</strong> {{ $nonSwap->createdBy->email }}</p>
            <p><strong>About:</strong> {{ $nonSwap->createdBy->about ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Offers Section -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="text-white">Offers</h5>
        </div>
        <div class="card-body">
            @if ($nonSwap->listOffers->isEmpty())
                <p>No offers available for this listing.</p>
            @else
                @foreach ($nonSwap->listOffers as $offer)
                    <div class="border p-3 mb-3">
                        <h6>Offer by {{ $offer->seeker->name }}</h6>
                        <p><strong>Check-in:</strong> {{ $offer->check_in }}</p>
                        <p><strong>Check-out:</strong> {{ $offer->check_out }}</p>
                        <p><strong>Stay Duration:</strong> {{ $offer->stay_duration }} nights</p>
                        <p><strong>Initial Message:</strong> {{ $offer->initial_message }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($offer->status) }}</span></p>
                        <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="collapse" data-bs-target="#offer-{{ $offer->id }}" aria-expanded="false">
                            View More Details
                        </button>

                        <!-- Collapsible Offer Details -->
                        <div class="collapse mt-3" id="offer-{{ $offer->id }}">
                            <p><strong>Number of Adults:</strong> {{ $offer->no_of_adults }}</p>
                            <p><strong>Number of Children:</strong> {{ $offer->no_of_children }}</p>
                            <p><strong>Number of Infants:</strong> {{ $offer->no_of_infants }}</p>
                            <p><strong>Exchange Type:</strong> {{ ucfirst($offer->exchange_type) }}</p>
                            <p><strong>Owner Pre-Approval:</strong> {{ $offer->owner_pre_approve ? 'Yes' : 'No' }}</p>
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
