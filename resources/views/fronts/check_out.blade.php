@extends('layouts/app')
@csrf

@section('css')
<link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
{!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection


@section('content')
<div class="container">
    <checkout-table cart-data={!! json_encode($data) !!}></checkout-table>

    <form method="POST" action="/checkout">
        @csrf
        <div class="form-group">
            <label for="Recipient_name">收貨人姓名</label>
            <input type="text" class="form-control" id="Recipient_name" name="Recipient_name" placeholder="請輸入姓名"
                required>
        </div>
        <div class="form-group">
            <label for="Recipient_phone">收貨人電話</label>
            <input type="text" class="form-control" id="Recipient_phone" name="Recipient_phone"
                placeholder="ex:0912345678" required>
        </div>

        <div class="form-group">
            <label for="dealer_address">經銷商地址</label>
            <select required name="dealer_address" id="dealer_address" class="form-control">
                <option value="1">台中</option>
                <option value="2">台北</option>
                <option value="3">高雄</option>
            </select>
        </div>

        <div class="d-flex  justify-content-end">
            {!! ReCaptcha::htmlFormSnippet() !!}
        </div>
        <div class="d-flex  justify-content-end">

            <button class="btn btn-success">結帳去</button>
        </div>

    </form>

</div>

@endsection


@section('js')
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $('.btn.btn-success').click(function(){

        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha.val()=null) {
            alert('記得打勾勾')
        }
    })




</script>
@endsection
