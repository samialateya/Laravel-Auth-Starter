{{--
/****************
	- this is a modal template to get user confirmation before doing any action
	- you have to pass the -modal_id, -message for user to read -button text and the -action of the form submition
	- you can also pass any author hidden input to be sent to the server as key => value array
*****************/
--}}
<!-- Modal -->
<div class="modal fade" id="{{$modal_id}}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- modal title -->
			<h4 class="text-center m-4">
				{{$message}}
			</h4>
			<form action="{{route($path)}}" method="post" class="d-flex justify-content-around">
				@csrf
				<!-- Check if we need to send some data with form -->
				@if(isset($data))
					@foreach ($data as $key => $record)
					<input type="hidden" name={{$record['key']}} value="{{$record['value']}}" />
					@endforeach
				@endif
				<!-- modal footer -->
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn {{ $btnClass }}">{{$confirmText}}</button>
				</div>
			</form>
		</div>
	</div>
</div>