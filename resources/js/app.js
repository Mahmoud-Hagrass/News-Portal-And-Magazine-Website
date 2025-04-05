import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// users
if(role == "users"){
    window.Echo.private('users.' + id).notification((event) => {
        console.log(event);
        $('#push-notification').prepend(`<div class="dropdown-item d-flex justify-content-between align-items-center">
            <a href="${event.link}?notify=${event.id}" class="dropdown-item"><i class="fa fa-eye"></i>New Post Comment : ${event.post_title.substring(0 , 14)}</a>
            </div>`) ; 
        notification_count = Number($('#count-notification').text()) ; 
        notification_count++ ; 
        $('#count-notification').text(notification_count) ; 
    }) ;    
}

// admins
if(role == "admins"){
    window.Echo.private('admins.'+id).notification((event) => {
        console.log(event);
        if(event.type == "NewContactAdminNotify"){
                $('#notification_admin_push').prepend(`<a class="dropdown-item d-flex align-items-center" href="${ event.link }?notify_admin=${ event.id }">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${event.contact_created_at}</div>
                        <span class="font-weight-bold">${event.contact_subject}</span>
                    </div>
                </a>`) ; 
                notification_count = Number($('#notifications_count').text()) ; 
                notification_count++ ; 
                $('#notifications_count').text(notification_count) ; 
           }
        if(event.type == "NotifyAdminForNewComment"){
                $('#notification_admin_push').prepend(`<a class="dropdown-item d-flex align-items-center" href="${ event.link }?notify_admin=${ event.id }">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${event.created_at}</div>
                        <span class="font-weight-bold">You have a new comment in post: ${event.post_title.substring(0 , 15)}</span>
                    </div>
                </a>`) ; 
                notification_count = Number($('#notifications_count').text()) ; 
                notification_count++ ; 
                $('#notifications_count').text(notification_count) ;
           }
        }) ; 
}