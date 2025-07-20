

class FollowController {

    data

    constructor(data) {
        this.data = data;
        console.log(this.data)
        if (data.action === "check-follow"){
            this.checkFollow(data)
        }else{
            this.changeFollowTo(data.type , ()=>{})
        }
        
    }

    checkFollow() {
        if (data.action !== 'check-follow') {
            data.action = 'check-follow'
        }
        $.ajax({
            url: '../../../business_logic/api/follow_control.php',
            type: 'POST',
            data: data,
            success: function (response) {
                let follow_type = response['follow_type']
                console.log(follow_type)
                if (follow_type === 'none') {
                    console.log('s')
                    $('#follow_button').removeClass('d-none');
                    if (!$('.follow-options').hasClass('d-none')) {
                        $('.follow-options').addClass('d-none');
                    }
                } else {
                    var followActions = ['following', 'see first', 'unfollow'];
                    let current_action = follow_type.replace('_', ' ');
                    let index = followActions.indexOf(current_action);
                    if (index > -1) {
                        followActions.splice(index, 1);
                    }

                    $("#followActionsMenuButton").text(current_action);
                    $('.dropdown-menu').html('');

                    for (let a in followActions) {
                        let action = followActions[a];
                        $('.dropdown-menu')
                            .append(`<button class="dropdown-item followActionOptionBtn">${action}</button>`);
                    }

                    $('.follow-options').removeClass('d-none');

                    if (!$('#follow_button').hasClass('d-none')) {
                        $("#follow_button").addClass('d-none')
                    }

                    $('.followActionOptionBtn').on('click', function (e) {
                        
                        e.preventDefault();
                        console.log('started')
                        if (controller) {
                            controller.changeFollowTo(e.target.innerHTML, notifier.popupNotification)
                        } else {
                            console.log('disabled')
                        }
                    })
                }

            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }

        })
    }

    changeFollowTo(type, afterComplete) {
        let action = type.replace(' ', '_').toLowerCase();
        data.action = action
        $.ajax({
            url: 'http://localhost/eventx_website/business_logic/api/follow_control.php',
            type: 'POST',
            content_type: 'application/json',
            data: data,
            success: function (response) {
                if (parseInt(response['status']) === 1) {
                    controller.checkFollow(data)
                    let status = ''
                    switch (type) {
                        case 'unfollow':
                            status = 'error'
                            break
                        case 'following':
                            status = 'info'
                            break
                        default:
                            status = 'success'
                            break
                    }
                    afterComplete(status, response.message)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        })
    }
}

