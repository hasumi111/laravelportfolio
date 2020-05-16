@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px; text-align:center;">

        <div class="addStock" style="">

            <h1 style="font-size:1.2em; padding:24px 0px; font-weight:bold;">編集したい箇所を書き換えてください</h1>
            <p>（ブランドと商品名は再度入力してください）</p>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group row" style="display:inline-flex; width:100%;">

                <form action="editConfirm" method="post" enctype="multipart/form-data" class="addStock-form" style="margin:0 auto; width:70%">
                @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">


                    <label for="brand" class=" col-form-label text-md-right">ブランド</label><br>
                    <div class="col-md-6" style="display:inline-flex">
                        <select class="form-control" id="brand" name="brand">
                            <option value="1">NIKE</option>
                            <option value="2">adidas</option>
                            <option value="3">Vans</option>
                            <option value="4">CONVERSE</option>
                            <option value="5">other(下のボックスに記入して下さい)</option>
                        </select>
                    </div>

                    <div style="margin-top:40px">
                        <label for="otherBrand" class=" col-form-label text-md-right">その他のブランド</label><br>
                        <input type="text" name="otherBrand" value="otherの場合は記入" id="otherBrand" style="width:40%;">
                    </div>

                    <div style="margin-top:40px">
                        <label for="itemName" class=" col-form-label text-md-right">商品名（ブランド名以降）</label><br>
                        <input type="text" name="itemName" value="" id="itemName" style="width:40%;">
                    </div>

                    <img src="{{$item->imgpath}}" alt="" style="width:40%; padding-top:40px;">
                    <input type="hidden" name="oldImgpath" value="{{ $item->imgpath }}">
                    
                    <div style="margin-top:40px">
                        画像<br>
                        <input type="file" name="imagefile"/><br>
                    </div>

                    <div style="margin-top:40px">
                        <label for="fee" class=" col-form-label text-md-right">販売価格</label><br>
                        <input type="text" name="fee" id="fee" value="{{$item->fee}}" style="width:40%;">
                    </div>

                    <div style="margin-top:40px">
                        <label for="detail" class=" col-form-label text-md-right">商品紹介文</label><br>
                        <textarea name="detail" id="detail" cols="45" rows="5">{{$item->detail}}</textarea>
                    </div>

                    <input type="submit" value="確認画面へ" class="button" style="margin-top:24px">   

                </form>
            </div>

        </div>

        </div>
    </div>
</div>
@endsection
