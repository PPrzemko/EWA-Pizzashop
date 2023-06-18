// Authors: Antonia Berg, Julia Hillmann, Fynn Fabian Fröhlich
function onload(){
    updateXHRsite();
    window.setInterval (updateXHRsite, 4000)
}
async function updateXHRsite() {
    const response = await fetch("CustomerStatus.php");
    const jsonData = await response.json();
    const articleList = document.getElementById("orderdArticles");
    articleList.textContent = "";
    jsonData.forEach(function (item) {
        const article = document.createElement("p");
        article.textContent = item[0] + " : " +  item[1];
        articleList.appendChild(article);
    });
}

