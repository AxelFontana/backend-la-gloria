<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Http\Controllers\APIControllers\BaseAPIController;

class APIOrderDetailController extends BaseAPIController
{
/**
 * @OA\Get(
 *     path="/rest/order-details",
 *     summary="Get a list of all order details",
 *     description="Returns a paginated list of all order details in the application",
 *     tags={"Order Details"},
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/OrderDetailResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Internal Server Error",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Internal Server Error"
 *             )
 *         )
 *     )
 * )
 */
    public function index()
    {
        $order_details = OrderDetail::paginate(9);
        return OrderDetailResource::collection($order_details);
    }

/**
 * Show the form for creating a new order detail in JSON format.
 * Product amount must be at least 1
 * Shopping Cart ID must be of a shopping cart already in the database
 * Product ID must be of a product already in the database 
 */

/**
 * @OA\Get(
 *     path="/rest/order-details/create",
 *     summary="Show the form for creating a new order detail in JSON format.",
 *     description="Product amount must be at least 1, Shopping Cart ID must be of a shopping cart already in the database, Product ID must be of a product already in the database",
 *     tags={"Order Details"},
 *     operationId="createOrderDetail",
 *     @OA\Response(
 *         response="200",
 *         description="Returns the form fields in JSON format",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="fields",
 *                 type="object",
 *                 @OA\Property(
 *                     property="product_amount",
 *                     type="number",
 *                     description="Product Amount field with validation rules",
 *                     example={
 *                         "type": "number",
 *                         "label": "Product Amount",
 *                         "required": true
 *                     }
 *                 ),
 *                 @OA\Property(
 *                     property="shopping_cart_id",
 *                     type="number",
 *                     description="Shopping Cart ID field with validation rules",
 *                     example={
 *                         "type": "number",
 *                         "label": "Shopping Cart ID",
 *                         "required": true
 *                     }
 *                 ),
 *                 @OA\Property(
 *                     property="product_id",
 *                     type="number",
 *                     description="Product ID field with validation rules",
 *                     example={
 *                         "type": "number",
 *                         "label": "Product ID",
 *                         "required": true
 *                     }
 *                 )
 *             )
 *         )
 *     )
 * )
 */
public function create()
{
    $orderDetailFields = [
        'product_amount' => [
            'type' => 'number',
            'label' => 'Product Amount',
            'required' => true
        ],
        'shopping_cart_id' => [
            'type' => 'number',
            'label' => 'Shopping Cart ID',
            'required' => true
        ],
        'product_id' => [
            'type' => 'number',
            'label' => 'Product ID',
            'required' => true
        ],
    ];

    return response()->json([
        'fields' => $orderDetailFields,
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


/**
 * @OA\Get(
 *      path="/rest/order-details/id/{id}",
 *      operationId="getOrderDetailById",
 *      tags={"Order Details"},
 *      summary="Get a single order detail",
 *      description="Returns the order detail identified by the given ID",
 *      @OA\Parameter(
 *          name="id",
 *          description="ID of the order detail to return",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success",
 *          @OA\JsonContent(ref="#/components/schemas/OrderDetailResource")
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Resource not found"
 *      )
 * )
 */
    public function show(string $id)
    {
        $order_detail = OrderDetail::findOrFail($id);
        return new OrderDetailResource($order_detail);
    }

/**
 * @OA\Get(
 *     path="/rest/order-details/shopping-cart/{shoppingCartId}",
 *     summary="Get order details by shopping cart",
 *     description="Get the order details associated with a specific shopping cart.",
 *     tags={"Order Details"},
 *     @OA\Parameter(
 *         name="shoppingCartId",
 *         description="Shopping cart ID",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved order details",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/OrderDetailResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Shopping cart not found"
 *     )
 * )
 */
    public function getOrderDetailsByShoppingCart(string $shoppingCartId)
    {
        $shoppingCart = ShoppingCart::findOrFail($shoppingCartId);
        $orderDetails = $shoppingCart->ordersDetail()->get();
    
        return $orderDetails;
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
