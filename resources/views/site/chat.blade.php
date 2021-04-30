@extends('layouts.main')

@section('content')
    <div class="chat-screen" id="chat-screen">

    </div>
    <div class="chat-input">
        <div class="row">
            <div class="col-10">
                <input type="text" name="chat" class="form-control" id="message">
            </div>
            <div class="col-2">
                <div type="submit" name="chat" class="form-control btn btn-success" onclick="send()">Enviar</div>
            </div>
        </div>
    </div>

    @csrf
@endsection

@section('script')
    <script>
        window.laravelEchoPort = '{{ env("LARAVEL_ECHO_PORT") }}';
    </script>
    <script src="//{{ request()->getHost() }}:{{ env("LARAVEL_ECHO_PORT") }}/socket.io/socket.io.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        var csrf = '{{csrf_token()}}';
        function send(){
            $.ajax({
                type: "POST",
                url: '{{url('chat/'.$code)}}',
                data: {"message":$("#message").val(), "_token":$("input[name='_token']").val()},
                success: function ($data){
                    $("#message").val("");
                }
            });
        }

        const userId= '{{auth()->id()}}';
        /*window.Echo.channel('public-message-channel').listen('.MessageEvent', (data)=>{
            $("#chat-notification").append('<div class="alert alert-warning">'+data.message+'</div>');
        });*/
        window.Echo.private('code.{{$code}}').listen('.MessageEvent', (data)=>{
            $("#chat-screen").append("<p><b>"+data.user+"</b> <span data-toggle=\"tooltip\" data-placement=\"top\" title=\""+data.datetime+"\">("+data.time+")</span>: "+data.message+"</p>");
        });
    </script>
@endsection