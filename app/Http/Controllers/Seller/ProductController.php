<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Rules\ValidatePrice;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $data = [
            'pageTitle' => 'Adicionar Produto',
            'categories' => Category::orderBy('category_name', 'asc')->get(),
        ];
        return view('back.pages.seller.add-product', $data);
    } // End Method

    public function getProductCategory(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);
        $subcategories = SubCategory::where('category_id', $category_id)
            ->where('is_child_of', 0)
            ->orderBy('subcategory_name', 'asc')
            ->get();

        $html = '';
        foreach ($subcategories as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->subcategory_name . '</option>';
            if (count($item->children) > 0) {
                foreach ($item->children as $child) {
                    $html .= '<option value="' . $child->id . '">-- ' . $child->subcategory_name . '</option>';
                }
            }
        }
        return response()->json(['status' => 1, 'data' => $html]);
    } //end method

    public function createProduct(Request $request)
    {
        //validate the form
        $request->validate([
            'name' => 'required',
            'summary' => 'required|min:10',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'product_image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'price' => ['required', new ValidatePrice],
            'compare_price' => ['nullable', new ValidatePrice],
        ], [
            'name.required' => 'O nome do produto é obrigatório.',
            'summary.required' => 'O resumo do produto é obrigatório.',
            'category.required' => 'Selecione a categoria do produto.',
            'subcategory.required' => 'Selecione a subcategoria do produto.',
            'product_image.required' => 'Selecione a imagem do produto.',
            'price.required' => 'O preço do produto é obrigatório.',


        ]);

        $product_image = null;
        if ($request->hasFile('product_image')) {
            $path = 'images/products/';
            $file = $request->file('product_image');
            $filename = 'PRODUCT_' . time() . uniqid() . '.' . $file->getClientOriginalExtension();

            // $upload = $file->move(public_path($path), $filename);

            $maxWidth = 1080;
            $maxHeight = 1080;
            $full_path = $path.$filename;
            $image = Image::make($file->path());

            $image->height() > $image->width() ? $maxWidth = null : $maxHeight = null;
            $image->fit($maxWidth, $maxHeight, function($constraint){
                $constraint->upsize();
            });
            $upload = $image->save($full_path);

            if ($upload) {
                $product_image = $filename;
            }
        }
        // Save PRODUCT DETAILS
        $product = new Product();
        $product->user_type = 'seller';
        $product->seller_id = auth('seller')->user()->id;
        $product->name = $request->name;
        $product->summary = $request->summary;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->visibility = $request->visibility;
        $product->product_image = $product_image;
        $saved = $product->save();


        if ($saved) {
            return response()->json(['status' => 1, 'msg' => 'Produto adicionado com sucesso.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Falha ao adicionar o produto.']);
        }
    } //end method

    public function allProducts(Request $request){
        $data = [
            'pageTitle' => 'Todos os Produtos',
        ];
        return view('back.pages.seller.products', $data);
    } //end method

    public function editProduct(Request $request){
        $product = Product::findOrfail($request->id);
        $categories = Category::orderBy('category_name', 'asc')->get();
        $subcategories = SubCategory::where('category_id', $product->category)
            ->where('is_child_of', 0)
            ->orderBy('subcategory_name', 'asc')
            ->get();
        $data = [
            'pageTitle' => 'Editar Produto',
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ];

        return view('back.pages.seller.edit-product', $data);
    } //end method

    public function updateProduct(Request $request){
        $product = Product::findOrfail($request->product_id);
        $product_image = $product->product_image;

        // validate the form

        $request ->validate([
            'name' => 'required',
            'summary' => 'required|min:10',
            'product_image' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',

            'price' => ['required', new ValidatePrice],
            'compare_price' => ['nullable', new ValidatePrice],
        ], [
            'name.required' => 'O nome do produto é obrigatório.',
            'summary.required' => 'O resumo do produto é obrigatório.',
            'category.required' => 'Selecione a categoria do produto.',
            'subcategory.required' => 'Selecione a subcategoria do produto.',
            'product_image.required' => 'Selecione a imagem do produto.',
            'price.required' => 'O preço do produto é obrigatório.',
        ]);

        // upload new image
        if($request->hasFile('product_image')){
            $path = 'images/products/';
            $file = $request->file('product_image');
            $filename = 'PIMG_' . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $old_product_image = $product->product_image;

            // $upload = $file->move(public_path($path), $filename);

            $maxWidth = 1080;
            $maxHeight = 1080;
            $full_path = $path.$filename;
            $image = Image::make($file->path());

            $image->height() > $image->width() ? $maxWidth = null : $maxHeight = null;
            $image->fit($maxWidth, $maxHeight, function($constraint){
                $constraint->upsize();
            });
            $upload = $image->save($full_path);

            if($upload){
                // delete the old image
                if(File::exists(public_path($path.$old_product_image))){
                    File::delete(public_path($path.$old_product_image));
                }
                $product_image = $filename;
            }
        }
        // update the product
        $product->name = $request->name;
        $product->slug = null;
        $product->summary = $request->summary;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->visibility = $request->visibility;
        $product->product_image = $product_image;
        $updated = $product->save();

        if($updated){
            return response()->json(['status' => 1, 'msg' => 'Produto atualizado com sucesso.']);
        }else{
            return response()->json(['status' => 0, 'msg' => 'Falha ao atualizar o produto.']);
        }

    }// end method

    public function uploadProductImages(Request $request){
        $product = Product::findOrFail($request->product_id);
        $path = 'images/products/additionals/';
        $file = $request->file('file');
        $filename = 'APIMG_'.$product->id.time().uniqid().'.' .
        $file->getClientOriginalExtension();

        // upload the image
        // $file->move(public_path($path), $filename);
        $maxWidth = 1080;
        $maxHeight = 1080;
        $full_path = $path.$filename;
        $image = Image::make($file->path());

        $image->height() > $image->width() ? $maxWidth = null : $maxHeight = null;
        $image->fit($maxWidth, $maxHeight, function($constraint){
            $constraint->upsize();
        });
        $image->save($full_path);

        // save the image in the database
        $pimage = new ProductImage();
        $pimage->product_id = $product->id;
        $pimage->image = $filename;
        $pimage->save();
    } // end method

    public function getProductImages(Request $request){
        $product = Product::with('images')->findOrfail($request->product_id);
        $path = 'images/products/additionals/';
        $html = '';
        if( $product->images->count() > 0){
            foreach($product->images as $item){
                $html .= '<div class="box">
                    <img src="/'.$path.$item->image.'">
                    <a href="javascript:;" data-image="'.$item->id.'" class="btn btn-danger btn-sm" id="deleteProductImageBtn"><i class="fa fa-trash"></i></a>
                    </div>';
            }
        }else{
            $html .= '<span class="text-danger">Nenhuma imagem encontrada.</span>';

        }
        return response()->json(['status' => 1, 'data' => $html]);
    } // end method

    public function deleteProductImage(Request $request){
        $product_image = ProductImage::findOrFail($request->image_id);
        $path = 'images/products/additionals/';
        if ($product_image->image != '' && File::exists(public_path($path.$product_image->image))) {
            File::delete(public_path($path.$product_image->image));
        }
        $delete = $product_image->delete();

        if($delete){
            return response()->json(['status' => 1, 'msg' => 'Imagem excluída com sucesso.']);
        }else{
            return response()->json(['status' => 0, 'msg' => 'Falha ao excluir a imagem.']);
        }
    }

}
