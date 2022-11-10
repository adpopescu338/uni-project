const banner = document.getElementById("banner");
fetch('api/all.php')
.then(response => response.json())
.then(console.log)

const createTop3 = (data) => {
    
}