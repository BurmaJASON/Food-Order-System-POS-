@extends('user.layout.master')


@section('content')
<div class=" col-6 offset-3 card">
    <h3 class="col-6 offset-4 mt-3">Get In Touch!</h3>
    <form class="row card-body" action="{{ route('user#createContact') }}" method="POST">
        @csrf

        <div class="form-group">
            <label  class="control-label mb-1">User Name</label>
            <input id="name" name="userName" type="text" class="form-control @error('userName')
            is-invalid
            @enderror" value="{{ old('userName') }}" placeholder="Enter Your Name...">
            @error('userName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label  class="control-label mb-1">Email</label>
            <input name="userEmail" type="email" class="form-control @error('userEmail')
            is-invalid
            @enderror" value="{{ old('userEmail') }}" placeholder="Enter Your Email...">
            @error('userEmail')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <textarea name="userMessage" class="form-control @error('userMessage')
            is-invalid
            @enderror" placeholder="Your message goes here...">{{ old('userMessage') }}</textarea>
            @error('userMessage')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <span>
            @if($errors->any())
                <a href="#name">
                    <p style="color: red;">{{$errors->first()}}</p>
                </a>
            @endif
        </span>

        <div class="col-3 offset-9 mb-3">
          <button class="btn btn-primary col-12" type="submit">Send</button>
        </div>

    </form>
</div>

@endsection

