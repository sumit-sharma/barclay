@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Message</div>

                    <div class="card-body message-section">
                        {{-- chats section --}}
                        <div>
                            @foreach ($messages as $item)

                                <div class="post">
                                    <div class="user-block">
                                        <span class="username">
                                            <a href="#">{{ $item->sender->name }}</a>
                                        </span>
                                        <span class="float-right ">
                                            <span class="text-danger"><strong>
                                                    @if (is_null($item->receiver_id))
                                                        {{ 'Global' }}@else{{ $item->receiver->name }}@endif
                                                </strong></span>
                                            <a
                                                href="#">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</a>
                                        </span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>{{ $item->content }}</p>
                                </div>

                            @endforeach
                        </div>
                        {{-- comment post section --}}

                    </div>
                    <div class="card-footer">
                        <form class="form-horizontal" action="{{ route('message.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-3">
                                    <select class="form-control form-control-sm" name="receiver_id">
                                        <option value="">Global</option>
                                        @foreach ($users as $item)
                                            <option value="{{ encrypt($item->id) }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9">

                                    <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Response" name="content">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
