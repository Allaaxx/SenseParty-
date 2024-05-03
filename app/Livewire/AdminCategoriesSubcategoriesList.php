<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

class AdminCategoriesSubcategoriesList extends Component
{
    use WithPagination;

    public $categoryPerPage = 5;
    public $subcategoryPerPage = 3;
    
    protected $listeners = [
        'updateCategoriesOrdering',
        'deleteCategory',
        'updateSubcategoriesOrdering',
        'updateChildSubcategoriesOrdering',
        'deleteSubCategory',
    ];
    
    public function updateCategoriesOrdering($positions)
    {
        foreach($positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        $this->showToastr('success', 'Categorias reordenadas com sucesso');  
    }

    public function updateSubcategoriesOrdering($positions){
        foreach( $positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
            $this->showToastr('success', 'Subcategorias reordenadas com sucesso.');
        }
    }

    public function updateChildSubcategoriesOrdering($positions){
        foreach( $positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
            $this->showToastr('success', 'Subcategorias Descendentes reordenadas com sucesso.');
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $path = 'images/categories/';
        $category_image = $category->category_image;

        // Check se tem subcategorias
        if( $category->subcategories->count() > 0){
            //Check se tem produtos relacionados a subcategorias

            //Delete subcategorias
            foreach($category->subcategories as $subcategory){
               $subcategory = SubCategory::findOrFail( $subcategory->id);
               $subcategory->delete();
            }
        }
        // delete a image
        if(File::exists($path.$category_image)){
            File::delete($path.$category_image);
        }

        //delete catagory from database
        $delete = $category->delete();

        if($delete){
            $this->showToastr('success', 'Categoria deletada com sucesso');
        }else{
            $this->showToastr('error', 'Erro ao deletar categoria');
        }
    }

    public function deleteSubCategory($subcategory_id){
        $subcategory = SubCategory::findOrFail($subcategory_id);
        
        //quando deletar uma subcategoria que tem subcategorias descendentes
        if($subcategory->children->count() > 0){
            // check if there is/are product(s) related to one of the child sub categories

            // IF no product(s) related to the child sub categories, delete the child sub categories
            foreach($subcategory->children as $child){
                SubCategory::where('id', $child->id)->delete();
            }

            // delete the parent sub category
            $subcategory->delete();
            $this->showToastr('success', 'Subcategoria deletada com sucesso');
        }else{
            //check if there is/are product(s) related to the sub category

            //delete the sub category
            $subcategory->delete();
            $this->showToastr('success', 'Subcategoria deletada com sucesso');
        }
    }
  

    public function showToastr($type, $message)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.admin-categories-subcategories-list',[
            'categories' => Category::orderby('ordering','asc')->paginate($this->categoryPerPage, ['*'], 'categoriesPage'),
            'subcategories' => SubCategory::where('is_child_of', 0)->orderBy('ordering', 'asc')->paginate($this->subcategoryPerPage, ['*'], 'subcategoriesPage'),
        ]);
    }
}
