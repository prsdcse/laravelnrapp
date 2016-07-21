@extends('layout')

@section('content')
<div class="container">
	<div class="col-md-12">
	<h1>Create a deployment</h1>
	<span class="divider"></span>
		<form method="POST" action="/create/deployment">
			<div class="form-group">
				<label for="revision">Revision</label>
				<input type="text" class="form-control" name="revision" required />
			</div>
			<div class="form-group">
				<label for="changelog">Change Log</label>
				<input type="text" class="form-control" name="changelog" required />
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<input type="text" class="form-control" name="description" required />
			</div>
			<div class="form-group">
				<label for="user">User</label>
				<input type="text" class="form-control" name="user" required />
			</div>
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<button class="btn btn-primary pull-right" type="submit">Create Deployment</button>
		</form>
	</div>
</div>
@stop