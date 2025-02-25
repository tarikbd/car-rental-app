@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to contact us!</p>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
@endsection