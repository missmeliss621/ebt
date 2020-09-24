@extends('layouts.master')

@include('partials.navbar')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12 call-to-action">
            <div class="form-container edit-user">
                {{ Form::open(array('action' => 'UsersController@editUser','class'=>'form-group')) }}
                    <div class="col-sm-4 col-lg-4">
                        <h1>Edit an existing user</h1>
                        <p>It starts with world class science to provide the only 100% human bone grafts
                            in the world with in-vivo verified osteoinductivity post-sterilization prior
                            to release for distribution.
                            We work strategically with our partners
                            to improve outcomes, reduce waste, and provide an unparalleled
                            level of quality assurance for their physicians, and more importantly
                            their patients. Contact us for an in-service today.</p>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            {{ Form::label('name', 'Name')}}
                            {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Enter Company Name')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('image_url', 'Image URL')}}
                            {{ Form::text('image_url', Input::old('image_url'), array('class'=>'form-control', 'placeholder'=>'Enter URL to facility logo')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('address', 'Address')}}
                            {{ Form::textarea('address', Input::old('address') , array('class'=>'form-control', 'placeholder'=>'Enter Company Address', "rows"=>"3"))}}
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Enter User Email'))}}
                        </div>

                        <div class="form-group">
                            {{ Form::label('username', 'Username')}}
                            {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Enter Username')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password')}}
                            {{ Form::text('password', Input::old('password'), array('input type'=> 'password', 'class'=>'form-control', 'placeholder'=>'Enter Password')) }}
                        </div>

                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop
