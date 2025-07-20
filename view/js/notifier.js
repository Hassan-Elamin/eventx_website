

class Notifier {
    constructor(stPath) {
        let styleLink = document.createElement('link')
        styleLink.rel = 'stylesheet'
        styleLink.href = stPath
        document.head.append(styleLink);

    }

    popupNotification(state, content) {
        if (document.getElementById('notification-bar')) {
            document.getElementById('notification-bar').remove()
        }
        let bg = 'bg-'
        switch (state) {
            case 'success':
                bg += 'success'
                break
            case 'error':
                bg += 'danger'
                break
            case 'warninng':
                bg += 'warning'
                break
            default:
                bg += 'info'
                break
        }
        let notification = document.createElement('div')
        notification.id = 'notification-bar'
        notification.className = 'notification-top-bar ' + bg

        let notifyContent = document.createElement('p')
        notifyContent.innerHTML = content 

        notification.appendChild(notifyContent)
        document.body.append(notification)

        setTimeout(() => {
            notification.remove()
        },99000)
    }
}