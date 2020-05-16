@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="detail-page">
        <div class="mx-auto" style="max-width:1200px">

            <img src="{{$item->imgpath}}" alt="" class="detail" >
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:4em; padding:40px 0px;">
            {{ $item->name }}</h1>
            <div class="detail-body text-center">

                <p style="font-size:20px">{{$item->detail}}</p>
                <p style="font-size:30px; font-weight:bold; color:red;">¥{{$item->fee}}</p>

                <form action="mycart" method="post">
                    @csrf
                    <input type="hidden" name="stock_id" value="{{ $item->id }}">
                    <input type="submit" value="IN CART" class="button">
                </form>
            </div>
            <a href="/" style="font-size:20px; margin-bottom:10px">TOP MENU</a>
            <br>

        </div>
    </div>
</div>
@endsection
