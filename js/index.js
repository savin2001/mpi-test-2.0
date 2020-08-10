function videoClick(){
    document.querySelector('.visible').classList.remove('active');
    document.querySelector('.hide').classList.add('active');
    document.querySelector('#videos').classList.remove('sr-only');
    document.querySelector('#photos').classList.add('sr-only');
}
function photoClick(){
    document.querySelector('.visible').classList.add('active');
    document.querySelector('.hide').classList.remove('active');
    document.querySelector('#videos').classList.add('sr-only');
    document.querySelector('#photos').classList.remove('sr-only');
}

function reply_click(clicked_id){
  return document.getElementById('user_id').value = clicked_id;
}

function media_reply_click(clicked_id){
  return document.getElementById('media').value = clicked_id;
}
document.querySelector("iframe").style.width = "100%";
