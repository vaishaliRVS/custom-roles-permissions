<!doctype html>
<html lang="en">
  <head>
  	<title>Roles and Permissions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('css/style.css')}}">

	</head>
	<body>
		
		@if (isset(Auth::user()->name))
			{{Auth::user()->name}}	
			<a href="{{ route('logout.custom') }}">Logout</a>
			<a href="{{ route('roles.list') }}">Roles</a>
			<a href="{{ route('permissions.list') }}">Permission</a>
			<a href="{{ route('users.index') }}">User</a>
			@else

		@endif
	