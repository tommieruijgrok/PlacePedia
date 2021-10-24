function edit(el){

    parentEl = el.parentElement.parentElement.parentElement;

    parentEl.getElementsByClassName('reviewContent')[0].classList.toggle('hidden');
    parentEl.getElementsByClassName('reviewEditor')[0].classList.toggle('hidden');

}