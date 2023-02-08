<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container-fluid">
        <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
            <div class="card">
                <div class="p-3 px-lg-4 border-bottom">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <h5 class="font-size-16 mb-1 text-truncate"><a href="#" class="text-dark">Public
                                    Chat</a></h5>
                            <p class="text-muted text-truncate mb-0"><i class="uil uil-users-alt me-1"></i> 12
                                Members Online</p>
                        </div>
                        <div class="col-md-8 col-6">
                            <ul class="list-inline user-chat-nav text-end mb-0">
                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="uil uil-search"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                            <form class="p-2">
                                                <div>
                                                    <input type="text" class="form-control rounded"
                                                        placeholder="Search...">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="uil uil-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Profile</a>
                                            <a class="dropdown-item" href="#">Archive</a>
                                            <a class="dropdown-item" href="#">Muted</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="chat-conversation py-3" style="height: 81vh">
                        <ul class="list-unstyled mb-0 chat-conversation-message px-3" data-simplebar>
                            @forelse ($chats as $chat)
                                <li id="{{ $chat['id'] }}"
                                    class="{{ $chat['id_user'] == Cookie::get('user_id') ? 'right' : '' }}">
                                    <div class="conversation-list">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <h5 class="font-size-14 conversation-name"><a href="#"
                                                        class="text-dark">{{ $chat['id_user'] }}</a>
                                                    <span
                                                        class="d-inline-block font-size-12 text-muted ms-2">{{ $chat['message_time'] }}</span>
                                                </h5>
                                                <p class="mb-0">
                                                    {{ $chat['message'] }}
                                                </p>
                                            </div>
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <div class="mx-auto col-4">
                                    <div class="alert alert-danger text-center font-size-12" role="alert">
                                        public chats does't have an encryption message! please becarefull about your
                                        privacy
                                    </div>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="p-3 chat-input-section">
                    <div class="row">
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" autocomplete="false" id="message-input" name="message-input"
                                    class="form-control chat-input rounded" placeholder="Enter Message...">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" id="message-button" name="message-button"
                                class="btn btn-primary chat-send w-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block me-2">Send</span> <i
                                    class="mdi mdi-send float-end"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var tempUser = `{{ Cookie::get('user_id') }}`;
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('baf42a703a7f85eef87a', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('message-created');
        channel.bind('message-event', function(data) {
            console.log(tempUser != "" && tempUser != data.message.id_user)
            if (tempUser != "") {
                if (tempUser != data.message.id_user) {
                    html =
                        `<li><div class="conversation-list"><div class="ctext-wrap"><div class="ctext-wrap-content"><h5 class="font-size-14 conversation-name"><a href="#" class="text-dark"> ${data.message.id_user} </a><span class="d-inline-block font-size-12 text-muted ms-2"> ${data.message.message_time} </span></h5><p class="mb-0">${data.message.message}</p></div><div class="dropdown align-self-start"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="#">Copy</a><a class="dropdown-item" href="#">Save</a><a class="dropdown-item" href="#">Forward</a><a class="dropdown-item" href="#">Delete</a></div></div></div></div></li>`;
                    $(".simplebar-content").append(html);
                    $('div.simplebar-content-wrapper').animate({
                        scrollTop: $('div.simplebar-content-wrapper').prop("scrollHeight")
                    });
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('div.simplebar-content-wrapper').animate({
                scrollTop: $('div.simplebar-content-wrapper').prop("scrollHeight")
            });
            $(document).keypress(function(e) {
                if (e.keyCode == 13) {
                    displayAndStoreNewChat($("#message-input").val());
                }
            });
        });

        function displayAndStoreNewChat(messageValue) {
            if (messageValue != "") {
                $.ajax({
                    type: "POST",
                    url: `{{ route('chat.store') }}`,
                    data: {
                        _token: `{{ csrf_token() }}`,
                        message: messageValue
                    },
                    dataType: "JSON",
                    success: function(response) {
                        let time = new Date();
                        if (time.getMinutes().toString().length == 1) {
                            time = `${time.getHours()}:0${time.getMinutes()}`;
                        } else {
                            time = `${time.getHours()}:${time.getMinutes()}`;
                        }
                        html =
                            `<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="ctext-wrap-content"><h5 class="font-size-14 conversation-name"><a href="#" class="text-dark"> ${response.id_user} </a><span class="d-inline-block font-size-12 text-muted ms-2"> ${time} </span></h5><p class="mb-0">${messageValue}</p></div><div class="dropdown align-self-start"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="#">Copy</a><a class="dropdown-item" href="#">Save</a><a class="dropdown-item" href="#">Forward</a><a class="dropdown-item" href="#">Delete</a></div></div></div></div></li>`;
                        $(".simplebar-content").append(html);
                        $('div.simplebar-content-wrapper').animate({
                            scrollTop: $('div.simplebar-content-wrapper').prop("scrollHeight")
                        });
                        $("#message-input").val('')
                    },
                    error: function(response) {
                        $("#message-input").val('')
                    }
                });
            }
        }
    </script>
</body>

</html>
