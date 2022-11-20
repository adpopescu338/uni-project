const giftId = new URLSearchParams(window.location.search).get("gift");
const parent = document.querySelector("#gift-info");

fetch(`api/gift.php?gift=${giftId}`)
  .then((r) => r.json())
  .then((gift) => {
    if (!Object.values(window.session || []).length) {
      const bookButton = document.querySelector("form button");
      bookButton.textContent = "Login to book";
      document.querySelector("form").setAttribute("action", "login.html");
    }else{
      const reviewButton = document.querySelector('#review-link')
      reviewButton.parentElement.classList.remove('hidden')
      reviewButton.setAttribute('href', `review.html?id=${giftId}&name=${gift.name}`)
    }

    document.querySelector('input[name="gift_id"]').value = giftId;
    parent.classList.remove("hidden");
    document.querySelector("#content .loader").remove();

    const { name, description, cover_img, price, id } = gift;
    const content = `
    <h2>${name}</h2>
    <img src="${cover_img}" alt="${name}" />
      <div style="text-align:center;margin-top: 20px;">
        <span class="gift-price">${price}</span>
      </div>
    <p>${description}</p>`;
    const fragment = document.createElement("div");
    fragment.innerHTML = content;

    //insert fragment asthe first child of parent
    parent.insertBefore(fragment, parent.firstChild);

    const giftImagesContainer = document.querySelector("#gift-images");
    const images = JSON.parse(gift.images);

    images.forEach((image) => {
      const img = document.createElement("img");
      img.src = image;
      img.alt = name;
      giftImagesContainer.appendChild(img);
    });

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

    const reviews = document.createElement("section");
    reviews.classList.add("reviews");

    const reviewsContent = gift.reviews.reduce((tot, review) => {
      const images = review.images ? JSON.parse(review.images) : []
      const imagesContent=images.map((img) => `<img src="images/${img}" alt="Review image" />`).join("")
      return (
        tot +
        `
      <div class="review">
        <h3><img src="https://i.pravatar.cc/${Math.floor(
          Math.random() * 200
        )}" alt="Avatar" class="avatar">${review.name}</h3>
        <p>${review.text}</p>
        <div class="images-container">
          ${imagesContent}
        </div>
      </div>
      `
      );
    }, "");

    reviews.innerHTML = reviewsContent;
    document.body.appendChild(reviews);
  });
