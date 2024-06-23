<div>

    <div class="row">
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Categorias</h4>
                    </div>

                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-category') }}" class="boxed-btn btn-sm"
                            type="button">
                            <i class="fa fa-plus"></i>
                            Adicionar Categoria
                        </a>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Imagem da Categoria </th>
                                <th>Nome da Categoria</th>
                                <th>N. de Sub Categorias</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0" id="sortable_categories">
                            @forelse ($categories as $item)

                                <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering}}">
                                    <td>
                                        <div class="avatar mr-2">
                                            <img src="/images/categories/{{ $item->category_image }}" width="50"
                                                height="50" alt="">
                                        </div>
                                    </td>

                                    <td>
                                        {{ $item->category_name }}
                                    </td>
                                    <td>
                                        {{ $item->subcategories->count() }}
                                    </td>
                                    <td>
                                        <div class="table-action">
                                            <a href="{{route('admin.manage-categories.edit-category', ['id'=>$item->id])}}" class="text-primary">
                                                <i class="dw dw-edit2"></i>
                                            </a>

                                            <a href="javascript:;" class="text-danger deleteCategoryBtn" data-id="{{ $item->id}}">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>


                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">Categoria não encontrada!</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $categories->links('livewire::simple-bootstrap')}}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Sub Categorias</h4>
                    </div>

                    <div class="pull-right">
                        <a href="{{ route('admin.manage-categories.add-subcategory') }}" class="boxed-btn btn-sm" type="button">
                            <i class="fa fa-plus"></i>
                            Adicionar Sub Categoria
                        </a>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Nome da Sub Categoria</th>
                                <th>Nome da Categoria</th>
                                <th>N. de subcategorias filhas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody class="table-border-bottom-0" id="sortable_subcategories">
                            @forelse ($subcategories as $item)
                            <tr data-index="{{ $item->id }}" data-ordering="{{ $item->ordering }}">


                                <td>
                                    {{ $item->subcategory_name}}
                                </td>
                                <td>
                                    {{ $item->parentcategory->category_name}} 
                                </td>
                                <td>
                                    @if ( $item->children->count() > 0)
                                        <ul class="list-group" id="sortable_child_subcategories">
                                            @foreach ($item->children as $child)
                                                <li data-index="{{ $child->id}}" data-ordering="{{ $child->ordering }}" class="d-flex justify-content-between align-items-center">
                                                    - {{ $child->subcategory_name}}
                                                    <div>
                                                        <a href="{{ route('admin.manage-categories.edit-subcategory', ['id'=> $child->id])}}" class="text-primary" data-toggle="tooltip" title="Editar descendente da subcategoria ">Editar</a>
                                                        |
                                                        <a href="javascript:;" class="text-danger deleteChildSubCategoryBtn" data-toggle="tooltip" title="Deletar descendente da subcategoria " data-id="{{ $child->id}}" data-title="Subcategoria descendente" >Deletar</a>
                                                    </div>
                                                </li>
                                                
                                            @endforeach
                                        </ul>
                                    @else
                                        none
                                    @endif
                                </td>
                                <td>
                                    <div class="table-action">
                                        <a href="{{ route('admin.manage-categories.edit-subcategory', ['id' => $item->id])}}" class="text-primary">
                                            <i class="dw dw-edit2"></i>
                                        </a>

                                        <a href="javascript:;" class="text-danger deleteSubCategoryBtn" data-id="{{ $item->id }}" data-title="Subcategoria">
                                            <i class="dw dw-delete-3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td>
                                        <span class="text-danger">Nenhuma Subcategoria encontrada!</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-block mt-2">
                    {{ $subcategories->links('livewire::simple-bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>
