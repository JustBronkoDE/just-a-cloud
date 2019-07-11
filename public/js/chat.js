// Chatbox javascript


// Scroll to the bottom of the active-chat
if ($('.chat.active-chat')[0] !== undefined) {
    $('.chat.active-chat').scrollTop($('.chat.active-chat')[0].scrollHeight);
}

// Initialize chat window function
function initChat() {
    $('.left .person').mousedown(function(){
        if ($(this).hasClass('active')) {
            var findChat = 0;
            var personName = ''
            $('.right .top .name').html(personName);
            $('.chat').removeClass('active-chat');
            $(this).removeClass('active');
            $('.chat[data-chat = ' + findChat + ']').addClass('active-chat');
            $('#chatBox').removeClass('hasActive');
        } else {
            var findChat = $(this).attr('data-chat');
            var personName = $(this).find('.name').text();
            $('.right .top .name').html(personName);
            $('.chat').removeClass('active-chat');
            $('.left .person').removeClass('active');
            $(this).addClass('active');
            $('.chat[data-chat = ' + findChat + ']').addClass('active-chat');
            $('input#chat').val(findChat);
            try {
                var height = $('.chat.active-chat')[0].scrollHeight;
            $('.chat.active-chat').scrollTop(height);
            } catch(e) {
                //do nothin
            }
            $('#chatBox').addClass('hasActive');
        }
    });
}

// Append click event to chat button
$('#hide-button').click(function() {
    $('.chatbox').toggleClass('hide-chat');
    $('.chatbox').toggleClass('show-chats');
});

// New Chat
function newChat(chatPartner) {

    $.ajax({
        type: "POST",
        url: "/chats/new/chat",
        data: {chatPartner: chatPartner},
        success: function(e) {

        }
    });
    $('#chatUsersList').empty();
    $('#chatUsersList').append('<li><a disabled style="color:#e7e7e7;">no user found</a></li>');
    $('#chatUsersSearch').val("");
}

$(function() {

    // Append keypress event to enter-key of chat input to send message
    $("#chatMessage").bind("keypress", function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);

        if (code === 13) {
                e.preventDefault();
                newMessage();
        }
    });

    // Append click event to submit input of chat to send message
    $('#chatSubmit').click(function(e) {
        newMessage();
    });

    // New Message
    function newMessage() {
        var message = $('input#chatMessage').val();
        var chat = $('input#chat').val();
        var date = $('input#chatDate').val();

        $.ajax({
            type: "POST",
            url: "/chats/new/message",
            data: {message: message, chat:chat, date:date},
            success: function(e) {
                $('input#chatMessage').val('');
            }
        });
        return false;
    };

    // Users dropdown search
    $('#chatUsersSearch').keyup(function(e) {

        var searchValue = $('#chatUsersSearch').val();
        $('#chatUsersList').empty();

        if (searchValue !== "") {
            $.ajax({
                type: "POST",
                url: "/chats/users/search",
                data: {search_string:searchValue},
                success: function(users) {
                    if (Object.keys(users).length) {
                        for (var user_id in users) {
                            if (users.hasOwnProperty(user_id)) {
                                $('#chatUsersList').append('<li><a onclick="newChat(' + user_id + ')">' + users[user_id] + '</a></li>');
                            }
                        }
                    } else {
                        $('#chatUsersList').append('<li><a disabled style="color:#e7e7e7;">no user found</a></li>');
                    }
                    
                }
            });
        } else {
            
            $('#chatUsersList').append('<li><a disabled style="color:#e7e7e7;">no user found</a></li>');
        }
    });
});

//Chat update loop
function updateChat() {

    var chatLastUpdate = $('#chatBox').attr('data-lastChatUpdate');

    $.ajax({
        type: "POST",
        data: {lastUpdate: chatLastUpdate},
        url: "/chats/updates",
        success: function(response) {
            chats = response['chats'];;
            messages = response['messages']; 
            auth_user = response['user'];
            if(chats.length) {
                for(var i = 0, length1 = chats.length; i < 1; i++) {

                    var memberIndex;

                    for(var i = 0; i < chats[i].users.length; i++) {
                        if (chats.users[i].id !== auth_user) {
                            memberIndex = i;
                        }
                    }

                    var chat = '<li class="person" data-chat="' + chats[i].id + '">';
                    chat += '<img src="' + chats[i].users[memberIndex].profile_pic + '" alt="">';
                    chat += '<span class="name">' + chats[i].users[memberIndex].name + '</span>';
                    chat += '<span class="time">-:-</span>';
                    chat += '<span class="preview"> New Chat... </span>';
                    chat += '</li>'

                    $('#peopleBox').append(chat);

                    var lastChatFrom = new Date(chats[i].created_at.replace(/\s/, 'T'));

                    $('#chatBox').attr('data-lastChatUpdate', 1 + (lastChatFrom / 1000));

                    var chat = '<div class="chat" data-chat="' + chats[i].id + '"><div class="conversation-start"><span>Today</span></div></div>';

                    $('#chattingBox').append(chat);

                    initChat();
                }
                
            }

            if(messages.length) {
                for(var i = 0, length1 = messages.length; i < 1; i++){
                    if (messages[i].user_id === auth_user) {
                        var message = $('<div class="bubble me">' + messages[i].content + '</div>')[0];    
                    } else {
                        var message = $('<div class="bubble you">' + messages[i].content + '</div>')[0];
                    }
                    
                    $('.chat[data-chat=' + messages[i].chat_id + ']')[0].append(message);
                    var lastMessageFrom = new Date(messages[i].created_at.replace(/\s/, 'T'));
                    $('.person[data-chat=' + messages[i].chat_id + '] .time').html(lastMessageFrom.getHours() + ':' + lastMessageFrom.getMinutes());
                    $('.person[data-chat=' + messages[i].chat_id + '] .preview').html(messages[i].content)

                    $('#chatBox').attr('data-lastChatUpdate', 1 + (lastMessageFrom / 1000));

                    var height = $('.chat.active-chat')[0].scrollHeight;
                    $('.chat.active-chat').scrollTop(height);
                }
            } else {
                //no new messages
            }      
        }
    });
    setTimeout(function() {updateChat()}, 1000);
}

// Init chat
initChat();

// Start observer
if ($('#chatBox')) {
    updateChat();
}


