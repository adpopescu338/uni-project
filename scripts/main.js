const fetchPolyfill = document.createElement("script");
fetchPolyfill.src = "https://cdn.jsdelivr.net/npm/fetch-polyfill@0.8.2/fetch.min.js";
document.querySelector('head').appendChild(fetchPolyfill);

import initHeader, {updateHeader} from "./header.js";
import initFooter from "./footer.js";
initHeader();
initFooter();
getSession().then(session=>{
  if(session){
    updateHeader();
  }
})

function getSession() {
  return new Promise((resolve) => {
    fetch("api/session.php")
      .then((r) => r.json())
      .then((data) => {
        resolve(data);
        window.session = data;
      })
      .catch((e) => console.log("No session"));
  });
}
