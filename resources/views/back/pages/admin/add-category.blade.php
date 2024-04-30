@extends('back.layout.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Adicionar Categoria')
@section('content')
    <div class="row">
        <div class="col-md 12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-dark">Adicionar Categoria</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.cats-subcats-list') }}" class="btn btn-primary">
                            <i class="ion-arrow-left-a"></i>Volta para lista de Categorias
                        </a>
                    </div>
                </div>
                <hr>
                <form action="{{ route('admin.manage-categories.store-category') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            <strong><i class="dw dw-checked"></i></strong>
                            {!! Session::get('success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <Span arial-hidden="true">&times;</Span>
                            </button>
                        </div>
                        
                    @endif

                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        <strong><i class="dw dw-checked"></i></strong>
                        {!! Session::get('fail') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <Span arial-hidden="true">&times;</Span>
                        </button>
                    </div>
                    
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="">Nome da Categoria</label>
                            <input type="text" class="form-control" name="category_name"
                            placeholder="Digite o nome da Categoria" value="{{ old('category_name')}}">
                            @error('category_name')
                                <span class="text-danger ml-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="">Imagem da Categoria</label>
                            <input type="file" name="category_img" id="" class="form-control">
                            @error('category_img')
                                <span class="text-danger ml-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="avatar mb-3">
                            <img src="" alt="" data-ijabo-default-img="" width="50" height="50" id="category_image_preview">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Criar Categoria</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('input[type="file"][name="category_img"]').ijaboViewer({
            preview: '#category_image_preview',
            imageShape: 'square',
            allowedExtensions:['png','jpg','jpeg','svg'],
            onErrorShape: function(message,element){
                toastr.error('A imagem deve ser Quadrada(1:1)');
            },
            onInvalidType: function(message,element){
                toastr.error('Por favor, selecione uma imagem. de preferência PNG ou JPG.'); 
            },
            onSuccess: function(message, element){
                toastr.success('Imagem carregada com sucesso!');        
            }
        });
    </script>
@endpush