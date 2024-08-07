const catalogsMenu = document.getElementById('catalogs');
const catalogs = document.querySelectorAll('.catalog');

catalogsMenu.addEventListener('click', () => {
    catalogs.forEach(catalog => {
        catalog.classList.toggle('d-none')
    })
})

catalogs.forEach(catalog => {
    catalog.addEventListener('click', (e) => {
        let articlesContainer = document.querySelector('.articles_container');
        articlesContainer.innerHTML = ''
        let articlesResp = JSON.parse(catalog.getAttribute('data-articles'))
        //console.log(articlesResp);
        let articles = articlesResp.map(article => {
            let components = {};
            article.category.components.forEach(component => {
                components[component.name] = component.thickness ? component.thickness.value / 1000 : '';
            })
            //console.log(components);
            return {
                'code': article.code,
                'height': article.height / 1000,
                'width': article.width / 1000,
                'depth': article.depth / 1000,
                'category': article.category.name,
                'components': components
            }
        })
        //console.log(articles);

        articles.forEach(article => {
            console.log(article);
            console.log(JSON.stringify(article, null, 2));
            let cardEl =
                ` 
                <div class="col">
                    <div class="article card pointer" data-article='${JSON.stringify(article, null, 2)}'>
                        <div class="card-body">
                            <h5 class="card-title">${article.code}</h5>
                            <p class="card-text">Element : <br>
                                ${article.height}x${article.width}x${article.depth}
                            </p>
                        </div>
                    </div>
                </div>
                `
            articlesContainer.insertAdjacentHTML('afterbegin', cardEl)
        })
    })
})