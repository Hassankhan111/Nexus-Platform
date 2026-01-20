@extends('layout.main')
@section('title', 'Chats')
@section('main-content')

    <div class="chat-container d-flex">

        <!-- ========== LEFT SIDEBAR ========== -->
        <div class="chat-sidebar d-none d-md-block p-3">
            <div class="p-3 border-bottom">
                <h4 class="m-0 fw-bold">Conversations</h4>
            </div>


            <div id="allusers">
                <!---<div class="p-3 d-flex align-items-center border-bottom">
                            <img src="https://via.placeholder.com/45" class="rounded-circle me-2">
                            <div>
                                <strong class="user">Sarah Ali</strong><br>
                                <small class="text-offline">offline</small>
                            </div>
                        </div>-->
            </div>
        </div>

        <!-- ========== CHAT MAIN ========== -->
        <div class="chat-main m-4">

            <!-- HEADER -->
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-2">
                    <div>
                        <h6 class="mb-0 fw-bold user"> Sarah Ali</h6>
                        <small class="text-online">Offline</small>
                    </div>
                </div>
                <!-- vadeo and audio call buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <button class="audio btn btn-success btn-sm" id="audio-call"><i class="bi bi-telephone-fill"></i> Audio Call</button>
                    <button class="video btn btn-primary btn-sm" id="video-call"><i class="bi bi-camera-video-fill"></i> Video Call</button>
                </div>
            </div>

           <!-- VIDEO CALL SECTION -->
            <section class="video-call-container">
                <div class="video-streams">

                    <div class="local-video">
                        <video id="localVideo" autoplay muted playsinline></video>
                    </div>
                    <div class="remote-video">
                        <video id="remoteVideo" autoplay muted playsinline></video>
                    </div>
                </div>
                <div>
                    <button id="end-call-btn" class="call call-disconnect d-none">
                        <img src="/images/phone-disconnect.png" alt="">
                    </button>
                </div>
            </section>

            <!-- MESSAGES -->
            <div class="chat-messages" id="chat-container">
                <!--<div class="current-user text-end">
                                  <h5>sender message?</h5>
                                </div>
                            <div class="distance-user">
                                <h5>receiver message?</h5>
                            </div>-->

            </div>

            <!-- INPUT -->
            <div class="border-top m-4">
                <div class="input-group">
                    <input id="message" type="text" class="form-control" placeholder="Type a message...">
                    <button id="sendbtn" class="btn btn-primary">Send</button>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('scripts')

    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
    <script src="{{ asset('assets/js/chat.js') }}"></script>

@endpush