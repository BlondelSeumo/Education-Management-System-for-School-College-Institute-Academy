 @if(session()->has('message-success'))
 <div class="alert alert-success mb-25" role="alert">
 	{{ session()->get('message-success') }}
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 @elseif(session()->has('message-danger'))
 <div class="alert alert-danger">
 	{{ session()->get('message-danger') }}
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 @endif


 @if(session()->has('message-success-delete'))
 <div class="alert alert-success" role="alert">
 	{{ session()->get('message-success-delete') }}
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 @elseif(session()->has('message-danger-delete'))
 <div class="alert alert-danger">
 	{{ session()->get('message-danger-delete') }}
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 		<span aria-hidden="true">&times;</span>
 	</button>
 </div>
 @endif