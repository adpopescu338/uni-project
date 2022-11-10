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
    fetch("/api/session.php")
      .then((r) => r.json())
      .then((data) => {
        resolve(data);
        window.session = data;
      })
      .catch((e) => console.log("No session"));
  });
}
