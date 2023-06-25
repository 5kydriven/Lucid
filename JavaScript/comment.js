const backToTopButton = document.getElementById('tabs-bar__portal');

backToTopButton.addEventListener('click', function() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});

// modal area
const openModal = document.querySelector(".modal");
const btnModal = document.querySelector(".close");
var body = document.getElementsByTagName('body')[0];

btnModal.addEventListener('click', () => {
  openModal.classList.add('show');
  body.style.overflow = 'hidden';
});

window.onclick = function(event) {
  if (event.target == openModal) {
      openModal.classList.remove('show');
      body.style.overflow = 'visible';
  }
}

// comment


var a = 0;

function show_hide(){
  if(a == 1){
    document.getElementById('comment-box').style.display = "block";
    document.getElementById('submit-comment').style.display = "flex";
    return a = 0;
  } else {
    document.getElementById('comment-box').style.display = "none";
    document.getElementById('submit-comment').style.display = "none";
    return a = 1;
  }
}

// const replybtn = document.querySelectorAll('.reply-button');

// replybtn.forEach(function(replybtns) {
//     const comment = replybtns.parentNode;
//     const replyCon = comment.querySelector('.reply-container');
  
//     replyCon.style.display = 'flex';
// });

const replybtn = document.querySelectorAll('.reply-button');

    replybtn.forEach(function(button) {
    button.addEventListener('click', function() {
    const comment = button.closest('.comment-square');
    const replyFormContainer = comment.querySelector('.reply-container');
    
    replyFormContainer.style.display = replyFormContainer.style.display === 'flex' ? 'none' : 'flex';
  });
});


