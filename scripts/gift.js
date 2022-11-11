const giftId = new URLSearchParams(window.location.search).get("gift");
const parent = document.querySelector("#gift-info");
fetch(`api/gift.php?gift=${giftId}`)
  .then((r) => r.json())
  .then((gift) => {
    if(!Object.values(window.session || []).length){
        document.querySelector('button[type="submit"]').disabled = true
    }

    parent.classList.remove("hidden");
    document.querySelector("#content .loader").remove();

    const { name, description, cover_img, price, url } = gift;
    const content = `
    <h2>${name}</h2>
    <img src="${cover_img}" alt="${name}" />
    <p>${description}</p>`
    const fragment = document.createElement('div');
    fragment.innerHTML = content;

    //insert fragment asthe first child of parent
    parent.insertBefore(fragment, parent.firstChild);

    const dates = Object.entries(gift.availability).reduce(
      (tot, [date, available]) => {
        if (Math.random() < 0.5) {
          available = false;
        }
        return (
          tot +
          `<option value="${date}" ${!available ? "disabled" : ""}>${date}${
            available ? "" : "  -  fully booked"
          }</option>`
        );
      },
      ""
    );

    document.querySelector('select[name="date"]').innerHTML = dates;
  });
