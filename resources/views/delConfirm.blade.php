@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px; text-align:center;">

        <div class="stockConfirm" style="padding:30px">

            <h1 style="font-size:1.2em; padding:24px 0px; font-weight:bold;">この商品を削除してよろしいですか？</h1>
            <form action="delComplete" method="post">
            @csrf
            <input type="hidden" name="stock_id" value="{{ $item->id }}">

            <div class="confirmField">
                <img src="{{$item->imgpath}}" alt="" class="delConimg" style="width:40%">
                <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:4em; padding:40px 0px;">
                {{ $item->name }}</h1>
                <div class="detail-body text-center">

                <p style="font-size:20px">{{$item->detail}}</p>
                <p style="font-size:30px; font-weight:bold;">¥{{$item->fee}}</p>
            </div>

            <input class="button" type="submit" name="action" value="削除する" style="margin:30px"/>
            </form>

        </div>

        </div>
    </div>
</div>
@endsection
