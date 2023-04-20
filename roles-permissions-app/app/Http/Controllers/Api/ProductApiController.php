<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Hash;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Models\Roles as UserResource;

class ProductApiController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/products",
 *     tags={"Products"},
 *     summary="Get list of products",
 *     description="Returns a list of products",
 *     @OA\Response(response="200", description="List of products"),
 *     @OA\Response(response="401", description="Unauthorized"),
 * )
 */
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

        /**
 * @OA\Delete(
 *     path="/api/productdelete/{id}",
 *     tags={"Products"},
 *     summary="Delete a Product by ID",
 *     description="Deletes a Product by their ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of Product to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="204", description="Product deleted successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="404", description="Product not found"),
 * )
 */
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }

/**
 * @OA\Put(
 *     path="/api/productedit/{id}",
 *     tags={"Products"},
 *     summary="Update a product",
 *     description="Update an existing product with the provided information",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the product to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Provide updated product information",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Product Name"),
 *             @OA\Property(property="detail", type="string", example="Updated Product Description"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="Product updated successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="404", description="Product not found"),
 *     @OA\Response(response="422", description="Unprocessable Entity"),
 * )
 */
public function editProduct(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    $product->name = $request->input('name', $product->name);
    $product->detail = $request->input('detail', $product->detail);
    $product->save();

    return response()->json($product, 200);
}



    /**
 * @OA\Post(
 *     path="/api/products",
 *     tags={"Products"},
 *     summary="Create a new product",
 *     description="Creates a new product with the provided information",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Provide product information",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Product Name"),
 *             @OA\Property(property="detail", type="string", example="Product Description"),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *         )
 *     ),
 *     @OA\Response(response="201", description="Product created successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="422", description="Unprocessable Entity"),
 * )
 */

    public function createProduct(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'detail' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        $product = new Product();
        $product->name = $request->input('name');
        $product->detail = $request->input('detail');
        $product->save();

        return response()->json($product, 201);
    }


}
