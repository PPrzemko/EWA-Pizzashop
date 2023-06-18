function onload(){
    logJSONData();
    window.setInterval (logJSONData, 4000)
}
async function logJSONData() {
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
