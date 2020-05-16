@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">

            <div class="brand-select" style="text-align:center;">

                <h1 style="color:#555555; font-size:2em; padding:24px 0 0 0; font-weight:bold;">
                    削除したいアイテムを選択してください
                </h1>

                <form action="search" method="post" class="">
                    @csrf
                    <div class="search-box" style=" display:inline-flex; margin:15px; ">
                        <p><input type="text" name="keyword" class="search-btn"></p>
                        <p><input type="submit" value="search" class="submit-btn"></p>
                    </div>
                </form>
                
            </div>

            <div class="">

                <div class="d-flex flex-row flex-wrap">
                    @foreach($stocks as $stock)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 ">
                        <div class="item_box">
                            <img src="{{$stock->imgpath}}" alt="" class="incart" >
                            <br>
                            {{$stock->name}}  /  ¥{{$stock->fee}}

                            <form action="delConfirm" method="post">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                <input type="submit" value="削除する商品">
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center" style="width: 200px;margin: 20px auto;">
                {{ $stocks->links() }} 
                </div>

            </div>
        </div>
    </div>
</div>
@endsection