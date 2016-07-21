@extends('layout')
@section('content')
        <div class="container">
            <div class="col-md-12">
            <h1>Deployment List</h1>
            <div class="table-responsive">
            	<table class="table">
            		<tr>
            			<th>ID</th>
            			<th>Revision</th>
            			<th>ChangeLog</th>
            			<th>Description</th>
            			<th>user</th>
            			<th>Timestamp</th>
            			<th>Actions</th>
            		</tr>
            		@foreach($deployments->deployments as $deployment)
            			<tr>
            				<td>{{ $deployment->id }}</td>
            				<td>{{ $deployment->revision }}</td>
            				<td>{{ $deployment->changelog }}</td>
            				<td>{{ $deployment->description }}</td>
            				<td>{{ $deployment->user }}</td>
            				<td>{{ $deployment->timestamp }}</td>
            				<td><a href="/deleteDeploy?id={{ $deployment->id }}" class="btn btn-danger"><span class="glyphicon glyphicon-delete"></span> Delete</a></td>
            			</tr>
            		@endforeach
            	</table>
            </div>
            </div>
        </div>
@stop
