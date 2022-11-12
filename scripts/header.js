const nav = document.createElement("nav");
const navContent = `
<style>
nav {
    background-color: blanchedalmond;
    color: black;
    padding: 2px 10px;
  }
  nav > ul {
    display: flex;
    list-style: none;
    justify-content: space-between;
    padding: 0;
  }
  nav > ul > li {
    font-size: 25px;
  }
  nav > ul > li > a {
    text-decoration: none;
    color: black;
    padding: 3px;
    transition: background-color 0.5s;
    border-radius: 6px;
  }
  nav > ul > li > a:hover {
    background-color: pink;
  }
  #menu-icon{
    font-size: 40px;
    cursor: pointer;
    transition: font-size 0.5s;
    position: relative;
  }
  #menu-icon:hover {
    font-size: 50px;
  }
  #menu-icon > span {
    position: absolute;
    left: -30px;
    top: -10px;
    z-index: 100;
  }

  #menu {
    position: absolute;
    width: 300px;
    display: none;
    flex-direction: column;
    box-shadow: 0 0 5px black;
    left: -310px;
    border-radius: 8px;
    top: 20px;
    font-size: 20px;
    background-color: white;
    padding: 10px 0px;
  }

  #menu a {
    text-decoration: none;
    color: black;
    text-align: center;
    cursor: pointer;
    padding-top: 5px;
    padding-bottom: 5px;
  }
  #menu a:hover {
    background-color: blanchedalmond;
  }
</style>
<ul>
  <li><a href="index.html">Home</a></li>
  <li><a href="login.html">Login</a></li>
  <li><a href="register.html">Register</a></li>
</ul>`;

nav.innerHTML = navContent;

const init = () => {
  // insert nav before the first element
  document.body.insertBefore(nav, document.body.firstChild);
};
export default init;

export const updateHeader = () => {
  if(!Object.values(session || {}).length){
    return
  }
  const nav = document.querySelector("nav > ul");
  const menuIcon = document.createElement("li");
  menuIcon.setAttribute("id", "menu-icon");
  menuIcon.innerHTML = `
    <span> &#9881; </span>
    <div id="menu">
        <a href="change-password.html">Change password</a>
        <a href="my-bookings.php">My Bookings</a>
        <a href="api/signout.php">Signout</a>
    </div>
    `;
  nav.appendChild(menuIcon);

  const menu = document.querySelector("#menu");

  // show menu on mouseenter menuicon
  menuIcon.addEventListener("mouseenter", () => {
    menu.style.display = "flex";
  });
  // hide menu on mouseleave menuicon
  menuIcon.addEventListener("mouseleave", () => {
    menu.style.display = "none";
  });
};
