@extends('back.layout.dashboard-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<div class="container">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>New product</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('seller.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            New product
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('seller.product.all-products') }}" class="boxed-btn">Ver todos produtos</a>
            </div>
        </div>
    </div>

    <form action="{{ route('seller.product.create-product') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
        @csrf

        <div class="row pd-10">
            <div class="col-md-8 mb-20">

                <div class="card-box height-100-p pd-20" style="position: relative">
                    <div class="form-group">
                        <label for=""><b>Nome do Produto:</b></label>
                        <input type="text" class="form-control" name="name" placeholder="Digite o nome do produto">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Resumo do Produto:</b></label>
                        <textarea id="summary" class="form-control summernote" cols="30" rows="10"></textarea>
                        <span class="text-danger error-text summary_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Imagem do Produto:</b><small>Deve ser Quadrada e tamanho maximo de
                                (1080x1080)</small></label>
                        <input type="file" name="product_image" class="form-control">
                        <span class="text-danger error-text product_image_error"></span>
                    </div>
                    <div class="d-block mb-3" style="max-width: 250px;">
                        <img src="" class="img-thumbnail" id="image-preview" data-ijabo-default-img="">
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
                            <option value="" selected>Não Selecionado</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach

                        </select>
                        <span class="text-danger error-text category_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Subcategoria:</b></label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            <option value="" selected>Não Selecionado</option>

                        </select>
                        <span class="text-danger error-text subcategory_error"></span>
                    </div>

                </div>

                <div class="card-box min-height-200px pd-20 mb-20">
                    <div class="form-group">
                        <label for=""><b>Preço:</b><small>na Moeda Reais(R$)</small></label>
                        <input type="text" name="price" class="form-control" placeholder="R$ XX.xx">
                        <span class="text-danger error-text price_error"></span>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Compare preço:</b><small>Opcional</small></label>
                        <input type="text" name="compare_price" class="form-control" placeholder="R$ XX.xx">
                        <span class="text-danger error-text compare_price_error"></span>

                    </div>

                </div>


                <div class="card-box min-height-120px pd-20">
                    <div class="form-group">
                        <label for=""><b>Visibilidade:</b></label>
                        <select name="visibility" id="visibility" class="form-control">
                            <option value="1" selected>Publico</option>
                            <option value="0">Privado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <a type="submit" class="boxed-btn" style="">Criar Produto</a>
        </div>
    </form>
</div>
  
@endsection
    

@push('scripts')
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
        $('#addProductForm').on('submit', function(e) {
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
                        $(form)[0].reset();
                        $('textarea.summernote').summernote('code', '');
                        $('select#subcategory').find("option").not(":first").remove();
                        $('img#image-preview').attr('src', '');
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
    </script>
@endpush
