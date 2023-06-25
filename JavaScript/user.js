const backToTopButton = document.getElementById('tabs-bar__portal');

backToTopButton.addEventListener('click', function() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});

// modal area
const openModal = document.querySelector(".modal");
const btn = document.querySelector(".icon-button");
var body = document.getElementsByTagName('body')[0];

btn.addEventListener('click', () => {
  openModal.classList.add('show');
  body.style.overflow = 'hidden';
});

window.onclick = function(event) {
  if (event.target == openModal) {
      openModal.classList.remove('show');
      body.style.overflow = 'visible';
  }
}

//share modal
// const shareModal = document.querySelector(".share-modal");
// const sharebtn = document.querySelector(".share-box");
// const closeShare = document.querySelector(".close-share");

// closeShare.addEventListener('click', () => {
//   shareModal.classList.remove('show');
// });

// sharebtn.addEventListener('click', () => {
//   shareModal.classList.add('show');
//   body.style.overflow = 'hidden';
// });

// window.onclick = function(event) {
//   if (event.target == shareModal) {
//       shareModal.classList.remove('show');
//       body.style.overflow = 'visible';
//   }
// }

// edit profile area
function back() {
  window.location.replace("user.html");
}