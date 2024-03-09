<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Specification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];

        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        $viewData = [];
        $viewData['title'] = 'Корзина - Anna Anna';
        $viewData['subtitle'] = 'Корзина покупок';
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, $id)
    {
        $products = $request->session()->get('products');
        $products[$id] = [
            'color' => $request->get('color'),
            'size' => $request->get('size'),
        ];
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get('products');

        $user = User::firstOrCreate([
            'phone' => $request->get('phone'),
        ], [
            'name' => $request->get('full_name'),
            'email' => $request->get('phone') . '@mail.ru',
            'password' => Hash::make($request->get('password')),
            'balance' => 0,
            'bonus' => 0,
        ]);

        if ($productsInSession) {
            $userId = $user->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $specification = Specification::where($productsInSession[$product->id])->first();

                if (empty($specification)) {
                    return redirect()->route('cart.index');
                }
                $item = new Item();
                $item->setPrice($specification->price);
                $item->setSpecificationId($specification->id);
                $item->setOrderId($order->id);
                $item->save();
                $total = $total + $specification->price;
            }

            $order->setTotal($total);
            $order->save();

            $newBalance = $user->getBalance() - $total;
            $user->setBalance($newBalance);
            $user->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData['title'] = 'Покупка - Anna Anna';
            $viewData['subtitle'] = 'Статус Покупки';
            $viewData['order'] = $order;

            return view('cart.purchase')->with('viewData', $viewData);
        }

        return redirect()->route('cart.index');
    }
}
