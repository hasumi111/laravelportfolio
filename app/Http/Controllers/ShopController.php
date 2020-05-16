<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //トップページ閲覧処理
    public function index() 
    {
        $stocks = Stock::Paginate(9);
        return view('shop',['stocks' => $stocks ]);
    }

    //マイページ閲覧処理
    public function mypage() 
    {
        // 現在ログインしているユーザー情報の取得
        $user = Auth::user();

        // 現在ログインしているユーザーのID取得
        $user_id = Auth::id();
        //データベース・stocksから合致するデータを取得
        $stocks = Stock::where('user_id',$user_id)->Paginate(9);
        return view('mypage',['stocks' => $stocks ]);
    }

    //商品追加フォーム画面への遷移
    public function stockInput() 
    {
        return view('stockAdd');
    }

    //追加商品確認画面への処理
    public function stockConfirm(Request $request) 
    {
        //バリデーションの実行
        $this->validate($request, Stock::$rules);

        $post_data      = $request->except('imagefile');
        $imagefile      = $request->file('imagefile');

        $temp_path      = $imagefile->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);
        
        $brand_id       = $post_data['brand'];
        $otherBrand     = $post_data['otherBrand'];

        switch($brand_id){
            case 1:
                $name = 'NIKE';
            break;
            case 2:
                $name = 'adidas';
            break;
            case 3:
                $name = 'Vans';
            break;
            case 4:
                $name = 'CONVERSE';
            break;
            case 5:
                $name = $otherBrand;
            break;
        }

        $detail       = $post_data['detail'];
        $fee          = $post_data['fee'];
        $itemName     = $post_data['itemName'];

        // 現在ログインしているユーザー情報の取得
        $user = Auth::user();
        // 現在ログインしているユーザーのID取得
        $user_id = Auth::id();
        
        //$dataに各データを格納
        $data = array(
            'name'           => $name,
            'otherBrand'     => $otherBrand,
            'itemName'       => $itemName,
            'detail'         => $detail,
            'fee'            => $fee,
            'temp_path'      => $temp_path,
            'read_temp_path' => $read_temp_path,
            'brand_id'       => $brand_id,
            'user_id'        => $user_id,
        );

        //sessionにデータを一時保管
        $request->session()->put('data', $data);

        return view('stockConfirm',['data' => $data ]);
    }

    //追加情報をDBに登録
    public function stockComplete(Request $request)
    {
        $data = $request->session()->get('data');
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];

        $filename = str_replace('public/temp/', '', $temp_path);
        //ファイル名は$temp_pathから"public/temp/"を除いたもの
        $storage_path = 'public/image/'.$filename;
        //画像を保存するパスは"public/image/xxx.jpeg"

        $request->session()->forget('data');

        Storage::move($temp_path, $storage_path);
        //Storageファサードのmoveメソッドで、第一引数->第二引数へファイルを移動

        /*--  ここまでが画像保存・ここからがDBへ保存  --*/

        $stock = new Stock;

        //画像読み込み用パス
        $imgpath = str_replace('public/', 'storage/', $storage_path);
        //商品一覧画面から画像を読み込むときのパスはstorage/productimage/xxx.jpeg"

        //DBに保存する形に変換
        $name     = $data['name'] . ' - ' . $data['itemName'];

        //テーブルに挿入
        $stock->name = $name;
        $stock->detail = $data['detail'];
        $stock->fee = $data['fee'];
        $stock->imgpath = $imgpath;
        $stock->brand_id = $data['brand_id'];
        $stock->user_id = $data['user_id'];
        $stock->save();

        return view('stockComplete');
    }

    //アイテムの詳細＆処理選択画面
    public function actSelect(Request $request)
    {
        $item = Stock::find($request->stock_id);
        $data = [ 'item' => $item ];
        return view('actSelect',$data);
    }
    
    //削除するアイテムの選択画面処理
    public function delSelect() 
    {
        // 現在ログインしているユーザー情報の取得
        $user = Auth::user();

        // 現在ログインしているユーザーのID取得
        $user_id = Auth::id();
        //データベース・stocksから合致するデータを取得
        $stocks = Stock::where('user_id',$user_id)->Paginate(9);
        return view('delSelect',['stocks' => $stocks ]);
    }
    
    //削除するアイテムの確認画面処理
    public function delConfirm(Request $request) 
    {
        $item = Stock::find($request->stock_id);
        $data = [ 'item' => $item ];
        return view('delConfirm',$data);
    }

    //アイテムの削除を実行
    public function delComplete(Request $request) 
    {
        Stock::find($request->stock_id)->delete();
        return view('delComplete');
    }

    //編集するアイテムの選択画面処理
    public function editSelect() 
    {
        // 現在ログインしているユーザー情報の取得
        $user = Auth::user();

        // 現在ログインしているユーザーのID取得
        $user_id = Auth::id();
        //データベース・stocksから合致するデータを取得
        $stocks = Stock::where('user_id',$user_id)->Paginate(9);
        return view('editSelect',['stocks' => $stocks ]);
    }

    //編集内容の入力画面
    public function editInput(Request $request) 
    {
        $item = Stock::find($request->stock_id);
        $data = [ 'item' => $item ];
        return view('editInput',$data);
    }

        //追加商品確認画面への処理
    public function editConfirm(Request $request) 
    {

        $post_data      = $request->except('imagefile');
        $imagefile      = $request->file('imagefile');
        $oldImgpath     = $post_data['oldImgpath'];
        
        $id             = $post_data['id'];
        $brand_id       = $post_data['brand'];
        $otherBrand     = $post_data['otherBrand'];

        switch($brand_id){
            case 1:
                $name = 'NIKE';
            break;
            case 2:
                $name = 'adidas';
            break;
            case 3:
                $name = 'Vans';
            break;
            case 4:
                $name = 'CONVERSE';
            break;
            case 5:
                $name = $otherBrand;
            break;
        }

        $detail       = $post_data['detail'];
        $fee          = $post_data['fee'];
        $itemName     = $post_data['itemName'];

        if(!empty($imagefile)){
            $temp_path      = $imagefile->store('public/temp');
            $read_temp_path = str_replace('public/', 'storage/', $temp_path); 
            
            //$dataに各データを格納
            $data = array(
                'id'             => $id,
                'name'           => $name,
                'otherBrand'     => $otherBrand,
                'itemName'       => $itemName,
                'detail'         => $detail,
                'fee'            => $fee,
                'temp_path'      => $temp_path,
                'read_temp_path' => $read_temp_path,
                'brand_id'       => $brand_id,
            );
        }else{
            //$dataに各データを格納
            $data = array(
                'id'             => $id,
                'name'           => $name,
                'otherBrand'     => $otherBrand,
                'itemName'       => $itemName,
                'detail'         => $detail,
                'fee'            => $fee,
                'oldImgpath'     => $oldImgpath,
                'brand_id'       => $brand_id,
            );
        }

        //sessionにデータを一時保管
        $request->session()->put('data', $data);

        return view('editConfirm',['data' => $data ]);
    }

    //編集情報をDBに反映
    public function editComplete(Request $request)
    {
        $data = $request->session()->get('data');

        if(isset($data['temp_path'])){

            $temp_path = $data['temp_path'];
            $read_temp_path = $data['read_temp_path'];
    
            $filename = str_replace('public/temp/', '', $temp_path);
            //ファイル名は$temp_pathから"public/temp/"を除いたもの
            $storage_path = 'public/image/'.$filename;
            //画像を保存するパスは"public/image/xxx.jpeg"
            $request->session()->forget('data');

            Storage::move($temp_path, $storage_path);
            //Storageファサードのmoveメソッドで、第一引数->第二引数へファイルを移動

            /*--  ここまでが画像保存・ここからがDBへ保存  --*/

            $stock = Stock::find($data['id']);

            //画像読み込み用パス
            $imgpath = str_replace('public/', 'storage/', $storage_path);
            //商品一覧画面から画像を読み込むときのパスはstorage/productimage/xxx.jpeg"

            //DBに保存する形に変換
            $name     = $data['name'] . ' - ' . $data['itemName'];

            //テーブルに挿入
            $stock->name = $name;
            $stock->detail = $data['detail'];
            $stock->fee = $data['fee'];
            $stock->imgpath = $imgpath;
            $stock->brand_id = $data['brand_id'];
            $stock->save();

        }else{

            $stock = Stock::find($data['id']);

            //DBに保存する形に変換
            $name     = $data['name'] . ' - ' . $data['itemName'];

            //テーブルに挿入
            $stock->name = $name;
            $stock->detail = $data['detail'];
            $stock->fee = $data['fee'];
            $stock->brand_id = $data['brand_id'];
            $stock->save();

        }
        return view('editComplete');
    }
    
    //ブランド別表示処理
    public function brandSelect(Request $request)
    {
        $stocks = Stock::where('brand_id',$request->brand_id)->Paginate(9);
        return view('shop',['stocks' => $stocks ]);
    }

    //キーワード検索機能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
 
        $query = Stock::query();
        $query->where('name', 'LIKE', "%{$keyword}%");
        $stocks = $query->Paginate(9);
 
        return view('shop', ['stocks' => $stocks]);
    }

    //商品詳細ページへの処理
    public function stockDetail(Request $request)
    {
        $item = Stock::find($request->stock_id);
        $data = [ 'item' => $item ];
        return view('detail',$data);
    }

    //カート閲覧処理
    public function myCart( Cart $cart ) 
    {
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    //カートに商品追加の処理
    public function addMycart(Request $request,Cart $cart)
    {
        //カートに追加の処理
        $stock_id=$request->stock_id;
        $message = $cart->addCart($stock_id);
        //追加後の情報を取得
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

    //カートから商品削除の処理
    public function deleteCart(Request $request,Cart $cart)
    {
        //カートから削除の処理
        $stock_id=$request->stock_id;
        $message = $cart->deleteCart($stock_id);
        //削除後の情報を取得
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

    //商品購入&カートから商品削除の処理
    public function checkout(Cart $cart)
    {
        $checkout_info = $cart->checkoutCart();   
        return view('checkout');
    }
 
}
