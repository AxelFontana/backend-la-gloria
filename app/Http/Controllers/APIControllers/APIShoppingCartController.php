<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ShoppingCartResource;
use App\Models\ShoppingCart;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIShoppingCartController extends BaseAPIController
{
/**
 * @OA\Get(
 *      path="/rest/shopping-carts",
 *      tags={"Shopping Carts"},
 *      summary="Display a listing of the resource.",
 *      description="Returns a paginated collection of shopping carts.",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/ShoppingCartResource")
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthorized",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Resource Not Found",
 *      )
 * )
 */
    public function index()
    {
        $shopping_carts = ShoppingCart::paginate(9);
        return ShoppingCartResource::collection($shopping_carts);
    }

/**
 * Retrieves a specific shopping cart by ID.
 *
 * @OA\Get(
 *     path="/rest/shopping-carts/id/{id}",
 *     summary="Retrieve a specific shopping cart",
 *     tags={"Shopping Carts"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the shopping cart to retrieve",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Shopping cart retrieved successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ShoppingCartResource")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Shopping cart not found"
 *     )
 * )
 */
    public function show(string $id)
    {
        $shopping_cart = ShoppingCart::findOrFail($id);
        return new ShoppingCartResource($shopping_cart);
    }

/**
 * @OA\Get(
 *      path="/rest/shopping-carts/create",
 *      summary="Show the form for creating a new shopping cart in JSON format.",
 *      description="Order Details array must have at least one element. The Client ID must be of a client already in the database. Total price must be at least 0 included",
 *      tags={"Shopping Carts"},
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="fields",
 *                  type="object",
 *                  @OA\Property(
 *                      property="total_price",
 *                      type="number",
 *                      description="Total price of the shopping cart",
 *                      example=94
 *                  ),
 *                  @OA\Property(
 *                      property="date",
 *                      type="string",
 *                      format="date",
 *                      description="Date of the shopping cart",
 *                      example="2023-05-12"
 *                  ),
 *                  @OA\Property(
 *                      property="client_id",
 *                      type="integer",
 *                      description="Client ID of the shopping cart",
 *                      example=1
 *                  ),
 *                  @OA\Property(
 *                      property="order_details",
 *                      type="array",
 *                      description="Array of Order Details objects",
 *                      @OA\Items(
 *                          type="object",
 *                          @OA\Property(
 *                              property="product_id",
 *                              type="integer",
 *                              description="Product ID of the Order Detail",
 *                              example=2
 *                          ),
 *                          @OA\Property(
 *                              property="product_amount",
 *                              type="integer",
 *                              description="Amount of the Order Detail",
 *                              example=3
 *                          )
 *                      )
 *                  )
 *              )
 *          )
 *      )
 * )
 */
    public function create()
    {
        $shoppingCartFields = [
            'total_price' => [
                'type' => 'number',
                'label' => 'Total Price',
                'required' => true
            ],
            'date' => [
                'type' => 'date',
                'label' => 'Date',
                'required' => true
            ],
            'client_id' => [
                'type' => 'number',
                'label' => 'Client ID',
                'required' => true
            ],
            'order_details' => [
                'type' => 'array',
                'label' => 'Order Details',
                'required' => true
            ],
        ];

        return response()->json([
            'fields' => $shoppingCartFields,
        ]);
    }


/**
 * Store a newly created resource in storage.
 *
 * @OA\Post(
 *      path="/rest/shopping-carts",
 *      tags={"Shopping Carts"},
 *      summary="Create a new shopping cart",
 *      description="Creates a new shopping cart with the given data. Validates the stock consistency for each product sold and updates the stock accordingly. The total price must be computed by the client.",
 *      @OA\RequestBody(
 *          required=true,
 *          description="Request body containing the shopping cart and order details data",
 *          @OA\JsonContent(
 *              type="object",
 *              required={"total_price", "date", "client_id", "order_details"},
 *              @OA\Property(
 *                  property="total_price",
 *                  type="number",
 *                  description="The total price of the shopping cart",
 *                  example=50
 *              ),
 *              @OA\Property(
 *                  property="date",
 *                  type="string",
 *                  format="date",
 *                  description="The date of the shopping cart in YYYY-MM-DD format",
 *                  example="2022-05-12"
 *              ),
 *              @OA\Property(
 *                  property="client_id",
 *                  type="integer",
 *                  description="The ID of the client that owns the shopping cart",
 *                  example=1
 *              ),
 *              @OA\Property(
 *                  property="order_details",
 *                  type="array",
 *                  description="The array of order details for the shopping cart",
 *                  @OA\Items(
 *                      type="object",
 *                      required={"product_id", "product_amount"},
 *                      @OA\Property(
 *                          property="product_id",
 *                          type="integer",
 *                          description="The ID of the product to be added to the shopping cart",
 *                          example=1
 *                      ),
 *                      @OA\Property(
 *                          property="product_amount",
 *                          type="integer",
 *                          description="The amount of the product to be added to the shopping cart",
 *                          example=2
 *                      )
 *                  ),
 *              ),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Shopping cart created successfully",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/ShoppingCartResource"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="message",
 *                  type="string",
 *                  description="The error message describing why the request was unprocessable"
 *              ),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  description="The validation errors",
 *                  additionalProperties={
 *                      "type": "array",
 *                      "items": {
 *                          "type": "string"
 *                      }
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Internal Server Error",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="message",
 *                  type="string",
 *                  description="The error message describing the internal server error"
 *              )
 *          )
 *      )
 * )
 */
    public function store(Request $request)
    {
        try {
            
            DB::beginTransaction();
            
            $validatedData = $request->validate(ShoppingCart::$rules);
            $shoppingCartData = [
                'total_price' => $validatedData['total_price'],
                'date' => $validatedData['date'],
                'client_id' => $validatedData['client_id'],
            ];
            $shoppingCart = ShoppingCart::create($shoppingCartData);
            
            $orderDetailsData = $validatedData['order_details'];
            foreach ($orderDetailsData as $orderDetailData) {
                $orderDetailValidatedData = Validator::make($orderDetailData, OrderDetail::$rules)->validated();
                
                //Check valid stock for the product
                if (!$this->validateProductAmount($orderDetailValidatedData)) {
                    throw new \Exception("Product amount is greater than product stock.");
                }

                //Update the new stock for the product
                $this->updateStock($orderDetailValidatedData);

                $orderDetail = new OrderDetail($orderDetailValidatedData);
                $shoppingCart->ordersDetail()->save($orderDetail);
            }
    
            DB::commit();
            return new ShoppingCartResource($shoppingCart);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    /**
     * Validates that the product sell is valid
     */
    private function validateProductAmount($orderDetailData){
        $isValid = true;
        $productAmount = $orderDetailData['product_amount'];
        $productStock = Product::findOrFail($orderDetailData['product_id'])->stock;

        return $productStock - $productAmount >= 0;
    }

    /**
     * Deducts the amount of product sold from the stock
     */
    private function updateStock($orderDetailData){
        $product = Product::findOrFail($orderDetailData['product_id']);
        $product->stock -= $orderDetailData['product_amount'];
        $product->save();
    }


/**
 * Retrieve client's shopping cart history.
 *
 * @OA\Get(
 *     path="/rest/shopping-carts/history/{email}",
 *     operationId="clientHistory",
 *     summary="Retrieve client's shopping cart history",
 *     description="Retrieves the shopping cart history for a specific client.",
 *     tags={"Shopping Carts"},
 *     @OA\Parameter(
 *         name="email",
 *         description="Client email",
 *         required=true,
 *         in="path",
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ShoppingCartResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */
    public function clientHistory(string $email)
    {
        $client = Client::where('email', $email)->first();

        $shoppingCarts = $client->shoppingCarts()->orderBy('date')->get();

        return $shoppingCarts;
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
