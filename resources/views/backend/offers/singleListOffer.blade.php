@extends('backend.layouts.design')
@section('title')List Offers @endsection

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
<div class="container my-2">
    <!-- Offer Details -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="text-white">Offer Details</h5>
        </div>
        <div class="card-body">
            <div class="d-flex gap-3">
                <p class="border border-rounded p-1"><strong>Check-in:</strong> {{ $offer->check_in }}</p>
                <p class="border border-rounded p-1"><strong>Check-out:</strong> {{ $offer->check_out }}</p>
            </div>

            <p><strong>Exchange Type:</strong> {{ ucfirst($offer->exchange_type) }}</p>

            <div class="d-flex gap-3">
                <p class="border border-rounded p-1"><strong>Number of Adults:</strong> {{ $offer->no_of_adults }}</p>
                <p class="border border-rounded p-1"><strong>Number of Children:</strong> {{ $offer->no_of_children }}</p>
                <p class="border border-rounded p-1"><strong>Number of Infants:</strong> {{ $offer->no_of_infants }}</p>
            </div>

            <p><strong>Stay Duration:</strong> {{ $offer->stay_duration }} nights</p>
            <p><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($offer->status) }}</span></p>
            <p><strong>Initial Message:</strong> {{ $offer->initial_message }}</p>
        </div>
    </div>

    @if ($offer->list_type=='homeswap')
        <!-- Home Swap Listing Details -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="text-white">Home Swap Listing</h5>
            </div>
            <div class="card-body">
                <h5>{{ $offer->homeswaplist->short_decsription }}</h5>
                <p><strong>Address:</strong> {{ $offer->homeswaplist->place_address }}</p>
                <div class="d-flex gap-3">
                    <p class="border border-rounded p-1"><strong>City:</strong> {{ $offer->homeswaplist->place_city }}</p>
                    <p class="border border-rounded p-1"><strong>State:</strong> {{ $offer->homeswaplist->place_state }}</p>
                    <p class="border border-rounded p-1"><strong>Country:</strong> {{ $offer->homeswaplist->place_country }}</p>
                </div>

                <div class="d-flex gap-3">
                    <p class="border border-rounded p-1"><strong>Bedrooms:</strong> {{ $offer->homeswaplist->bedrooms }}</p>
                    <p class="border border-rounded p-1"><strong>Beds:</strong> {{ $offer->homeswaplist->beds }}</p>
                    <p class="border border-rounded p-1"><strong>Bathrooms:</strong> {{ $offer->homeswaplist->bathrooms }}</p>
                </div>

                <div class="d-flex gap-2">
                    @foreach (json_decode($offer->homeswaplist->place_pictures) as $picture)
                        <img src="{{ $picture }}" alt="Place Image" class="img-thumbnail" style="width: 100px;">
                    @endforeach
                </div>
                <p class="mt-3"><strong>What You’ll Love About the Home:</strong> {{ $offer->homeswaplist->what_you_will_love_about_home }}</p>
                <p><strong>What You’ll Love About the Neighbourhood:</strong> {{ $offer->homeswaplist->what_you_will_love_about_neighbourhood }}</p>
            </div>
        </div>
    @else
        <!-- Non Swap Listing Details -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="text-white">Reservation Listing</h5>
            </div>
            <div class="card-body">
                <h5>{{ $offer->nonswaplist->house_precise_title }}</h5>
                <p><strong>Address:</strong> {{ $offer->nonswaplist->place_address }}</p>

                <div class="d-flex gap-3">
                    <p class="border border-rounded p-1"><strong>City:</strong> {{ $offer->nonswaplist->place_city }}</p>
                    <p class="border border-rounded p-1"><strong>State:</strong> {{ $offer->nonswaplist->place_state }}</p>
                    <p class="border border-rounded p-1"><strong>Country:</strong> {{ $offer->nonswaplist->place_country }}</p>
                </div>

                <div class="d-flex gap-3">
                    <p class="border border-rounded p-1"><strong>Bedrooms:</strong> {{ $offer->nonswaplist->bedrooms }}</p>
                    <p class="border border-rounded p-1"><strong>Beds:</strong> {{ $offer->nonswaplist->beds }}</p>
                    <p class="border border-rounded p-1"><strong>Bathrooms:</strong> {{ $offer->nonswaplist->bathrooms }}</p>
                </div>
                <div class="d-flex gap-2">
                    @foreach (json_decode($offer->nonswaplist->place_pictures) as $picture)
                        <img src="{{ $picture }}" alt="Place Image" class="img-thumbnail" style="width: 100px;">
                    @endforeach
                </div>
                <p class="mt-3"><strong>House Description In Detail:</strong> {{ $offer->nonswaplist->describe_house_in_detail }}</p>

            </div>
        </div>
    @endif


    <div class="row">
        <!-- Owner Details -->
        <div class="col-6 card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="text-white">Owner Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $offer->owner->name }}</p>
                <p><strong>Email:</strong> {{ $offer->owner->email }}</p>
                <p><strong>About:</strong> {{ $offer->owner->about ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Seeker Details -->
        <div class="col-6 card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="text-white">Seeker Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $offer->seeker->name }}</p>
                <p><strong>Email:</strong> {{ $offer->seeker->email }}</p>
                <p><strong>About:</strong> {{ $offer->seeker->about ?? 'N/A' }}</p>
            </div>
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
