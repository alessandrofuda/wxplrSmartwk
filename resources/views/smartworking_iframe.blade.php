@extends('layouts.app')

@push('e-where-js-libraries')
	<!--Vic_B2C chatbot-->
	<script src="https://www.ew9102bot.it/lib/signalr/signalr.js"></script>
	<script src="https://www.ew9102bot.it/js/ewbot.js"></script> 
@endpush

@section('content')
	<div id="smartwork-demo" class="container-fluid" style="min-height: 5px; height: auto; background-image: none;">
	    <div class="row justify-content-center">
	        <div class="col-lg-6 card-container" style="position: relative; top: auto;">
	            <div class="card">
	                <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}
	                        </div>
	                    @endif
	                    <div class="title"></div>
	                    <div class="demo-container">
	                        <div id="chat-wrapper" class="body"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection


@push('scripts')
	<script>
		function resizeIframe(obj) {
			obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		}

		//ricerca id sessione nella query string GET (SOLO PER SVILUPPO)
		function queryParameter(name){
			var parameters = window.location.search.substring(1);
			var properties = parameters.split("&");
			var result = null;
			properties.forEach(function(p){
				var tmp = p.split("=");
				if(tmp[0] == name){
					result = tmp[1];
				}
			});
			
			return result;
		}

		if(CheckCompatibility()){
			var chat = new Ewbot();
			chat.Init({
				hubendpoint : 'https://www.ew9102bot.it/Ewbot',
				chat_image_welcome : '{{asset('custom/chat-vic/logo_apri_chat.png')}}',
				chat_image_header_opened : '{{asset('custom/chat-vic/header_chat.png')}}',
				chat_image_header_closed : '{{asset('custom/chat-vic/logo_chat_aperta.png')}}',			
				chat_send : '{{asset('custom/chat-vic/chat_send_msg.png')}}',
				css_headers : '{{asset('custom/chat-vic/chat_CT.css')}}',
				flow: '{{ $flow_name }}',
				disable_signalR: false, 
				// session_id: queryParameter("session_id"),
				session_id: '{{ $session_id }}',
				customer_key: '{{ config('services.ewhere.customer_key') }}',
				parameters: 
				{ 
					base_address: '{{ url('/') }}', 
					user_id: '',  {{-- Auth::user()->id --}}
					chat_object_name: 'chat',
					current_page: window.location.href
				}
			});
			chat.InitializeContent();
		}
	</script>

	<!--customization -->
	<script>
		$(document).ready(function() {
			//background fix
			$('body').css('background-color', 'transparent');

			$('#chat-with-me').detach().appendTo('#chat-wrapper');
			$('#chat-main').detach().appendTo('#chat-wrapper');
			$('#chat-with-me').trigger('click');
			$('#chatTextBox').attr('placeholder', 'Scrivi qui ...');

			setTimeout(function(){
				$('#chatMessageList .chat-message-container.darker img').attr('src', '/frontend/images/wexplore-logo-tondo-plain.png');
			}, 1000);
			$('#chatSendButton').on('click', function() {
				setTimeout(function(){
					$('#chatMessageList .chat-message-container.darker img').attr('src', '/frontend/images/wexplore-logo-tondo-plain.png');
				}, 700);
			});
			$('#chatTextBox').keypress(function(event){
			    var keycode = (event.keyCode ? event.keyCode : event.which);
			    if(keycode == '13'){
			        setTimeout(function(){
						$('#chatMessageList .chat-message-container.darker img').attr('src', '/frontend/images/wexplore-logo-tondo-plain.png');
					}, 700); 
			    }
			});
		});
	</script>
	
@endpush