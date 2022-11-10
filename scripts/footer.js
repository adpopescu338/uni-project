const footer = document.createElement('footer');
const footerContent = `
<style>
footer{
   background-color: blanchedalmond;
   position: fixed;
   bottom: 0;
   width: 100%;
   text-align: center;
   padding: 0px;
}
</style>
<p>© 2021 Experience day gift</p>
`
footer.innerHTML = footerContent;

const init= () => {
    document.body.appendChild(footer);
}

export default init;