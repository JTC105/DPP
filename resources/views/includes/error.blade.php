@if (count($errors))

	<div class="form-group">
		<div class="alert alert-danger error-container">

				@foreach ($errors->all() as $error)

					<div class="error-label">{{ $error }}</div>
					<br>
				@endforeach

		</div>
	</div>

@endif
