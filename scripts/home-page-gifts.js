const top3Id = `top3-gifts${Math.random().toString(36).slice(2)}`;
const boxClass = `box${Math.random().toString(36).slice(2)}`;
const buttonParentClass = `button-parent${Math.random().toString(36).slice(2)}`;
const presentationId = `presentation${Math.random().toString(36).slice(2)}`;
const giftsContainerId = `gifts-container${Math.random()
  .toString(36)
  .slice(2)}`;

const styles = `
<style>
#${top3Id} {
  border: 1px solid rgba(27, 27, 27, 0.3);
  border-radius: 8px;
  min-height: 500px;
  width: 90%;
  margin: 0 auto;
  display: flex;
  justify-content: space-evenly;
  padding: 20px 0;
  flex-wrap: wrap;
  row-gap: 20px;
  box-shadow: 0 0 5px grey;
}

.${boxClass} {
  box-shadow: 0 0 5px black;
  height: auto;
  border-radius: 8px;
  background-color: blanchedalmond;
  width: 28%;
  text-align: center;
  min-width: 250px;
  padding-bottom: 40px;
  position: relative;
}

.${boxClass} img {
  width: 90%;
  border-radius: 10px;
}

.${buttonParentClass} button {
  background-color: #1c0950;
  color: white;
  border: none;
  border-radius: 8px;
  padding: 8px;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.3s;
}
.${boxClass} button:hover {
  background-color: #2b088c;
  color: white;
  box-shadow: 0 0 8px black;
}

.${buttonParentClass} {
  position: absolute;
  bottom: 10px;
  width: 100%;
}

.${boxClass} > h2::after {
  content: "£" attr(data-content);
  background-color: pink;
  position: absolute;
  border-radius: 8px;
  transform: rotate(-20deg);
  margin-top: 40px;
  padding-right: 5px;
  z-index: 1;
  right: 0;
}

.${boxClass} > p {
  padding: 0 5px;
}

@media screen and (max-width: 600px) {
  .${boxClass} {
    min-width: 90%;
  }
}

#${presentationId} {
    width: 90%;
    margin: 0 auto;
    margin-top: 40px;
}

#${giftsContainerId} {
    padding: 20px 10%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
  }

  #${giftsContainerId} > a {
    color: black;
    padding: 0 10px 10px 10px;
    background: blanchedalmond;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.5s ease-in-out;
    width: 210px;
    position: relative;
    padding-bottom: 40px;
  }
  #${giftsContainerId} > a:hover {
    box-shadow: 0 0 8px black;
  }

  #${giftsContainerId} img {
    width: 190px;
    border-radius: 10px 10px 0 0;
  }

  #${giftsContainerId} span {
    background-color: pink;
    border-radius: 8px;
    transform: rotate(-30deg);
    padding-right: 5px;
    font-size: 19px;
  }
</style>`;

const createTop3 = (gifts) => {
  const top3 = gifts.slice(0, 3);
  const parent = document.createElement("div");
  parent.setAttribute("id", top3Id);
  parent.innerHTML = top3.reduce((acc, gift) => {
    return (
      acc +
      `
    <div class="${boxClass}">
    <h2 data-content="${gift.price}">${gift.name}</h2>
    <img src="${gift.cover_img}" />
    <p>
      ${gift.description}
    </p>
    <div class="${buttonParentClass}">
      <a href="gift.html?gift=${gift.id}">
        <button>Book</button>
      </a>
    </div>
  </div>`
    );
  }, styles);

  return parent;
};

const presentationContent = `Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.`;

const createGifts = (gifts) => {
  return gifts.reduce(
    (tot, gift) => `${tot}
    <a href="gift.html?gift=${gift.id}">
        <h3>${gift.name}</h3>
        <img src="${gift.cover_img}" />
        <div style="text-align:center; position: absolute; bottom: 8px; width: 100%;">
            <span>£${gift.price}</span>
        </div>
    </a>
    `,
    ""
  );
};

fetch("api/all.php")
  .then((response) => response.json())
  .then((data) => {
    const top3 = createTop3(data);
    document.body.appendChild(top3);

    const presentation = document.createElement("article");
    presentation.setAttribute("id", presentationId);
    presentation.innerHTML = `<p>${presentationContent}</p>`;
    document.body.appendChild(presentation);

    const giftsContainer = document.createElement("div");
    giftsContainer.setAttribute("id", giftsContainerId);
    giftsContainer.innerHTML = createGifts(data);
    document.body.appendChild(giftsContainer);
  });
