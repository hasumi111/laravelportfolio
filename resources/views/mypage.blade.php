@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">

            <div class="brand-select" style="text-align:center;">

                <h1 style="color:#555555; font-size:2em; padding:24px 0 0 0; font-weight:bold;">My Page</h1>

                <form action="search" method="post" class="">
                    @csrf
                    <div class="search-box" style=" display:inline-flex; margin:15px; ">
                        <p><input type="text" name="keyword" class="search-btn"></p>
                        <p><input type="submit" value="search" class="submit-btn"></p>
                    </div>
                </form>

                <div class="brand-btn " style="display:inline-flex">
                    <!-- 追加 -->
                    <form action="stockAdd" class="brand-form">
                        @csrf
                        <input type="submit" value="追加" class="button">
                    </form>

                    <!-- 編集 -->
                    <form action="editSelect" class="brand-form">
                        @csrf
                        <input type="submit" value="編集" class="button">   
                    </form>
                    
                    <!-- 削除 -->
                    <form action="delSelect" class="brand-form">
                        @csrf
                        <input type="submit" value="削除" class="button">
                    </form>
                </div>
                
            </div>

            <div class="">

                <div class="d-flex flex-row flex-wrap">

                    @foreach($stocks as $stock)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 ">
                        <div class="item_box">
                            <img src="{{$stock->imgpath}}" alt="" class="incart" >
                            <br>
                            {{$stock->name}}  /  ¥{{$stock->fee}}

                            <form action="actSelect" method="post">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                <input type="submit" value="商品詳細">
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