<?php

namespace App\Http\Controllers;

use Cart;
use App\ProductType;
use App\Slide;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
//Pagination : https://laravel.com/docs/5.6/pagination
class PageController extends Controller
{
    public function getIndex() {
        //$name = Auth::user()->name;
       // print_r($name);die;
        $slide = Slide::all();
//        echo '<pre>' ;print_r($slide);
        $new_product = Product::where('new',1)->paginate(4);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0) ->paginate(8);
        //echo '<pre>';print_r($sanpham_khuyenmai);die;
      // echo '<pre>'; print_r($new_product);die;
        return view('page.trangchu',['slide'=>$slide,'new_product'=>$new_product,'sanpham_khuyenmai' => $sanpham_khuyenmai]);
    }

    public function getLoaiSp($type) {
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
       // echo '<pre> ';print_r($loai_sp);die;
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitiet(Request $request) {
        $sanpham = Product::where('id',$request->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);
        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }

    public function getLienHe(Request $request) {
        Validator::make($request->all(),[
            'your-name' => 'required',
            'your-email'     => 'required'
        ]);
        return view('page.lienhe');
    }

    public function getGioiThieu() {
        return view('page.gioithieu');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
    public function insert_contact (Request $request) {
        if($request->exists('submit')) {
            $this->validate($request,
                [
                    'your-name' => ['required'],
                    'your-email' => ['required', 'email'],
                    'your-subject' => 'required',
                    'your-message' => 'required'
                ],
                [
                    'your-email.required' => 'A Email is required',
                ]
            );
            $name = $request->input('your-name');
            $email = $request->input('your-email');
            $subject = $request->input('your-subject');
            $message = $request->input('your-message');
            $data = array(
                    'name'    => $name,
                    'email'   => $email,
                    'subject' => $subject,
                    'content' => $message
            );
            DB::table('contact')->insert($data);
            return redirect()->back()->with('message', 'Insert success!');

        }
        return redirect('/lien-he');
    }

    public function muahang($id) {
        $product_buy = DB::table('products')->where('id',$id) -> first();
        if($product_buy->promotion_price == 0) {
            $price = $product_buy->unit_price;
        } else {
            $price = $product_buy->promotion_price;
        }
        Cart::add(array('id'=>$id,'name'=>$product_buy->name,'quantity'=>1,'price'=>$price,'attributes' => array('img'=>$product_buy->image)));
        $content = Cart::getContent();
        return redirect('/gio-hang');
    }

    public function giohang() {
        $content = Cart::getContent();
        $total = Cart::getSubTotal();
       //echo '<pre>';  print_r($content);die;
        return view('page.cart',['content' => $content,'total' => $total]);
    }

    public function update_cart(Request $request) {


//        $qty = $request->input("quantity");
        $a = $request->input("product_id");
        $qty = $request->input("qty");
        $quantity = $request->input("quantity");
        for ($i = 0; $i < sizeof($a); $i++) {
            if ($qty[$i] != $quantity[$i]) {
              $f = $a[$i];
                Cart::update($f, array(
                             'quantity' => array(
                                 'relative' => false,
                                  'value' => $quantity[$i]
                ),
            ));
            }
        }
        return redirect('/gio-hang');
    }
    public function xoagiohang($id) {
        Cart::remove($id);
        return redirect('/gio-hang');
    }

}
