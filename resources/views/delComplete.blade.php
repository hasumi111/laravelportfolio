@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px;">
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:30px 0px;">
            商品の削除が完了しました</h1>

            <div style="text-align:center; padding:50px;">
                <div class="brand-btn " style="display:inline-flex">
                    <!-- 追加 -->
                    <form action="delSelect" class="brand-form">
                        @csrf
                        <input type="submit" value="続けて商品を削除" class="button">
                    </form>

                    <!-- マイページ -->
                    <form action="mypage"  class="brand-form">
                        @csrf
                        <input type="submit" value="Mypageトップへ" class="button">   
                    </form> 
                </div>
            </div>

        </div>
    </div>
</div>
@endsection