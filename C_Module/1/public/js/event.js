console.log("Hello World");

const eventForm = document.querySelector(".eventForm");

const eventFormSubmit = async e => {
    e.preventDefault();
    
    // body: JSON.stringify({
    //     name: from.name.value,
    //     phone: from.phone.value,
    //     score: from.score.value
    // })

    const from = e.currentTarget;
    const formDatas = new FormData(from);

    const data = await fetch("/api/event/applicants", {
        method: "POST",
        body: formDatas
    })
    .then( res => res.json() );

    alert(`${data.message}`);
    
    const data2 = await fetch(`/api/event/${from.phone.value}/stamps`)
    .then( res => res.json() );
    alert(`${data2.stamps}`);

    from.reset();

};

eventForm.addEventListener("submit", eventFormSubmit);




