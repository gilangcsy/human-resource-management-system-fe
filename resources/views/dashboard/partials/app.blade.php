<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Blank Page &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">

    @yield('css')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('dashboard.partials.navbar')
            @include('dashboard.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>

    @yield('js')

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>


{{-- <script src="http://localhost:3000/socket.io/socket.io.js"></script>


<script>
    const socket = io("http://localhost:3000");
    const previewMessages = document.querySelector('#preview-messages');
	const containerForm = document.querySelector('#container-form');
    const form = document.getElementById('chat-form');

	UserId = document.getElementById("UserId").value;

	$(document).on("click","#form-submit",function(e) {
		e.preventDefault();
		socket.emit('send message', JSON.stringify({
    		id: '_' + Math.random().toString(36).substr(2, 9),
        	text: document.querySelector('#messageText').value,
        	UserId: UserId.toString(),
			ToUserId: document.getElementById("ToUserId").value.toString(),
			isReaded: '1',
			groupId: document.getElementById("groupId").value.toString()
    	}));
		document.getElementById('chat-form').reset();
	});

	function getPreviewMessage() {
		socket.emit('preview message', JSON.stringify({
            UserId: UserId,
			ToUserId: document.getElementById("ToUserId").value.toString(),
        }));
	}

	function createPreviewMessage(msg) {
		
        let li = document.createElement('li');
        let img = document.createElement('img');


        li.className = `media`;

		if(msg.UserId == UserId) {
			fetch(`http://localhost:3000/api/v1/users/${msg.ToUserId}`)
				.then(res => {
					return res.json();
				})
				.then( (json) => {
					li.innerHTML = `
					<a onclick="detailMessage('${json.data.id}', '${msg.groupId}')">
					<img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png">
					<div class="media-body">
                        <div class="mt-0 mb-1 font-weight-bold">${json.data.fullName}</div>
                        <div class="text-small text-truncate font-600-bold" style="max-width:150px;">${msg.text}</div>
                    </div>
			</a>
			`
				})
			} else {
				fetch(`http://localhost:3000/api/v1/users/${msg.UserId}`)
				.then(res => {
					return res.json();
				})
				.then( (json) => {
					li.innerHTML = `
					<a onclick="detailMessage('${json.data.id}', '${msg.groupId}')">
						<img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png">
						<div class="media-body">
                        	<div class="mt-0 mb-1 font-weight-bold">${json.data.fullName}</div>
                        	<div class="text-small text-truncate font-600-bold" style="max-width:150px;">
								${msg.text}
							</div>
                		</div>
					</a>
				`
				})
			}
        previewMessages.appendChild(li);
    }

	function createPreviewMessages(msgs) {
        msgs.forEach(createPreviewMessage);
    }

	fetch(`http://localhost:3000/api/message/previews/${UserId}`)
        .then(res => res.json())
        .then(createPreviewMessages);

		socket.on('preview message', function (msgs) {
        previewMessages.innerHTML = '';
        createPreviewMessages(msgs);
    });

	function createFormMessage() {
		let form = document.createElement('form');

		form.setAttribute('id', 'chat-form');
		form.innerHTML = `
			<input id="messageText" type="text" class="form-control" placeholder="Type a message" required>
            <button class="btn btn-primary" id="form-submit">
				<i class="far fa-paper-plane"></i>
            </button>
		`
        containerForm.appendChild(form);
    }

	function detailMessage(ToUserId, groupId) {
		document.getElementById("ToUserId").value = ToUserId.toString();
		document.getElementById("groupId").value = groupId.toString();

		let mychatbox2 = document.getElementById("mychatbox2");
    	const messages = document.querySelector('#chat-content');
		messages.innerHTML = ``;
		document.getElementById("mychatbox2").style = "block";

		function createMessage(msg) {
        	let div = document.createElement('div');

        	div.className = `chat-item ${msg.UserId == document.getElementById("UserId").value ? 'chat-right' : 'chat-left'}`;
        	div.innerHTML = `
				<img src="../dist/img/avatar/avatar-2.png">
				<div class="chat-details">
					<div class="chat-text">
						${msg.text}
					</div>
					<div class="chat-time">09:09</div>
				</div>
			`
        	messages.appendChild(div);
			div.scrollIntoView(true);
    	}

    	function createMessages(msgs) {
        	msgs.forEach(createMessage);
    	}

		fetch(`http://localhost:3000/api/message/detail/${ToUserId}/${UserId}?isReaded=1`)
        	.then(res => res.json())
        	.then(createMessages);



		function createUnreadedBarrier() {
        	let div = document.createElement('div');

        	div.innerHTML = `
				Unreaded Messages
			`
        	messages.appendChild(div);
    	}

    	function createUnreadedMessages(msgs) {
			if(msgs != '') {
				createUnreadedBarrier();
			}
        	msgs.forEach(createUnreadedMessage);
    	}

		fetch(`http://localhost:3000/api/message/detail/${ToUserId}/${UserId}?isReaded=0`)
        	.then(res => res.json())
        	.then(createUnreadedMessages);

		
		function createUnreadedMessage(msg) {
        	let div = document.createElement('div');

        	div.className = `chat-item ${msg.UserId == document.getElementById("UserId").value ? 'chat-right' : 'chat-left'}`;
        	div.innerHTML = `
				<img src="../dist/img/avatar/avatar-2.png">
				<div class="chat-details">
					<div class="chat-text">
						${msg.text}
					</div>
					<div class="chat-time">09:09</div>
				</div>
			`
        	messages.appendChild(div);
    	}
		containerForm.innerHTML = '';
		createFormMessage();

		socket.on('chat message', function (msgs) {

			let roomChat;
			for(let i = 0; i < msgs.length; i++) {
				let obj = msgs[i];
				roomChat = obj.groupId;
			}
			alert(groupId);
			if(roomChat == groupId) {
				alert('ok')
				messages.innerHTML = '';
				createMessages(msgs);
			}

			getPreviewMessage();
		});
	}

	socket.on('chat message', function (msgs) {
		getPreviewMessage();
    });


	getPreviewMessage();
	socket.emit('addUser', UserId);
	socket.on('getUsers', users => {
		console.log(users);
	});

</script> --}}

</body>

</html>
