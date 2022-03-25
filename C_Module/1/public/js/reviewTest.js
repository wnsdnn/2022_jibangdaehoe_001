console.log("Hello World");


const reviewIcon = document.querySelectorAll("section.review_fun i");

const iconMoveHandle = function(e) {
    const iconWidth = this.clientWidth;

    if(e.offsetX > (iconWidth/2)+5) {
        this.className = "fa fa-star";
    } else if(e.offsetX < (iconWidth/2)-5) {
        this.className = "fa fa-star-o";
    } else {
        this.className = "fa fa-star-half-o";
    }
};


window.onload = () => {
    reviewIcon.forEach( ele => {
        ele.addEventListener("mousemove", iconMoveHandle);
    } );
};




