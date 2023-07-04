document.addEventListener('scroll', function() {
    var headerHeight = document.querySelector('#header').offsetHeight;
    var scrollTop = window.scrollY;
    var backToTopButton = document.querySelector('#backToTopButton');

    if (scrollTop > headerHeight) {
        backToTopButton.classList.remove('d-none');
    } else {
        backToTopButton.classList.add('d-none');
    }
});