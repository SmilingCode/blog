<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea class="form-control" rows="3" placeholder="Let's talk some random thing..." name="content">{{ old('content') }}</textarea>
    <button type="submit" class="btn btn-primary pull-right">Publish</button>
</form>