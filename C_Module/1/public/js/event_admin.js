console.log("Hello World");


const formSubmitHandle = function(e) {
    e.preventDefault();
    const tr = document.querySelectorAll("section.event_admin table tr.content");
    console.log(tr);
};


document.forms[0].addEventListener("submit", formSubmitHandle);
