@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="detail-page">
        <div class="mx-auto" style="max-width:1200px">

            <img src="{{$item->imgpath}}" alt="" class="detail" style="width:40%; padding-top:40px;">
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:4em; padding:40px 0px;">
            {{ $item->name }}</h1>

            <div class="detail-body text-center">
                <p style="font-size:15px; width:50%; margin:0 auto;">{{$item->detail}}</p>
                <p style="font-size:30px; font-weight:bold; color:red;">¥{{$item->fee}}</p>

                <div style="display:inline-flex; width:60%;">
                    <form style="margin:0 auto;" action="delConfirm" method="post">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $item->id }}">
                        <input type="submit" value="この商品を削除する" class="button">
                    </form>
                    
                    <form style="margin:0 auto;" action="editInput" method="post">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $item->id }}">
                        <input type="submit" value="この商品を編集する" class="button">
                    </form>
                </div>
            </div>

            <div class="text-center" style="padding:40px">
                <a href="/mypage" style="font-size:20px; margin-bottom:10px;">マイページトップ</a>
            </div>

        </div>
    </div>
</div>
@endsection
