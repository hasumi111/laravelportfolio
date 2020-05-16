@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px; text-align:center;">

        <div class="stockConfirm" style="">

            <h1 style="font-size:1.2em; padding:24px 0px; font-weight:bold;">変更後の内容はこちらです。よろしいですか？</h1>
            <form action="editComplete" method="post">
            @csrf
            <div class="confirmField">
                
                @if($data['brand_id'] === '1')
                <p>ブランド名 : NIKE</p><br>
                @elseif($data['brand_id'] === '2')
                <p>ブランド名 : adidas</p><br>
                @elseif($data['brand_id'] === '3')
                <p>ブランド名 : Vans</p><br>
                @elseif($data['brand_id'] === '4')
                <p>ブランド名 : CONVERSE</p><br>
                @elseif($data['brand_id'] === '5')
                <p>ブランド名 : {{$data['otherBrand']}}</p><br>
                @else
                <p>選択できていません</p>
                @endif

                <p>商品名 : {{ $data['itemName'] }}</p><br>

                <p>画像</p>
                @if(isset($data['read_temp_path']))
                <img src="{{ $data['read_temp_path'] }}" style="width:80%"><br>
                @else
                <img src="{{ $data['oldImgpath'] }}" style="width:80%"><br>
                @endif

                <p>販売価格 : {{ $data['fee'] }}</p><br>

                <p>商品紹介文 : {{ $data['detail'] }}</p>

            </div>  
                <input class="button" type="submit" name="action" value="送信" style="margin:30px"/>
            </form>

        </div>

        </div>
    </div>
</div>
@endsection
