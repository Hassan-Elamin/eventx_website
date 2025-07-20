

document.querySelectorAll('.eventv-card').forEach(element => {
    element.addEventListener('click',function(){
        location.replace('../event_page/event_page.php?eid='+element.id)
    })
});