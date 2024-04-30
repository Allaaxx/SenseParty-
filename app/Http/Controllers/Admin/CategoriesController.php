<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\SubCategory;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
{
    public function catSubcatlist(Request $request)
    {
        $data = [
            'pageTittle' => '"Gerenciamento de Categorias e Subcategorias"',
        ];

        return view('back.pages.admin.cats-subcats-list', $data);
    }

    public function addCategory(Request $request)
    {
        $data = [
            'pageTittle' => '"Adicionar Categoria"',
        ];

        return view('back.pages.admin.add-category', $data);
    }


    public function storeCategory(Request $request)
    {
        //validate the form
        $request->validate([
            'category_name' => 'required | min:5 | unique:categories,category_name',
            'category_img' => 'required | image | mimes:jpeg,png,jpg,svg',

        ], [
            'category_name.required' => 'O campo "nome da categoria" é obrigatório',
            'category_name.min' => 'O campo "nome da categoria" deve ter no mínimo 5 caracteres',
            'category_name.unique' => 'Já existe uma "categoria" com este nome',
            'category_img.required' => 'O campo "imagem da categoria" é obrigatório',
            'category_img.image' => 'O campo "imagem da categoria" deve ser uma imagem',
            'category_img.mimes' => 'O campo "imagem da categoria" deve ser um arquivo do tipo: jpeg, png, jpg ou svg',
        ]);

        if ($request->hasFile('category_img')) {
            $path = 'images/categories/';
            $file = $request->file('category_img');
            $filename = time() . '_' . $file->getClientOriginalName();

            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
            }

            // upload image

            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
                //save category
                $category = new Category();
                $category->category_name = $request->category_name;
                $category->category_image = $filename;
                $saved = $category->save();

                if ($saved) {
                    return redirect()->route('admin.manage-categories.add-category')->with('success', '<b>' . ucfirst($request->category_name) . '<b> Está Adcionada com Sucesso!');
                } else {
                    return redirect()->route('admin.manage-categories.add-category')->with('fail', 'Houve um erro enquanto salvavamos a sua categoria');
                }
            } else {
                return redirect()->route('admin.manage-categories.add-category')->with('fail', 'Houve um erro enquanto faziamos o upload da sua imagem.');
            }
        }
    }
    public function editCategory(Request $request)
    {
        $category_id = $request->id;
        $category = Category::findOrfail($category_id);
        $data = [
            'pageTitle' => 'Editar Categoria',
            'category' => $category,
        ];
        return view('back.pages.admin.edit-category', $data);
    }

    public function updateCategory(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);

        // VALIDATE THE FORM
        $request->validate([
            'category_name' => 'required|min:5|unique:categories,category_name,' . $category_id,
            'category_img' => 'nullable|image|mimes:jpeg,png,jpg,svg',
        ], [
            'category_name.required' => 'O campo "nome da categoria" é obrigatório',
            'category_name.min' => 'O campo "nome da categoria" deve ter no mínimo 5 caracteres',
            'category_name.unique' => 'Já existe uma "categoria" com este nome',
            'category_img.image' => 'O campo "imagem da categoria" deve ser uma imagem',
            'category_img.mimes' => 'O campo "imagem da categoria" deve ser um arquivo do tipo: jpeg, png, jpg ou svg',
        ]);

        if ($request->hasFile('category_img')) {
            $path = 'images/categories/';
            $file = $request->file('category_img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $old_category_image = $category->category_image;

            //upload new category image
            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
                //Delete old category image
                if (File::exists(public_path($path . $old_category_image))) {
                    File::delete(public_path($path . $old_category_image));
                }
                //update category info
                $category->category_name = $request->category_name;
                $category->category_image = $filename; // Corrigido para 'category_image'
                $category->category_slug = null;
                $saved = $category->save();

                if ($saved) {
                    return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('success', '<b>' . ucfirst($request->category_name) . '<b> Está atualizada com sucesso!');
                } else {
                    return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'Houve um erro enquanto atualizavamos a sua categoria');
                }
            } else {
                return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'Houve um erro enquanto faziamos o upload da sua imagem.');
            }
        } else {
            // update category info
            $category->category_name = $request->category_name;
            $category->category_slug = null;
            $saved = $category->save();

            if ($saved) {
                return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('success', '<b>' . ucfirst($request->category_name) . '<b> Está atualizada com sucesso!');
            } else {
                return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'Houve um erro enquanto atualizavamos a sua categoria');
            }
        }
    }

    public function addSubCategory(Request $request)
    {
        $independent_subcategories = SubCategory::where('is_child_of', 0)->get();
        $categories = Category::all();
        $data = [
            'pageTitle' => 'Adicionar Subcategoria',
            'categories' => $categories,
            'subcategories' => $independent_subcategories,
        ];

        return view('back.pages.admin.add-subcategory', $data);
    }

    public function storeSubcategory(Request $request)
    {

        //validate de  form

        $request->validate([

            'parent_category' => 'required|exists:categories,id',

            'subcategory_name' => 'required|min:5|unique:sub_categories,subcategory_name',



        ], [

            'parent_category.required' => 'O campo "categoria pai" é obrigatório',

            'parent_category.exists' => 'A categoria pai selecionada não existe',

            'subcategory_name.required' => 'O campo "nome da subcategoria" é obrigatório',

            'subcategory_name.min' => 'O campo "nome da subcategoria" deve ter no mínimo 5 caracteres',

            'subcategory_name.unique' => 'Já existe uma "subcategoria" com este nome',

        ]);



        $subcategory = new SubCategory();

        $subcategory->category_id = $request->parent_category;

        $subcategory->subcategory_name = $request->subcategory_name;

        $subcategory->is_child_of = $request->is_child_of;

        $saved = $subcategory->save();



        if ($saved) {

            return redirect()->route('admin.manage-categories.add-subcategory')->with('success', '<b>' . ucfirst($request->subcategory_name) . '<b> está adicionada com sucesso!');
        } else {

            return redirect()->route('admin.manage-categories.add-subcategory')->with('fail', 'Houve um erro enquanto salvavamos a sua subcategoria');
        }
    }


    public function editSubCategory(Request $request)
    {
        $subcategory_id = $request->id;
        $subcategory = SubCategory::findOrFail($subcategory_id);
        $independent_subcategories = SubCategory::where('is_child_of', 0)->get();
        $data = [
            'pageTitle' => 'Editar Subcategoria',
            'categories' => Category::all(),
            'subcategory' => $subcategory,
            'subcategories' => (!empty($independent_subcategories)) ? $independent_subcategories : []
        ];
        return view('back.pages.admin.edit-subcategory', $data);
    }

    public function updateSubCategory(Request $request)
    {
        $subcategory_id = $request->subcategory_id;
        $subcategory = SubCategory::findOrFail($subcategory_id);

        // VALIDATE THE FORM
        $request->validate([
            'parent_category' => 'required|exists:categories,id',
            'subcategory_name' => 'required|min:5|unique:sub_categories,subcategory_name,' . $subcategory_id,
        ], [
            'parent_category.required' => 'O campo "categoria pai" é obrigatório',
            'parent_category.exists' => 'A categoria pai selecionada não existe',
            'subcategory_name.required' => 'O campo "nome da subcategoria" é obrigatório',
            'subcategory_name.min' => 'O campo "nome da subcategoria" deve ter no mínimo 5 caracteres',
            'subcategory_name.unique' => 'Já existe uma "subcategoria" com este nome',

        ]);

        //CHECK IF THIS SUB CATEGORY HAS CHILDREN
        if ($subcategory->children->count() && $request->is_child_of != 0) {
            return redirect()->route('admin.manage-categories.edit-subcategory', ['id' => $subcategory_id])->with('fail', 'Esta subcategoria tem(' . $subcategory->children->count() . ')subcategorias filhas. Você não pode alterar a categoria pai.');
        } else {
            // update subcategory info
            $subcategory->category_id = $request->parent_category;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->is_child_of = $request->is_child_of;
            $saved = $subcategory->save();

            if ($saved) {
                return redirect()->route('admin.manage-categories.edit-subcategory', ['id' => $subcategory_id])->with('success', '<b>' . ucfirst($request->subcategory_name) . '<b> Está atualizada com sucesso!');
            } else {
                return redirect()->route('admin.manage-categories.edit-subcategory', ['id' => $subcategory_id])->with('fail', 'Houve um erro enquanto atualizavamos a sua subcategoria');
            }
        }
    }
}
