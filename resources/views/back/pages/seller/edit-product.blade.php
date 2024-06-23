@extends('back.layout.dashboard-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Edit product</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('seller.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit product
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('seller.product.all-products') }}" class="boxed-btn">Ver todos produtos</a>
            </div>
        </div>
    </div>

    <form action="{{ route('seller.product.update-product') }}" method="POST" enctype="multipart/form-data"
        id="updateProductForm">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->id}}">
        <div class="row pd-10">
            <div class="col-md-8 mb-20">

                <div class="card-box height-100-p pd-20" style="position: relative">
                    <div class="form-group">
                        <label for=""><b>Nome do Produto:</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Digite o nome do produto" value="{{ $product->name }}">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Resumo do Produto:</b></label>
                        <textarea id="summary" class="form-control summernote" cols="30" rows="10">{{!! $product->summary !!}}</textarea>
                        <span class="text-danger error-text summary_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Imagem do Produto:</b><small>Deve ser Quadrada e tamanho maximo de
                                (1080x1080)</small></label>
                        <input type="file" name="product_image" class="form-control">
                        <span class="text-danger error-text product_image_error"></span>
                    </div>
                    <div class="d-block mb-3" style="max-width: 250px;">
                        <img src="" class="img-thumbnail" id="image-preview" data-ijabo-default-img="/images/products/{{ $product->product_image}}">
                    </div>
                    <b>Obs</b>:<small>Você poderá adcionar mais imagens relacionadas a esse produto quando for editar
                        ele.</small>
                </div>
            </div>

            <div class="col-md-4 mb-20">
                <div class="card-box min-height-200px pd-20 mb-20">
                    <div class="form-group">
                        <label for=""><b>Categoria:</b></label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $product->category == $item->id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                            @endforeach

                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Subcategoria:</b></label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            <option value="" selected>Não Selecionado</option>
                            @foreach ($subcategories as $item)
                                <option value="{{ $item->id }}" {{ $item->id ==  $product->subcategory ? 'selected' : '' }}>{{ $item->subcategory_name }}</option>

                                @if (count($item->children) > 0)
                                    @foreach ($item->children as $child)
                                        <option value="{{ $child->id }}" {{ $child->id ==  $product->subcategory ? 'selected' : '' }}>--{{ $child->subcategory_name }}</option>
                                    @endforeach
                                @endif
                            @endforeach

                        </select>
                        <span class="text-danger error-text subcategory_error"></span>
                    </div>

                </div>

                <div class="card-box min-height-200px pd-20 mb-20">
                    <div class="form-group">
                        <label for=""><b>Preço:</b><small>na Moeda Reais(R$)</small></label>
                        <input type="text" name="price" class="form-control" placeholder="R$ XX.xx" value="{{ $product->price }}">
                        <span class="text-danger error-text price_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Compare preço:</b><small>Opcional</small></label>
                        <input type="text" name="compare_price" class="form-control" placeholder="R$ XX.xx" value="{{ $product->compare_price }}">
                        <span class="text-danger error-text compare_price_error"></span>

                    </div>

                </div>


                <div class="card-box min-height-120px pd-20">
                    <div class="form-group">
                        <label for=""><b>Visibilidade:</b></label>
                        <select name="visibility" id="visibility" class="form-control">
                            <option value="1" {{ $product->visibility == 1 ? 'selected' : '' }}>Publico</option>
                            <option value="1" {{ $product->visibility == 0 ? 'selected' : '' }}>Privado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="  boxed-btn">Update Produto</button>
        </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card-box min-height-200px pd-20 mb-20">
                <div class="title mb-2">
                    <h6>Imagens adcionais do Produto</h6>
                </div>
                <form action="{{ route('seller.product.upload-images',['product_id'=>request('id')]) }}" class="dropzone">
                @csrf

                </form>

                <button class="btn btn-outline-primary btn-sm mt-2" id="uploadAdditionalImagesBtn">Upload</button>
            </div>
        </div>
        <div class="box-container mb-2" id="product_images">


        </div>

    </div>
  
</div>
  

   
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/extra-assets/dropzonejs/min/dropzone.min.css">
    <style>
        .box-container {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .box-container .box {
            background: #423838;
            display: block;
            width: 110px;
            height: 110px;
            position: relative;
            overflow: hidden;
        }

        .box-container .box img {
            width: 100%;
            height: 100%;
        }

        .box-container .box a {
            position: absolute;
            right: 7px;
            bottom: 5px;
        }

        .swal2-popup {
            font-size: .87rem !important;
        }
    </style>
@endpush


@push('scripts')
<script src="/extra-assets/dropzonejs/min/dropzone.min.js"></script>
    <script>
        //List SUBCATEGORIES according to select
        $(document).on('change', 'select#category', function(e) {
            e.preventDefault();
            var category_id = $(this).val();
            var url = "{{ route('seller.product.get-product-category') }}";
            if (category_id == '') {
                $('select#subcategory').find("option").not(":first").remove();
            } else {
                $.get(url, {
                    category_id: category_id
                }, function(response) {
                    $('select#subcategory').find("option").not(":first").remove();
                    $('select#subcategory').append(response.data);
                }, 'JSON');
            }
        });

        //preview image of product
        $('input[type="file"][name="product_image"]').ijaboViewer({
            preview: '#image-preview',
            default_img: $('#image-preview').data('ijabo-default-img'),
            imageShape: "square",
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            onErrorShape: function(message, element) {
                alert(message);
            },
            onInvalidType: function(message, element) {
                alert(message);
            },
            onSuccess: function(image) {}
        });

        //submit product form
        $('#updateProductForm').on('submit', function(e) {
            e.preventDefault();
            var summary = $('textarea.summernote').summernote('code');
            var form = this;
            var formdata = new FormData(form);
            formdata.append('summary', summary);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formdata,
                processData: false,
                dataType: 'JSON',
                contentType: false,
                beforeSend: function() {
                    toastr.remove()
                    $(form).find('span.error-text').text('');
                },
                success: function(response) {
                    toastr.remove();
                    if (response.status == '1') {
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                },


                error: function(response) {
                    toastr.remove();
                    $.each(response.responseJSON.errors, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }
            });
        })

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('.dropzone', {
            autoProcessQueue: false,
            parallelUploads: 1, //Number of files proccessed at a time
            addRemoveLinks: true,
            maxFilesize:2, //2mb
            acceptedFiles: 'image/*',
            init:function(){
                thisDz = this;
                var uploadBtn = document.getElementById('uploadAdditionalImagesBtn');
                uploadBtn.addEventListener('click',function(){
                    var nFiles = myDropzone.getQueuedFiles().length;
                    thisDz.options.parallelUploads = nFiles;
                    thisDz.processQueue();
                });

                thisDz.on('queuecomplete',function(){
                    this.removeAllFiles();
                    getProductImages()
                });
            }
        });
        getProductImages()
        // Corrigir a função getProductImages
function getProductImages() {
    var url = "{{ route('seller.product.get-product-images',['product_id'=>request('id')]) }}";
    $.get(url, {}, function(response) {
        $('div#product_images').html(response.data);
    }, 'json');
}

$(document).on('click', '#deleteProductImageBtn', function(e) {
    e.preventDefault();
    var url = "{{ route('seller.product.delete-product-image') }}";
    var token = "{{ csrf_token() }}";
    var image_id = $(this).data('image');
    swal.fire({
        title: 'Tem certeza?',
        html: 'Você deseja deletar essa imagem?',
        icon: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#556ee6',
        width: 300,
        allowOutsideClick: false,
    }).then(function(result) {
        if (result.value) {
            $.post(url, { _token: token, image_id: image_id }, function(response) {
                toastr.remove();
                if (response.status == '1') {
                    getProductImages();
                    toastr.success(response.msg);
                } else {
                    toastr.error(response.msg);
                }
            }, 'json');
        }
    }); // Corrigir a sintaxe aqui
});

// Corrigir a chamada da função getProductImages dentro do evento queuecomplete do Dropzone
thisDz.on('queuecomplete', function() {
    this.removeAllFiles();
    getProductImages(); // Adicionar a chamada da função aqui
});

    </script>
@endpush
