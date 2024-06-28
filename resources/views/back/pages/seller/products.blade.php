@extends('back.layout.dashboard-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<div class="container">
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Meus Produtos</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Meus Produtos
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-md-end">
                    <a href="{{ route('seller.product.add-product') }}" class="boxed-btn "><i class="fa fa-plus-circle me-2"></i> Adicionar novo produto</a>
                </div>
            </div>
        </div>
    </div>
    
    @livewire('seller.products')
  
</div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', 'a#deleteProductBtn', function(e) {
            e.preventDefault()
            var url = "{{ route('seller.product.delete-product') }}"
            var token = "{{ csrf_token() }}"
            var product_id = $(this).data('id')
            swal.fire({
                title: 'Você tem certeza?',
                html:   'Você não poderá reverter isso!',
                showCloseButton:true,
                showCancelButton:true,
                focusConfirm:true,
                confirmButtonText:'Sim, Deletar',
                cancelButtonText:'Cancelar',
                confirmButtonColor:'#d33',
                cancelButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false,
            }).then( function(result){
                if( result.value){
                    $.post(url,{ _token:token, product_id:product_id}, function(response){
                        toastr.remove();
                        if(response.status == 1){
                            Livewire.dispatch('refreshProductsList')
                            toastr.success(response.msg)
                        }else{
                            toastr.error(response.msg)
                        }
                    },'json')
                }
            })
        });
    </script>
@endpush
