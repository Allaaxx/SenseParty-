@extends('back.layout.dashboard-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')
<div class="container">

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            @livewire('card-box')
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                

                    @livewire('admin-profile-tabs')

                
            </div>
        </div>


    </div>
</div>
    @endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('updateAdminInfo', function(event) {
                $('#adminProfileName').html(event.adminName);
                $('#adminProfileEmail').html(event.adminEmail);
            });
        });

        $('input[type="file"][name="adminProfilePictureFile"][id="adminProfilePictureFile"]').ijaboCropTool({
          preview : '#adminProfilePicture',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['Recortar','Sair'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("admin.change-profile-picture") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            Livewire.dispatch('updateAdminSellerHeaderInfo');
            toastr.success(message);
          },
          onError:function(message, element, status){
            toastr.error(message);
          }
       });
    </script>
@endpush
